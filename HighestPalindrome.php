<?php

/**
 * Membantu membangun palindrome dari karakter array dengan perubahan minimal secara rekursif.
 *
 * @param array &$charArray Referensi ke array karakter yang sedang diubah.
 * @param int $left Indeks awal dari karakter yang sedang diperiksa.
 * @param int $right Indeks akhir dari karakter yang sedang diperiksa.
 * @param int $k Jumlah perubahan yang tersisa.
 * @return int Jumlah perubahan yang tersisa setelah membangun palindrome, atau -1 jika tidak mungkin.
 */
function buildPalindrome(&$charArray, $left, $right, $k) {
    // Base case: Jika pointer kiri melebihi pointer kanan
    if ($left > $right) {
        return $k;  // Kembalikan jumlah perubahan yang tersisa
    }
    
    // Jika karakter pada posisi saat ini sama
    if ($charArray[$left] == $charArray[$right]) {
        // Lanjutkan ke dalam tanpa mengurangi jumlah perubahan
        return buildPalindrome($charArray, $left + 1, $right - 1, $k);
    }
    
    // Jika karakter berbeda dan masih ada perubahan yang tersedia
    if ($k > 0) {
        // Ganti karakter yang lebih kecil dengan yang lebih besar untuk mendapatkan nilai lebih tinggi
        $charArray[$left] = $charArray[$right] = max($charArray[$left], $charArray[$right]);
        // Lanjutkan ke dalam dengan mengurangi satu perubahan
        return buildPalindrome($charArray, $left + 1, $right - 1, $k - 1);
    }
    
    // Jika tidak ada perubahan yang tersisa dan karakter berbeda, gagal membentuk palindrome
    return -1;
}

/**
 * Memaksimalkan nilai palindrome dengan mengganti karakter yang lebih rendah dengan '9' jika memungkinkan.
 *
 * @param array &$charArray Referensi ke array karakter yang sedang diubah.
 * @param int $left Indeks awal dari karakter yang sedang diperiksa.
 * @param int $right Indeks akhir dari karakter yang sedang diperiksa.
 * @param int $k Jumlah perubahan yang tersisa.
 */
function maximizePalindrome(&$charArray, $left, $right, $k) {
    // Base case: Jika pointer kiri melebihi pointer kanan
    if ($left > $right) {
        return;
    }
    
    // Jika karakter pada posisi saat ini bukan '9'
    if ($charArray[$left] != '9') {
        if ($charArray[$left] == $charArray[$right]) {
            if ($left != $right && $k >= 2) {
                // Ganti kedua karakter dengan '9' jika masih ada cukup perubahan dan posisinya tidak sama
                $charArray[$left] = $charArray[$right] = '9';
                // Lanjutkan ke dalam dengan mengurangi dua perubahan
                maximizePalindrome($charArray, $left + 1, $right - 1, $k - 2);
            } elseif ($left == $right && $k >= 1) {
                // Jika posisi sama, cukup ganti satu karakter dengan '9'
                $charArray[$left] = '9';
                // Lanjutkan ke dalam dengan mengurangi satu perubahan
                maximizePalindrome($charArray, $left + 1, $right - 1, $k - 1);
            } else {
                // Jika tidak ada cukup perubahan, lanjutkan tanpa perubahan
                maximizePalindrome($charArray, $left + 1, $right - 1, $k);
            }
        } elseif ($k > 0) {
            // Jika karakter berbeda dan masih ada perubahan, ganti keduanya dengan '9'
            $charArray[$left] = $charArray[$right] = '9';
            // Lanjutkan ke dalam dengan mengurangi satu perubahan
            maximizePalindrome($charArray, $left + 1, $right - 1, $k - 1);
        } else {
            // Jika tidak ada cukup perubahan, lanjutkan tanpa perubahan
            maximizePalindrome($charArray, $left + 1, $right - 1, $k);
        }
    } else {
        // Jika karakter sudah '9', lanjutkan ke dalam tanpa perubahan
        maximizePalindrome($charArray, $left + 1, $right - 1, $k);
    }
}

/**
 * Menghasilkan palindrome tertinggi dari sebuah string dengan jumlah perubahan karakter maksimum yang diberikan.
 *
 * @param string $s String yang akan diubah menjadi palindrome.
 * @param int $k Jumlah maksimum perubahan karakter yang diperbolehkan.
 * @return string Palindrome tertinggi yang dapat dihasilkan, atau -1 jika tidak dapat membentuk palindrome.
 */
function highestPalindrome($s, $k) {
    $length = strlen($s);  // Panjang string
    $charArray = str_split($s);  // Mengubah string menjadi array karakter
    
    // Membuat palindrome awal
    $remainingChanges = buildPalindrome($charArray, 0, $length - 1, $k);
    
    // Jika tidak bisa membuat palindrome dengan perubahan yang diberikan
    if ($remainingChanges == -1) {
        return -1;
    }
    
    // Memaksimalkan nilai palindrome
    maximizePalindrome($charArray, 0, $length - 1, $remainingChanges);
    
    // Mengembalikan hasil sebagai string
    return implode('', $charArray);
}

// Sampel Pengujian
print_r(highestPalindrome('3943', 1) . "\n"); // Output: 3993
print_r(highestPalindrome('932239', 2) . "\n"); // Output: 992299

?>
