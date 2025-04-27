<!-- app/Views/riwayat_pembayaran.php -->
<div class="container mt-4">
    <h4 class="mb-4"><i class="bi bi-journal-text"></i> Riwayat Pembayaran Pasien</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Pembayaran</th>
                <th>ID Booking</th>
                <th>ID Pasien</th>
                <th>Tanggal Pembayaran</th>
                <th>Total Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($riwayat_pembayaran as $pembayaran): ?>
                <tr>
                    <td><?= $pembayaran['id_pembayaran'] ?></td>
                    <td><?= $pembayaran['id_booking'] ?></td>
                    <td><?= $pembayaran['id_pasien'] ?></td>
                    <td><?= $pembayaran['tanggal_pembayaran'] ?></td>
                    <td><?= number_format($pembayaran['total'], 2, ',', '.') ?></td>
                    <td><?= $pembayaran['metode_pembayaran'] ?></td>
                    <td><?= $pembayaran['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
