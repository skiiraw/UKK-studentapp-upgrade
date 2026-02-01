<?php
include_once("config.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nomor_presensi = $_POST['nomor_presensi'];
    $kelas = $_POST['kelas'];
    $foto_filename = $_POST['old_foto_filename']; // Defaultnya adalah nama file lama

    // Cek apakah ada file foto baru yang diunggah
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "uploads/";
        $file_baru = $_FILES['foto'];

        // Buat nama file baru yang unik
        $new_filename = uniqid() . '-' . basename($file_baru['name']);
        $target_file_baru = $target_dir . $new_filename;

        // Pindahkan file baru ke direktori uploads
        if (move_uploaded_file($file_baru['tmp_name'], $target_file_baru)) {
            // Jika berhasil diunggah, hapus file lama (jika ada)
            if (!empty($foto_filename) && file_exists($target_dir . $foto_filename)) {
                unlink($target_dir . $foto_filename);
            }
            // Update nama file dengan yang baru
            $foto_filename = $new_filename;
        } else {
            die("Maaf, terjadi error saat mengunggah file baru Anda.");
        }
    }

    // Update data di database
    $stmt = $mysqli->prepare("UPDATE siswa SET nama=?, nomor_presensi=?, kelas=?, foto_filename=? WHERE id=?");
    $stmt->bind_param("sissi", $nama, $nomor_presensi, $kelas, $foto_filename, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error saat memperbarui data: " . $stmt->error;
    }
    $stmt->close();
}
?>