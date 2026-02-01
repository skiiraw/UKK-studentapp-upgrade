<?php
include_once("config.php");

/**
 * Legitimate websites always check if the ID is valid 
 * before trying to touch the database.
 */
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // 1. Securely fetch the filename using a Prepared Statement
    $stmt_select = $mysqli->prepare("SELECT foto_filename FROM siswa WHERE id = ?");
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $data = $result->fetch_assoc();
    $stmt_select->close();

    if ($data) {
        $foto_filename = $data['foto_filename'];

        // 2. Delete the record
        $stmt_delete = $mysqli->prepare("DELETE FROM siswa WHERE id = ?");
        $stmt_delete->bind_param("i", $id);

        if ($stmt_delete->execute()) {
            // 3. Clean up the physical file
            if (!empty($foto_filename)) {
                $file_path = "uploads/" . $foto_filename;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            // Success! Redirect back to the main list
            header("Location: index.php?status=deleted");
            exit();
        } else {
            $error_message = "Gagal menghapus data dari database.";
        }
        $stmt_delete->close();
    } else {
        $error_message = "Data siswa tidak ditemukan.";
    }
} else {
    $error_message = "ID tidak valid.";
}

/**
 * If the code reaches this point, it means an error occurred.
 * We show a styled error page that matches your beige theme.
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Error | Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fdfaf5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-card {
            background: white;
            padding: 40px;
            border-radius: 24px;
            border: 1.5px solid #f2e9dc;
            box-shadow: 0 15px 40px rgba(168, 148, 126, 0.08);
            text-align: center;
            max-width: 400px;
        }
        h2 { color: #e07a5f; margin-bottom: 10px; }
        p { color: #9c9185; margin-bottom: 25px; }
        .btn {
            text-decoration: none;
            background: #a8947e;
            color: white;
            padding: 10px 25px;
            border-radius: 12px;
            font-size: 14px;
            transition: 0.3s;
        }
        .btn:hover { background: #8e7d6a; }
    </style>
</head>
<body>
    <div class="error-card">
        <h2>Oops!</h2>
        <p><?php echo $error_message; ?></p>
        <a href="index.php" class="btn">Kembali ke Beranda</a>
    </div>
</body>
</html>
