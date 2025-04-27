<h2 class="text-center text-danger">🛒 Keranjang Belanja</h2>

<?php if (!empty($keranjang)): ?>
    <table class="table table-bordered text-center">
        <thead class="bg-danger text-white">
            <tr>
                <th>Nama Menu</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($keranjang as $item): ?>
                <tr>
                    <td><?= esc($item['nama_menu']) ?></td>
                    <td>
                        <form action="<?= base_url('home/keranjang_update') ?>" method="post" class="d-inline">
                            <input type="hidden" name="id_menu" value="<?= esc($item['id_menu']) ?>">
                            <button type="submit" name="action" value="kurang" class="btn btn-sm btn-danger">-</button>
                            <span class="mx-2"><?= esc($item['jumlah']) ?></span>
                            <button type="submit" name="action" value="tambah" class="btn btn-sm btn-success">+</button>
                        </form>
                    </td>
                    <td>Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td>Rp<?= number_format($item['total'], 0, ',', '.') ?></td>
                    <td>
                        <form action="<?= base_url('home/keranjang_update') ?>" method="post" class="d-inline">
                            <input type="hidden" name="id_menu" value="<?= esc($item['id_menu']) ?>">
                            <button type="submit" name="action" value="hapus" class="btn btn-sm btn-warning">❌ Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Belanja</th>
                <th>Rp<?= number_format($total_belanja, 0, ',', '.') ?></th>
                <th>
                    <a href="<?= base_url('home/checkout') ?>" class="btn btn-danger">Checkout</a>
                </th>
            </tr>
        </tfoot>
    </table>
<?php else: ?>
    <p>Keranjang kosong.</p>
<?php endif; ?>
