<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Helpers\PaymentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Ambil semua order
    public function index()
    {
        $orders = Order::with('orderItems')->get();

        return response()->json($orders);
    }

    // Ambil order berdasarkan ID
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        return response()->json($order);
    }
    
    public function getPendapatan(Request $request)
    {
        $type  = $request->query('type', 'day'); // default: day
        $year  = $request->query('year', now()->year);
        $month = $request->query('month');
        $day   = $request->query('day');

        $query = DB::table('orders')
            ->selectRaw("SUM(total_price) as jumlah");

        if ($type === 'day') {
            $query->selectRaw("DATE(created_at) as label")
                ->whereYear('created_at', $year);

            if ($month) {
                $query->whereMonth('created_at', $month);
            }

            if ($day) {
                $query->whereDay('created_at', $day);
            }

            $query->groupBy(DB::raw('DATE(created_at)'));
        }

        if ($type === 'week') {
            $query->selectRaw("WEEK(created_at, 1) as label, YEAR(created_at) as year_label")
                ->whereYear('created_at', $year)
                ->groupBy(DB::raw('WEEK(created_at, 1)'), DB::raw('YEAR(created_at)'));
        }

        if ($type === 'month') {
            $query->selectRaw("MONTH(created_at) as label, YEAR(created_at) as year_label")
                ->whereYear('created_at', $year)
                ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'));
        }

        $query->where('status', 'Selesai')->orderBy('label', 'asc');

        $result = $query->get();

        return response()->json($result);
    }
    
    public function getProdukTerlaris(Request $request)
    {
        $year  = $request->query('year', now()->year);
        $month = $request->query('month'); // optional

        $query = DB::table('order_items')
            ->select('product_name', DB::raw('SUM(quantity) as total_terjual'))
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'Selesai')
            ->whereYear('orders.created_at', $year);

        if ($month) {
            $query->whereMonth('orders.created_at', $month);
        }

        $query->groupBy('product_name')
            ->orderByDesc('total_terjual');

        return response()->json($query->get());
    }
    
    public function storeCashOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'customer_meja' => 'required|string|max:10',
            'note'     => 'nullable|string',
            'items'    => 'required|array|min:1',
            'items.*.name'     => 'required|string',
            'items.*.price'    => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        DB::beginTransaction();
        try {
            // Validasi stok sebelum membuat order
            $stockErrors = [];
            foreach ($request->items as $item) {
                $product = Product::where('name', $item['name'])->first();
                if ($product) {
                    if (!$product->hasEnoughStock($item['quantity'])) {
                        $stockErrors[] = "Stok {$item['name']} tidak mencukupi. Tersedia: {$product->stock}";
                    }
                }
            }
    
            if (!empty($stockErrors)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi',
                    'errors' => $stockErrors
                ], 400);
            }
    
            $total = collect($request->items)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });
            
            // Hitung Hybrid Fee
            $paymentDetails = PaymentHelper::calculateHybridFee($total);
    
            // Simpan ke tabel orders dengan fee platform
            $order = Order::create([
                'order_id'        => 'INV-' . time(),
                'customer_name'   => $request->name,
                'customer_phone'  => $request->phone,
                'customer_meja'   => $request->customer_meja,
                'notes'           => $request->note,
                'total_price'     => $paymentDetails['total_order'],
                'fee_platform'    => $paymentDetails['fee_platform'],
                'total_bayar'     => $paymentDetails['total_bayar'],
                'status'          => 'Selesai',
                'payment_status'  => 'sukses',
                'payment_method'  => 'cash'
            ]);
    
            // Simpan item ke order_items dan kurangi stok
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_name' => $item['name'],
                    'price'        => $item['price'],
                    'quantity'     => $item['quantity'],
                    'subtotal'     => $item['price'] * $item['quantity'],
                ]);
    
                // Kurangi stok produk
                $product = Product::where('name', $item['name'])->first();
                if ($product) {
                    $product->decreaseStock($item['quantity']);
                }
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil disimpan dan stok telah diupdate.',
                'order'   => $order->load('orderItems'),
                'payment_details' => $paymentDetails
            ]);
    
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pesanan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Mendapatkan detail perhitungan Hybrid Fee untuk pesanan
     */
    public function getOrderFeeDetails($id)
    {
        $order = Order::find($id);
        
        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }
        
        // Hitung ulang fee berdasarkan total_price
        $paymentDetails = PaymentHelper::calculateHybridFee($order->total_price);
        
        return response()->json([
            'order_id' => $order->order_id,
            'total_order' => $order->total_price,
            'fee_platform' => $order->fee_platform,
            'total_bayar' => $order->total_bayar,
            'payment_details' => $paymentDetails
        ]);
    }
}