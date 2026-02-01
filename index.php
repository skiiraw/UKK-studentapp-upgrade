<?php include_once("config.php"); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa | Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Soft Beige Palette */
            --primary: #a8947e;           /* Muted Earth Tone */
            --primary-hover: #8e7d6a;
            --bg-body: #fdfaf5;           /* Very soft cream */
            --bg-card: #ffffff;
            --border-beige: #f2e9dc;      /* The soft beige border you asked for */
            --text-main: #4a443e;         /* Warm dark brown instead of harsh black */
            --text-muted: #9c9185;
            --accent-edit: #d4a373;       /* Warm sand */
            --accent-delete: #e07a5f;     /* Muted terracotta */
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 40px 20px;
            background-color: var(--bg-body);
            color: var(--text-main);
        }

        /* Entry Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background-color: var(--bg-card);
            padding: 40px;
            border-radius: 24px;
            /* Using beige for the main shadow and border */
            border: 1px solid var(--border-beige);
            box-shadow: 0 15px 40px rgba(168, 148, 126, 0.1);
            animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        h2 {
            margin: 0;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        /* Button Styling */
        .btn {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            padding: 10px 22px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-add {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(168, 148, 126, 0.2);
        }

        .btn-add:hover {
            background-color: var(--primary-hover);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(168, 148, 126, 0.3);
        }

        /* Table Design */
        table {
            border-collapse: separate;
            border-spacing: 0 12px;
            width: 100%;
        }

        th {
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1.5px;
            padding: 0 20px;
        }

        td {
            background-color: #fff;
            padding: 18px 20px;
            border-top: 1.5px solid var(--border-beige);
            border-bottom: 1.5px solid var(--border-beige);
            transition: transform 0.3s ease;
        }

        /* Soft rounded rows */
        tr td:first-child { border-left: 1.5px solid var(--border-beige); border-top-left-radius: 16px; border-bottom-left-radius: 16px; }
        tr td:last-child { border-right: 1.5px solid var(--border-beige); border-top-right-radius: 16px; border-bottom-right-radius: 16px; }

        tr {
            animation: slideInRight 0.5s ease backwards;
        }

        tr:hover td {
            background-color: #fefcf9;
            transform: scale(1.005);
            border-color: #d6ccc2; /* Slightly darker beige on hover */
        }

        .student-photo {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 14px; /* Squircle looks more "modern" than a circle */
            border: 2px solid var(--border-beige);
        }

        .badge {
            background: #f5f0e8;
            color: var(--primary);
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
        }

        .actions .btn {
            margin-left: 5px;
            background: transparent;
        }

        .btn-edit { color: var(--accent-edit); border: 1.5px solid var(--accent-edit); }
        .btn-edit:hover { background: var(--accent-edit); color: white; }

        .btn-delete { color: var(--accent-delete); border: 1.5px solid var(--accent-delete); }
        .btn-delete:hover { background: var(--accent-delete); color: white; }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h2>Daftar Siswa</h2>
        <a href="tambah.php" class="btn btn-add"> + Tambah Siswa</a>
    </header>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>No. Presensi</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $mysqli->query("SELECT * FROM siswa ORDER BY id DESC");
                $delay = 0;
                while ($row = $result->fetch_assoc()) {
                    $delay += 0.1; // Staggered delay for each row
                    $foto_path = "uploads/" . htmlspecialchars($row['foto_filename']);
                    $has_photo = !empty($row['foto_filename']) && file_exists($foto_path);
                    ?>
                    <tr style="animation-delay: <?= $delay ?>s">
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <?php if ($has_photo): ?>
                                    <img src="<?= $foto_path ?>" class="student-photo" alt="Profile">
                                <?php else: ?>
                                    <div class="student-photo" style="background: #f5f0e8; display:flex; align-items:center; justify-content:center; color:var(--text-muted)">N/A</div>
                                <?php endif; ?>
                                <span style="font-weight: 500;"><?= htmlspecialchars($row['nama']) ?></span>
                            </div>
                        </td>
                        <td style="color: var(--text-muted);"><?= htmlspecialchars($row['nomor_presensi']) ?></td>
                        <td><span class="badge"><?= htmlspecialchars($row['kelas']) ?></span></td>
                        <td>
                            <div class="actions">
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')" class="btn btn-delete">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
