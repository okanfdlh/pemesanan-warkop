<?php

namespace App\Helpers;

class PaymentHelper
{
    /**
     * Menghitung biaya layanan Hybrid Fee untuk setiap transaksi
     * 
     * @param float $total_order Total harga pesanan
     * @param float $base_fee Base fee (default: 500)
     * @param float $percentage Persentase fee (default: 0.02 atau 2%)
     * @return array Detail perhitungan fee dan jumlah yang diterima
     */
    public static function calculateHybridFee($total_order, $base_fee = 500, $percentage = 0.02)
    {
        // Hitung fee platform
        $fee_platform = $base_fee + ($percentage * $total_order);
        
        // Hitung total yang harus dibayar pembeli
        $total_bayar = $total_order + $fee_platform;
        
        // Estimasi potongan Midtrans (0.7% dari total_bayar untuk QRIS)
        $estimasi_potongan_midtrans = 0.007 * $total_bayar;
        
        // Dana yang masuk ke platform
        $dana_masuk_platform = $total_bayar - $estimasi_potongan_midtrans;
        
        // Owner menerima total_order
        $owner_terima = $total_order;
        
        // Platform menerima selisih
        $platform_terima = $dana_masuk_platform - $owner_terima;
        
        return [
            'total_order' => round($total_order),
            'fee_platform' => round($fee_platform),
            'total_bayar' => round($total_bayar),
            'estimasi_potongan_midtrans' => round($estimasi_potongan_midtrans),
            'dana_masuk_platform' => round($dana_masuk_platform),
            'owner_terima' => round($owner_terima),
            'platform_terima' => round($platform_terima)
        ];
    }
}