<div class="keranjang-box mt-4">
    <div class="keranjang-title">🦷 Riwayat Kunjungan Pasien</div>

    <?php if (!empty($kunjungan)): ?>
        <div class="pastel-scroll">
            <?php foreach ($kunjungan as $r): ?>
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div><strong>Tanggal Kunjungan:</strong> <?= $r->tanggal_kunjungan ?></div>
                            <div><strong>Dokter:</strong> drg. <?= $r->nama_dokter ?></div>
                            <div><strong>Status:</strong> <?= $r->status ?></div>

                            <?php
                                $today = date('Y-m-d');
                                $now = strtotime(date('H:i:s'));
                                $jadwalTime = strtotime($r->jam_kunjungan);
                                $selisih = $jadwalTime - $now;
                            ?>

                            <?php if ($r->tanggal_kunjungan == $today && $r->status == 'Menunggu Konfirmasi'): ?>
                                <?php if ($r->konfirmasi_kedatangan == NULL): ?>
                                    <?php if ($selisih <= 3600 && $selisih > 0): ?>
                                        <form method="post" action="<?= base_url('home/konfirmasiKedatangan/' . $r->id_booking) ?>">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="Akan Datang" required>
                                                <label class="form-check-label">Akan Datang</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="Batal Datang" required>
                                                <label class="form-check-label">Batal Datang</label>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-outline-primary mt-2">Konfirmasi</button>
                                        </form>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div><strong>Status Konfirmasi:</strong>
                                        <?php if ($r->konfirmasi_kedatangan == 'Akan Datang'): ?>
                                            <span class="badge bg-info text-dark">✅ Akan Datang</span>
                                        <?php elseif ($r->konfirmasi_kedatangan == 'Batal Datang'): ?>
                                            <span class="badge bg-secondary">❌ Batal Datang</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="text-end">
                            <?php if ($r->status == 'Menunggu Konfirmasi'): ?>
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            <?php elseif ($r->status == 'Diterima'): ?>
                                <span class="badge bg-success">Diterima</span>
                            <?php elseif ($r->status == 'Selesai'): ?>
                                <a href="<?= base_url('pasien/detail_riwayat/' . $r->id_booking) ?>" class="btn btn-sm btn-primary">🧾 Detail</a>
                            <?php elseif ($r->status == 'Dibatalkan'): ?>
                                <span class="badge bg-danger">Dibatalkan</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Belum ada riwayat kunjungan.</p>
    <?php endif; ?>
</div>
<script>
document.querySelectorAll('.btn-konfirmasi').forEach(function (button) {
    button.addEventListener('click', function () {
        const idBooking = this.getAttribute('data-id');
        document.getElementById('inputIdBooking').value = idBooking;
        const modal = new bootstrap.Modal(document.getElementById('modalKonfirmasi'));
        modal.show();
    });
});
</script>
