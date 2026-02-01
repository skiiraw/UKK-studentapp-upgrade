<?php
// --- KONFIGURASI DATABASE AWS RDS ---
$db_host = 'GANTI_DENGAN_ENDPOINT_RDS_ANDA'; // Endpoint dari RDS console
$db_user = 'admin'; // Username master yang Anda buat di RDS
$db_pass = 'PASSWORD_RDS_ANDA'; // Password master yang Anda buat di RDS
$db_name = 'db_sekolah'; // Nama database yang Anda buat di RDS

// Membuat koneksi ke database
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if ($mysqli->connect_error) {
    // Untuk debugging, tampilkan error. Di produksi, catat ke log.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    die("Koneksi database gagal: " . $mysqli->connect_error);
}
?>