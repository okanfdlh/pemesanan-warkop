<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Get stock information for all products
     */
    public function index()
    {
        $products = Product::select('id', 'name', 'stock', 'min_stock', 'is_available')
            ->orderBy('name')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'stock' => $product->stock,
                    'min_stock' => $product->min_stock,
                    'is_available' => $product->is_available,
                    'status' => $this->getStockStatus($product)
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    /**
     * Get stock information for specific product
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'stock' => $product->stock,
                'min_stock' => $product->min_stock,
                'is_available' => $product->is_available,
                'status' => $this->getStockStatus($product)
            ]
        ]);
    }

    /**
     * Update stock for specific product
     */
    public function updateStock(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required|in:increase,decrease,set',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $oldStock = $product->stock;
        $action = $request->action;
        $quantity = $request->quantity;

        DB::beginTransaction();
        try {
            switch ($action) {
                case 'increase':
                    $product->increaseStock($quantity);
                    break;
                case 'decrease':
                    if (!$product->decreaseStock($quantity)) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Stok tidak mencukupi untuk dikurangi'
                        ], 400);
                    }
                    break;
                case 'set':
                    $product->stock = $quantity;
                    $product->is_available = $quantity > 0;
                    $product->save();
                    break;
            }

            // Log stock movement (optional - bisa dibuat tabel stock_movements)
            // StockMovement::create([
            //     'product_id' => $product->id,
            //     'action' => $action,
            //     'quantity' => $quantity,
            //     'old_stock' => $oldStock,
            //     'new_stock' => $product->stock,
            //     'reason' => $request->reason,
            //     'user_id' => auth()->id()
            // ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Stok berhasil diupdate',
                'data' => [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'old_stock' => $oldStock,
                    'new_stock' => $product->stock,
                    'action' => $action,
                    'quantity' => $quantity,
                    'is_available' => $product->is_available,
                    'status' => $this->getStockStatus($product)
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate stok: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get products with low stock
     */
    public function lowStock()
    {
        $products = Product::lowStock()
            ->select('id', 'name', 'stock', 'min_stock', 'is_available')
            ->orderBy('stock', 'asc')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'stock' => $product->stock,
                    'min_stock' => $product->min_stock,
                    'is_available' => $product->is_available,
                    'status' => 'low_stock'
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $products,
            'count' => $products->count()
        ]);
    }

    /**
     * Get stock summary/statistics
     */
    public function summary()
    {
        $totalProducts = Product::count();
        $availableProducts = Product::where('is_available', true)->count();
        $outOfStock = Product::where('stock', 0)->count();
        $lowStock = Product::lowStock()->count();
        $totalStockValue = Product::sum(DB::raw('stock * price'));

        return response()->json([
            'success' => true,
            'data' => [
                'total_products' => $totalProducts,
                'available_products' => $availableProducts,
                'out_of_stock' => $outOfStock,
                'low_stock_products' => $lowStock,
                'total_stock_value' => $totalStockValue
            ]
        ]);
    }

    /**
     * Bulk update stock
     */
    public function bulkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'updates' => 'required|array|min:1',
            'updates.*.product_id' => 'required|exists:products,id',
            'updates.*.action' => 'required|in:increase,decrease,set',
            'updates.*.quantity' => 'required|integer|min:1',
            'updates.*.reason' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $results = [];
        $errors = [];

        DB::beginTransaction();
        try {
            foreach ($request->updates as $update) {
                $product = Product::find($update['product_id']);
                $oldStock = $product->stock;

                switch ($update['action']) {
                    case 'increase':
                        $product->increaseStock($update['quantity']);
                        break;
                    case 'decrease':
                        if (!$product->decreaseStock($update['quantity'])) {
                            $errors[] = "Produk {$product->name}: Stok tidak mencukupi";
                            continue 2;
                        }
                        break;
                    case 'set':
                        $product->stock = $update['quantity'];
                        $product->is_available = $update['quantity'] > 0;
                        $product->save();
                        break;
                }

                $results[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'old_stock' => $oldStock,
                    'new_stock' => $product->stock,
                    'action' => $update['action'],
                    'quantity' => $update['quantity']
                ];
            }

            if (!empty($errors)) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => 'Beberapa update gagal',
                    'errors' => $errors
                ], 400);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Bulk update stok berhasil',
                'data' => $results
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan bulk update: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get stock status
     */
    private function getStockStatus($product)
    {
        if ($product->stock <= 0) {
            return 'out_of_stock';
        } elseif ($product->stock <= $product->min_stock) {
            return 'low_stock';
        } else {
            return 'in_stock';
        }
    }
}