<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa | Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #a8947e;
            --primary-hover: #8e7d6a;
            --bg-body: #fdfaf5;
            --bg-card: #ffffff;
            --border-beige: #f2e9dc;
            --text-main: #4a443e;
            --text-muted: #9c9185;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-container {
            background: var(--bg-card);
            max-width: 600px;
            width: 100%;
            padding: 40px;
            border-radius: 24px;
            border: 1.5px solid var(--border-beige);
            box-shadow: 0 15px 40px rgba(168, 148, 126, 0.08);
            animation: slideUp 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .header-section { margin-bottom: 30px; }

        .btn-back {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            margin-bottom: 15px;
            transition: 0.3s;
        }
        .btn-back:hover { color: var(--primary); }

        h2 { margin: 0; font-weight: 600; font-size: 1.6rem; letter-spacing: -0.5px; }

        .form-group { margin-bottom: 20px; }

        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input[type=text], 
        input[type=number] {
            width: 100%;
            padding: 14px 18px;
            box-sizing: border-box;
            border: 1.5px solid var(--border-beige);
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: all 0.3s;
            background: #fdfdfd;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(168, 148, 126, 0.1);
            background: white;
        }

        /* Modern File Upload Wrapper */
        .upload-area {
            border: 2px dashed var(--border-beige);
            padding: 20px;
            border-radius: 16px;
            text-align: center;
            background: #fcfcfb;
            transition: 0.3s;
            cursor: pointer;
            position: relative;
        }

        .upload-area:hover { border-color: var(--primary); background: #f9f7f4; }

        #imagePreview {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 10px;
            display: none; /* Hidden until file chosen */
            margin-left: auto;
            margin-right: auto;
            border: 2px solid white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .upload-text { font-size: 13px; color: var(--text-muted); display: block; }

        .submit-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(168, 148, 126, 0.2);
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="header-section">
        <a href="index.php" class="btn-back">← Kembali ke Daftar</a>
        <h2>Registrasi Siswa Baru</h2>
    </div>

    <form action="proses_tambah.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Contoh: Budi Santoso" required>
        </div>

        <div style="display: flex; gap: 20px;">
            <div class="form-group" style="flex: 1;">
                <label>No. Presensi</label>
                <input type="number" name="nomor_presensi" placeholder="00" required>
            </div>
            <div class="form-group" style="flex: 2;">
                <label>Kelas</label>
                <input type="text" name="kelas" placeholder="Contoh: XI RPL 1" required>
            </div>
        </div>

        <div class="form-group">
            <label>Foto Identitas</label>
            <div class="upload-area" onclick="document.getElementById('fotoInput').click();">
                <img id="imagePreview" src="" alt="Preview">
                <span class="upload-text" id="uploadText">Klik untuk pilih foto</span>
                <input type="file" name="foto" id="fotoInput" accept="image/*" required style="display: none;">
            </div>
        </div>

        <button type="submit" name="submit" class="submit-btn">Tambah Siswa Baru</button>
    </form>
</div>

<script>
    // Live Image Preview script
    const fotoInput = document.getElementById('fotoInput');
    const imagePreview = document.getElementById('imagePreview');
    const uploadText = document.getElementById('uploadText');

    fotoInput.onchange = evt => {
        const [file] = fotoInput.files;
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
            uploadText.innerText = "Ganti Foto: " + file.name;
        }
    }
</script>

</body>
</html>
