<?php
include_once("config.php");

// Cek apakah parameter id ada di URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Ambil data siswa dari database berdasarkan id
$stmt = $mysqli->prepare("SELECT * FROM siswa WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if (!$data) {
    echo "Data tidak ditemukan!";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
    
    <style>
        body { font-family: sans-serif; margin: 40px; }
        form { border: 1px solid #ddd; padding: 20px; border-radius: 5px; width: 50%; }
        table { border-collapse: collapse; width: 100%; }
        td { padding: 8px; }
        input[type=text], input[type=number] { width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        input[type=submit] { background-color: #ffc107; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        a { text-decoration: none; }
        img { width: 150px; height: auto; display: block; margin-bottom: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Edit Data Siswa</h2>
    <p><a href="index.php"> &larr; Kembali ke Daftar Siswa</a></p>

    <form action="proses_edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <input type="hidden" name="old_foto_filename" value="<?php echo htmlspecialchars($data['foto_filename']); ?>">
        
        <table>
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required></td>
            </tr>
            <tr> 
                <td>Nomor Presensi</td>
                <td><input type="number" name="nomor_presensi" value="<?php echo htmlspecialchars($data['nomor_presensi']); ?>" required></td>
            </tr>
            <tr> 
                <td>Kelas</td>
                <td><input type="text" name="kelas" value="<?php echo htmlspecialchars($data['kelas']); ?>" required></td>
            </tr>
            <tr> 
                <td>Foto Saat Ini</td>
                <td>
                    <?php if (!empty($data['foto_filename']) && file_exists("uploads/" . $data['foto_filename'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($data['foto_filename']); ?>" alt="Foto saat ini">
                    <?php else: ?>
                        <p>Tidak ada foto.</p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr> 
                <td>Ganti Foto (Opsional)</td>
                <td><input type="file" name="foto" accept="image/*"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="update" value="Update Data"></td>
            </tr>
        </table>
    </form>
</body>
</html>