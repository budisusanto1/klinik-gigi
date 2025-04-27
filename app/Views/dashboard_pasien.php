<h2>Dashboard Pasien</h2>
<p>Halo <strong><?= $nama ?></strong>, Anda login sebagai <strong>Pasien</strong>.</p>

<hr>
<h4>Apa yang ingin Anda lakukan?</h4>
<a href="<?= base_url('layanan') ?>"><button>Lihat Layanan</button></a>
<a href="<?= base_url('rekam_medis') ?>"><button>Lihat Rekam Medis</button></a>
<a href="<?= base_url('jadwal_kunjungan') ?>"><button>Lihat Jadwal Kunjungan</button></a>
