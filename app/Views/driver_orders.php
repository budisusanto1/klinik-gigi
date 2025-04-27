<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan Driver</title>
</head>
<body>
    <h1>Daftar Pesanan Driver</h1>

    <!-- Tabel Daftar Pesanan -->
    <table border="1">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Tanggal Order</th>
                <th>Total Harga</th>
                <th>Status Order</th>
                <th>Status Pengiriman</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= esc($order['id_order']) ?></td>
                        <td><?= esc($order['tanggal_order']) ?></td>
                        <td>Rp<?= number_format($order['total_harga'], 0, ',', '.') ?></td>
                        <td><?= esc($order['status_order']) ?></td>
                        <td><?= esc($order['status_pengiriman']) ?></td>
                        <td><?= esc($order['status_pembayaran']) ?></td>
                        <td>
                            <!-- Aksi untuk konfirmasi atau batal pengiriman -->
                            <a href="<?= base_url('home/konfirmasi_pengiriman/' . esc($order['id_order'])) ?>" class="btn btn-success">Konfirmasi Pengiriman</a>
                            <a href="<?= base_url('home/batal_pengiriman/' . esc($order['id_order'])) ?>" class="btn btn-danger">Batal Pengiriman</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Tidak ada pesanan untuk driver ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
