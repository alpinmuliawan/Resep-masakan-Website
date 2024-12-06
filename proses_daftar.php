<?php
    session_start();
    include "koneksi.php";

    // Fungsi Enkripsi Password dengan algoritma hash bcrypt dan cost 10
    function enkripPassword($password) {
        $pass_enkrip = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        return $pass_enkrip;
    }

    // Pastikan variabel POST diisi
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pass_enkrip = enkripPassword($password);

        // Menggunakan prepared statement untuk menghindari SQL Injection
        $stmt = $koneksi->prepare("INSERT INTO akun (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $pass_enkrip);

        if($stmt->execute()) {
            echo "
                <script>
                    alert('Pendaftaran berhasil, silakan login');
                    document.location.href = 'login.php';
                </script>
            ";
        } else {
            echo "Proses gagal: " . $stmt->error;
        }

        // Menutup statement
        $stmt->close();
    } else {
        echo "Mohon isi semua data.";
    }
    
    // Menutup koneksi
    $koneksi->close();
?>
