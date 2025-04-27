<div class="container mt-4">
    <h2 class="text-center text-danger">Metode Pembayaran</h2>

    <?php if (isset($order)): ?>
        <!-- Menampilkan detail pesanan -->
        <p><strong>Nomor Pesanan:</strong> <?= esc($order['id_order']) ?></p>
        <p><strong>Total Harga:</strong> Rp<?= number_format($order['total_harga'], 0, ',', '.') ?></p>

        <!-- Form untuk memilih metode pembayaran -->
        <form action="<?= base_url('home/proses_pembayaran') ?>" method="post">
            <input type="hidden" name="id_order" value="<?= esc($order['id_order']) ?>">

            <!-- Pilih metode pembayaran -->
            <label for="metode_pembayaran">Pilih Metode Pembayaran:</label>
            <select name="metode_pembayaran" id="metode_pembayaran" required>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="Gopay">Gopay</option>
                <option value="OVO">OVO</option>
                <option value="Dana">Dana</option>
                <option value="Cash On Delivery">COD (Bayar di Tempat)</option>
            </select>

            <!-- Tombol untuk mengonfirmasi pembayaran -->
            <button type="submit" class="btn btn-danger">Bayar Sekarang</button>
        </form>
    <?php endif; ?>
</div>
