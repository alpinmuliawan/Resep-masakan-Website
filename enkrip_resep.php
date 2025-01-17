<?php 
    include "koneksi.php";

    $id_akun    = $_POST['id_akun'];
    $judul      = $_POST['judul'];
    $alatbahan  = $_POST['alatbahan'];
    $carabuat   = $_POST['carabuat'];
    
    // Fungsi Enkripsi ROT13
    function enkripsi_Rot13($param){
        for($i = 0; $i < strlen($param); $i++){
            $c = ord($param[$i]);
            
            if(($c >= ord('n') && $c <= ord('z')) || ($c >= ord('N') && $c <= ord('Z'))){
                $c -= 13;
            } elseif(($c >= ord('a') && $c <= ord('m')) || ($c >= ord('A') && $c <= ord('M'))){
                $c += 13;
            }
            $param[$i] = chr($c);
        }
        return $param;
    }
    
    $rot13_a = enkripsi_Rot13($alatbahan);
    $rot13_c = enkripsi_Rot13($carabuat);
    
    // Enkripsi Membalikkan String
    $rev_13a = strrev($rot13_a);
    $rev_13c = strrev($rot13_c);

    // Enkripsi AES
    $cipher = "AES-256-CBC";
    $secret = "1234567890123456789012345678901512345678901234567890123456789013";
    $option = 0;
    $iv = str_repeat("0", openssl_cipher_iv_length($cipher));

    $en_alat = openssl_encrypt($rev_13a, $cipher, $secret, $option, $iv);
    $en_cara = openssl_encrypt($rev_13c, $cipher, $secret, $option, $iv);

    // Jenis file gambar yang diizinkan dan batas ukuran (contoh 2MB)
    $allowed_types = array("image/jpeg", "image/png", "image/gif");
    $max_size = 2 * 1024 * 1024; // 2MB
    
    if (in_array($_FILES['gambar']['type'], $allowed_types) && $_FILES['gambar']['size'] <= $max_size) {
        // Enkripsi gambar
        if (is_uploaded_file($_FILES['gambar']['tmp_name'])) {
            $konten     = file_get_contents($_FILES['gambar']['tmp_name']);
            $en_gambar  = rtrim(base64_encode($konten));

            // Memasukkan data ke database menggunakan prepared statement
            $stmt = $koneksi->prepare("INSERT INTO resep (id_akun, judul, alat_bahan, cara_buat, gambar) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $id_akun, $judul, $en_alat, $en_cara, $en_gambar);

            if($stmt->execute()) {
                echo "
                    <script>
                        alert('Resep telah disimpan. Terima kasih atas partisipasi Anda.');
                        document.location.href = 'resep_saya.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Proses Gagal. Resep tidak dapat disimpan.');
                        document.location.href = 'resep_saya.php';
                    </script>
                ";
            }

            // Menutup statement
            $stmt->close();
        } else {
            echo "
                <script>
                    alert('File gambar tidak valid atau tidak berhasil diunggah.');
                    document.location.href = 'resep_saya.php';
                </script>";
        }
    } else {
        echo "
            <script>
                alert('Hanya file gambar JPG, PNG, atau GIF dengan ukuran maksimal 2MB yang diperbolehkan.');
                document.location.href = 'resep_saya.php';
            </script>";
    }

    // Menutup koneksi
    $koneksi->close();
?>
