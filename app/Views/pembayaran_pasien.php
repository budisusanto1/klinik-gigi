<div class="container mt-4">
    <h4 class="mb-4"><i class="bi bi-credit-card"></i> Pembayaran Pasien</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('home/proses_pembayaran') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="id_booking" class="form-label">Booking (Selesai)</label>
            <select name="id_booking" class="form-control" required id="id_booking">
                <option value="">-- Pilih Booking --</option>
                <?php foreach ($bookings as $booking): ?>
                    <option value="<?= $booking['id_booking'] ?>" data-harga="<?= $booking['total_biaya'] ?>">
                        <?= $booking['id_pasien'] ?> - <?= $booking['tanggal_kunjungan'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-control" required>
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
                <option value="Kartu Kredit">Kartu Kredit</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total Pembayaran</label>
            <input type="number" name="total" class="form-control" required readonly value="<?= isset($booking) ? $booking['total_biaya'] : '' ?>" id="total">
        </div>

        <div class="mb-3">
            <label for="uang_diberikan" class="form-label">Uang Diberikan</label>
            <input type="number" name="uang_diberikan" class="form-control" required id="uang_diberikan" min="0">
        </div>

        <div class="mb-3">
            <label for="uang_kembali" class="form-label">Uang Kembali</label>
            <input type="number" name="uang_kembali" class="form-control" readonly id="uang_kembali">
        </div>

        <button type="submit" class="btn btn-primary">Proses Pembayaran</button>
    </form>
</div>

<script>
    // Menghitung uang kembali saat uang yang diberikan diubah
    document.getElementById('uang_diberikan').addEventListener('input', function() {
        var total = parseFloat(document.getElementById('total').value);
        var uangDiberikan = parseFloat(this.value);
        var uangKembali = uangDiberikan - total;

        // Tampilkan uang kembali jika valid
        if (!isNaN(uangKembali) && uangKembali >= 0) {
            document.getElementById('uang_kembali').value = uangKembali.toFixed(2);
        } else {
            document.getElementById('uang_kembali').value = '';
        }
    });

    // Set total biaya saat booking dipilih
    document.getElementById('id_booking').addEventListener('change', function() {
        var harga = this.options[this.selectedIndex].getAttribute('data-harga');
        document.getElementById('total').value = harga;
        document.getElementById('uang_kembali').value = '';
    });
</script>
