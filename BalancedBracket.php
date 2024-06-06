<?php
/**
 * Fungsi untuk memeriksa apakah bracket dalam string seimbang.
 *
 * @param string $input String yang mengandung bracket.
 * @return string "YES" jika bracket seimbang, "NO" jika tidak.
 */
function isBalanced($input) {
    // Stack untuk menyimpan bracket pembuka
    $stack = [];
    // Peta bracket penutup ke bracket pembuka yang sesuai
    $brackets = [
        ')' => '(',
        ']' => '[',
        '}' => '{'
    ];
    
    // Loop melalui setiap karakter dalam input
    for ($i = 0; $i < strlen($input); $i++) {
        $char = $input[$i];
        
        // Lewati karakter yang bukan bracket
        if (!in_array($char, ['(', ')', '{', '}', '[', ']'])) {
            continue;
        }
        
        // Jika karakter adalah bracket pembuka, tambahkan ke stack
        if (in_array($char, ['(', '{', '['])) {
            $stack[] = $char;
        } else {
            // Jika karakter adalah bracket penutup
            // Periksa apakah stack tidak kosong dan bracket teratas sesuai dengan bracket penutup
            if (empty($stack) || array_pop($stack) != $brackets[$char]) {
                return "NO";
            }
        }
    }
    
    // Jika stack kosong, semua bracket seimbang
    return empty($stack) ? "YES" : "NO";
}

// Sampel Pengujian
print_r(isBalanced("{ [ ( ) ] }") . "\n"); // Output: YES
print_r(isBalanced("{ [ ( ] ) }") . "\n"); // Output: NO
print_r(isBalanced("{ ( ( [ ] ) [ ] ) [ ] }") . "\n"); // Output: YES
?>