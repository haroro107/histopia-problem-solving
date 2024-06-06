<?php
/**
 * Fungsi untuk memeriksa status dari angka-angka dalam queries berdasarkan bobot karakter dan substring dalam string.
 *
 * @param string $s String input yang terdiri dari karakter-karakter a-z.
 * @param array $queries Array dari angka-angka yang akan diperiksa statusnya.
 * @return array Array dengan nilai "Yes" jika angka dalam queries sesuai dengan bobot karakter/substring, "No" jika tidak.
 */
function weightedStrings($s, $queries) {
    // Array untuk menyimpan bobot yang ditemukan
    $weights = [];
    
    // Variabel untuk menyimpan karakter terakhir yang diproses dan panjang substring yang berulang
    $lastChar = '';
    $currentWeight = 0;
    $currentLength = 0;

    // Loop melalui setiap karakter dalam string
    for ($i = 0; $i < strlen($s); $i++) {
        // Hitung bobot karakter saat ini (a=1, b=2, ..., z=26)
        $weight = ord($s[$i]) - ord('a') + 1;
        
        // Jika karakter saat ini sama dengan karakter terakhir yang diproses
        if ($s[$i] == $lastChar) {
            // Tambahkan panjang substring berulang
            $currentLength++;
        } else {
            // Jika karakter berbeda, reset panjang substring berulang ke 1
            $lastChar = $s[$i];
            $currentLength = 1;
        }
        
        // Hitung bobot substring yang berulang
        $currentWeight = $weight * $currentLength;
        
        // Simpan bobot dalam array (menggunakan nilai sebagai kunci untuk memastikan unik)
        $weights[$currentWeight] = true;
    }

    // Array untuk menyimpan hasil dari queries
    $result = [];
    
    // Loop melalui setiap query untuk memeriksa apakah ada dalam bobot yang ditemukan
    foreach ($queries as $query) {
        // Jika query ditemukan dalam array weights, tambahkan 'Yes' ke hasil
        // Jika tidak, tambahkan 'No'
        $result[] = isset($weights[$query]) ? 'Yes' : 'No';
    }

    // Kembalikan hasil sebagai array
    return $result;
}

// Sampel Pengujian
print_r(weightedStrings('abbcccd', [1, 3, 9, 8])); // Output: ['Yes', 'Yes', 'Yes', 'No']
?>
