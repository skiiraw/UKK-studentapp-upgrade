<?php
include_once("config.php");

$id = $_GET['id'];

// 1. Ambil nama file dari database sebelum menghapus record
$result = $mysqli->query("SELECT foto_filename FROM siswa WHERE id=$id");
$data = $result->fetch_assoc();
$foto_filename = $data['foto_filename'];

// 2. Hapus record dari database
$stmt = $mysqli->prepare("DELETE FROM siswa WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // 3. Jika record berhasil dihapus, hapus file gambar dari server
    if (!empty($foto_filename)) {
        $file_path = "uploads/" . $foto_filename;
        if (file_exists($file_path)) {
            unlink($file_path); // Perintah PHP untuk menghapus file
        }
    }
    header("Location: index.php");
} else {
    echo "Error saat menghapus data: " . $stmt->error;
}
$stmt->close();
?>