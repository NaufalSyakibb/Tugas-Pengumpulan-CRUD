<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM bookings WHERE id = '$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update_booking'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama_pelanggan']);
    $telepon  = mysqli_real_escape_string($conn, $_POST['telepon']);
    $cabang   = mysqli_real_escape_string($conn, $_POST['cabang']);
    $layanan  = mysqli_real_escape_string($conn, $_POST['layanan']);
    $tanggal  = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $waktu    = mysqli_real_escape_string($conn, $_POST['waktu']);
    $catatan  = mysqli_real_escape_string($conn, $_POST['catatan']);

    $query = "UPDATE bookings SET 
                nama_pelanggan='$nama', 
                telepon='$telepon', 
                cabang='$cabang', 
                layanan='$layanan', 
                tanggal='$tanggal', 
                waktu='$waktu', 
                catatan='$catatan' 
              WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking Maintenance</title>
    <!-- Masukkan style CSS utama Anda di sini -->
</head>
<body>
    <div style="max-width: 600px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
        <h2>Edit Data Booking</h2>
        <form action="" method="POST">
            <p>
                <label>Nama Lengkap:</label><br>
                <input type="text" name="nama_pelanggan" value="<?= $row['nama_pelanggan']; ?>" required style="width: 100%; padding: 8px;">
            </p>
            <p>
                <label>Nomor WhatsApp:</label><br>
                <input type="text" name="telepon" value="<?= $row['telepon']; ?>" required style="width: 100%; padding: 8px;">
            </p>
            <p>
                <label>Cabang Bengkel:</label><br>
                <input type="text" name="cabang" value="<?= $row['cabang']; ?>" required style="width: 100%; padding: 8px;">
            </p>
            <p>
                <label>Jenis Layanan:</label><br>
                <input type="text" name="layanan" value="<?= $row['layanan']; ?>" required style="width: 100%; padding: 8px;">
            </p>
            <p>
                <label>Tanggal Kedatangan:</label><br>
                <input type="date" name="tanggal" value="<?= $row['tanggal']; ?>" required style="width: 100%; padding: 8px;">
            </p>
            <p>
                <label>Jam Kedatangan:</label><br>
                <input type="text" name="waktu" value="<?= $row['waktu']; ?>" required style="width: 100%; padding: 8px;">
            </p>
            <p>
                <label>Catatan Keluhan:</label><br>
                <textarea name="catatan" rows="3" style="width: 100%; padding: 8px;"><?= $row['catatan']; ?></textarea>
            </p>
            <button type="submit" name="update_booking" style="padding: 10px 20px; background: green; color: white; border: none; cursor: pointer;">Simpan Perubahan</button>
            <a href="index.php" style="margin-left: 10px; text-decoration: none; color: gray;">Batal</a>
        </form>
    </div>
</body>
</html>