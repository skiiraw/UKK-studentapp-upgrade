<?php
include_once("config.php");

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nomor_presensi = $_POST['nomor_presensi'];
    $kelas = $_POST['kelas'];
    $foto_filename = '';

    // Cek apakah ada file yang diunggah
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "uploads/"; // Direktori untuk menyimpan foto
        $file = $_FILES['foto'];

        // Buat nama file yang unik untuk menghindari penimpaan file
        $foto_filename = uniqid() . '-' . basename($file['name']);
        $target_file = $target_dir . $foto_filename;

        // Pindahkan file dari direktori temporary ke direktori tujuan
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            // File berhasil diunggah
        } else {
            die("Maaf, terjadi error saat mengunggah file Anda.");
        }
    }

    // Insert data ke database
    $stmt = $mysqli->prepare("INSERT INTO siswa(nama, nomor_presensi, kelas, foto_filename) VALUES(?, ?, ?, ?)");
    $stmt->bind_param("siss", $nama, $nomor_presensi, $kelas, $foto_filename);
    
    if ($stmt->execute()) {
        echo "Data siswa berhasil ditambahkan. ";
        echo "<a href='index.php'>Lihat Data Siswa</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>