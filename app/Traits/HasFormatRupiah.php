<?php

namespace App\Traits;

trait HasFormatRupiah
{
    function formatRupiah($field, $prefix = null)
    {
        $prefix = $prefix ? $prefix : 'Rp. ';
        $nominal = $this->attributes[$field];

        // Ubah tipe data menjadi float sebelum diformat
        $nominal = floatval($nominal);

        return $prefix . number_format($nominal, 0, ',', '.');
    }
}

?>