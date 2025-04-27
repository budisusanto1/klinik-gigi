<div class="container mt-4">
    <h2>Detail Pesanan #<?= $order['id_order']; ?></h2>
    <table class="table table-bordered">
        <tr>
            <th>Nama Customer</th>
            <td><?= $order['nama_customer']; ?></td>
        </tr>
        <tr>
            <th>Restoran</th>
            <td><?= $order['nama_restoran']; ?></td>
        </tr>
        <tr>
            <th>Tanggal Order</th>
            <td><?= $order['tanggal_order']; ?></td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp<?= number_format($order['total_harga'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th>Status Order</th>
            <td><?= $order['status_order']; ?></td>
        </tr>
        <tr>
            <th>Status Pengiriman</th>
            <td><?= $order['status_pengiriman']; ?></td>
        </tr>
    </table>

    <h3>Detail Menu</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Menu</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($order['detail_menu'])): ?>
                <?php foreach ($order['detail_menu'] as $menu) : ?>
                    <tr>
                        <td><?= $menu['nama_menu']; ?></td>
                        <td><?= $menu['jumlah']; ?></td>
                        <td>Rp<?= number_format($menu['harga'], 0, ',', '.'); ?></td>
                        <td>Rp<?= number_format($menu['jumlah'] * $menu['harga'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Detail menu tidak ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="<?= base_url('home/orderdetail'); ?>" class="btn btn-secondary">Kembali</a>
</div>
