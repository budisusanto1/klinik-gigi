<h2>Dashboard Admin</h2>
<p>Halo <strong><?= $nama ?></strong>, Anda login sebagai <strong>Admin</strong>.</p>

<hr>
<h4>Statistik Klinik</h4>
<p>Jumlah Dokter: <?= count($jumlah_dokter ?? []) ?></p>
<p>Jumlah Pasien: <?= count($jumlah_pasien ?? []) ?></p>

<!-- <h5>Laporan Keuangan</h5> -->
<!-- <table border="1" cellpadding="5">
    <tr><th>Tanggal</th><th>Metode</th><th>Total</th><th>Transaksi</th></tr>
    <?php foreach ($laporan ?? [] as $l): ?>
    <tr>
        <td><?= $l['tanggal_pembayaran'] ?></td>
        <td><?= $l['metode_pembayaran'] ?></td>
        <td>Rp<?= number_format($l['total_pendapatan']) ?></td>
        <td><?= $l['jumlah_transaksi'] ?></td>
    </tr>
    <?php endforeach ?>
</table>
 -->