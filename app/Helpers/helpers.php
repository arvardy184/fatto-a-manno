<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($number)
    {
        return '' . number_format($number, 0, ',', '.');
    }
}
