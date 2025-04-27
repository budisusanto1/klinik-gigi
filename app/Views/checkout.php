<h2>Checkout</h2>
<p>Pastikan pesanan Anda sudah benar sebelum menyelesaikan pembelian.</p>

<?php if (!empty($keranjang)): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nama Menu</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        <?php $totalHarga = 0; ?>
        <?php foreach ($keranjang as $item): ?>
            <tr>
                <td><?= esc($item['nama_menu'] ?? 'Tidak Diketahui'); ?></td>
                <td><?= esc($item['jumlah'] ?? 0); ?></td>
                <td>Rp<?= number_format($item['harga'] ?? 0, 0, ',', '.'); ?></td>
                <td>Rp<?= number_format(($item['harga'] ?? 0) * ($item['jumlah'] ?? 0), 0, ',', '.'); ?></td>
            </tr>
            <?php $totalHarga += ($item['harga'] ?? 0) * ($item['jumlah'] ?? 0); ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>Rp<?= number_format($totalHarga, 0, ',', '.'); ?></strong></td>
        </tr>
    </table>

   <form action="<?= base_url('home/proses_checkout') ?>" method="post">
    <input type="hidden" name="total_harga" value="<?= $totalHarga; ?>">
    <button type="submit" class="btn btn-success">Checkout</button>


        <label for="metode_pembayaran"><strong>Pilih Metode Pembayaran:</strong></label>
        <select name="metode_pembayaran" required>
            <option value="Gopay">Gopay</option>
            <option value="OVO">OVO</option>
            <option value="Dana">Dana</option>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="Tunai">Tunai</option>
        </select>

        <button type="submit" class="btn btn-success">Bayar Sekarang</button>
    </form>

<?php else: ?>
    <p class="text-danger">Keranjang belanja Anda masih kosong.</p>
<?php endif; ?>
