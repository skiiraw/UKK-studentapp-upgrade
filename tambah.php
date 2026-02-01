<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        form { border: 1px solid #ddd; padding: 20px; border-radius: 5px; width: 50%; }
        table { border-collapse: collapse; width: 100%; }
        td { padding: 8px; }
        input[type=text], input[type=number] { width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        input[type=submit] { background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        a { text-decoration: none; }
    </style>
</head>
<body>
    <h2>Tambah Siswa Baru</h2>
    <p><a href="index.php"> &larr; Kembali ke Daftar Siswa</a></p>

    <form action="proses_tambah.php" method="post" enctype="multipart/form-data">
        <table>
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr> 
                <td>Nomor Presensi</td>
                <td><input type="number" name="nomor_presensi" required></td>
            </tr>
            <tr> 
                <td>Kelas</td>
                <td><input type="text" name="kelas" required></td>
            </tr>
            <tr> 
                <td>Foto</td>
                <td><input type="file" name="foto" required accept="image/*"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="submit" value="Tambah Data"></td>
            </tr>
        </table>
    </form>
</body>
</html>