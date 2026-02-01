# Student App
Aplikasi untuk pengujian konsep Cloud Computing dan ITNSA

([UKK2025.drawio.png](https://github.com/adinur21/studentapp/blob/main/UKK2025.drawio.png))

1. Deploy di VM CentOS dengan Apache, Git
   ```bash
   sudo yum update -y
   sudo yum install -y git httpd php php-mysqlnd 
   
2. Konfigurasi file config.php sesuai dengan credentials service AWS anda
3. SQL untuk membuat tabel. Jalankan query ini di database RDS Anda (misalnya melalui MySQL Workbench atau DBeaver) untuk membuat tabel siswa.
   ```bash
   CREATE DATABASE db_sekolah;
   USE db_sekolah;
   CREATE TABLE siswa (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    nomor_presensi INT(11) NOT NULL,
    kelas VARCHAR(100) NOT NULL,
    foto_filename VARCHAR(255) NULL -- Menyimpan nama file foto
   );

4. Buat direktori baru di dalam folder aplikasi untuk menyimpan file foto
   ```bash
   sudo mkdir /var/www/html/uploads
5. Atur izin direktory upload
   ```bash
   sudo chown apache:apache /var/www/html/uploads
6. Pastikan SELinux diizinkan mengakases RDS (optional)
   ```bash
   sudo setsebool -P httpd_can_network_connect 1
7. Konfigurasi DNS di MikroTik dengan ketentuan http://namaanda.internal
8. Test 
