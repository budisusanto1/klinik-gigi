<h2>Dashboard Dokter</h2>
<p>Halo <strong><?= $nama ?></strong>, Anda login sebagai <strong>Dokter</strong>.</p>

<hr>
<h4>Rekam Medis Anda</h4>
<ul>
    <?php foreach ($rekam_medis ?? [] as $r): ?>
        <li><?= $r->diagnosa ?> - <?= $r->tanggal_periksa ?></li>
    <?php endforeach ?>
</ul>
