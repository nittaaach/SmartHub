<?php

if (!function_exists('formatNomorIndo')) {
    function formatNomorIndo($nomor)
    {
        // Hapus semua karakter selain angka
        $nomor = preg_replace('/\D/', '', $nomor);

        // Ganti 0 di awal jadi +62
        if (substr($nomor, 0, 1) === '0') {
            $nomor = '+62' . substr($nomor, 1);
        } elseif (substr($nomor, 0, 2) === '62') {
            $nomor = '+' . $nomor;
        } elseif (substr($nomor, 0, 3) !== '+62') {
            $nomor = '+62' . $nomor;
        }

        // Format pakai strip: +62 812-3456-789
        $nomorFormatted = preg_replace(
            '/(\+62)(\d{3})(\d{4})(\d{3,4})/',
            '$1 $2-$3-$4',
            $nomor
        );

        return $nomorFormatted;
    }
}
