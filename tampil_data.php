<?php
include 'koneksi.php';
?>
<section class="booking-card" style="margin-top: 2rem;">
    <div class="booking-header">
        <h2 class="table-title">Daftar Data Reservasi Masuk (Read)</h2>
        <p class="table-subtitle">Berikut adalah riwayat data booking maintenance yang tersimpan di database.</p>
    </div>

    <div style="overflow-x: auto;">
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #f4f4f4;">
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>WhatsApp</th>
                    <th>Cabang</th>
                    <th>Layanan</th>
                    <th>Jadwal</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $result = mysqli_query($conn, "SELECT * FROM bookings ORDER BY id DESC");
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                    <td><?= htmlspecialchars($row['telepon']); ?></td>
                    <td><?= htmlspecialchars($row['cabang']); ?></td>
                    <td><?= htmlspecialchars($row['layanan']); ?></td>
                    <td><?= $row['tanggal'] . ' (' . $row['waktu'] . ')'; ?></td>
                    <td><?= htmlspecialchars($row['catatan']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" style="color: blue; text-decoration: none; margin-right: 10px;">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');" style="color: red; text-decoration: none;">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>