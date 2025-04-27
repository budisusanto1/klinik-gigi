<?php
// Ambil data pengaturan dari database
$db = db_connect();
$pengaturan = $db->table('pengaturan_app')->get()->getRow();
$level = session()->get('level'); // Ambil level user dari session
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?= esc($pengaturan->judul ?? 'Home') ?></title>
  <meta content="<?= esc($pengaturan->owner ?? 'Owner Aplikasi') ?>" name="author">
  <meta content="<?= esc($pengaturan->nama_app ?? 'Spedito - All in one place') ?>" name="description">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <link rel="shortcut icon" href="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" type="image/x-icon">
  <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
  <link id="dm-dark" rel="stylesheet" href="<?= base_url('assets/css/dark.css') ?>">
  <!-- Di <head> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Sebelum </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="page-home dm-dark">
  <div class="page-wrapper">
    <header class="page-header">
      <div class="page-header__top">
        <div class="uk-container">
          <nav class="uk-navbar-container uk-navbar-transparent" data-uk-navbar>
            <div class="uk-navbar-left">
              <button class="uk-button" type="button" data-uk-toggle data-uk-icon="menu"></button>
              <ul class="uk-navbar-nav">
                <div id="google_translate_element"></div>
                <li><a href="<?= base_url('home/hai') ?>">Home</a></li>
              <?php $role = session()->get('role'); ?>
<?php if ($role === 'admin'): ?>
<!-- Admin -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-toggle="collapse" href="#admin-nav">
        <i class="bi bi-gear"></i><span>Kelola Data</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
 <li><a href="<?= base_url('home/dokter') ?>"><i class="bi bi-circle"></i> Data Dokter</a></li>
    <li><a href="<?= base_url('home/jadwal') ?>"><i class="bi bi-circle"></i> Jadwal Dokter</a></li>
    <li><a href="<?= base_url('home/layanan') ?>"><i class="bi bi-circle"></i> Layanan Klinik</a></li>
    <li><a href="<?= base_url('home/user') ?>"><i class="bi bi-circle"></i> Users</a></li>
    <li><a href="<?= base_url('home/pasien') ?>"><i class="bi bi-circle"></i> Pasien</a></li>
    <li><a href="<?= base_url('home/booking') ?>"><i class="bi bi-circle"></i> Booking</a></li>
    <li><a href="<?= base_url('home/log_activity') ?>"><i class="bi bi-circle"></i> Log Aktivitas</a></li>
    <li><a href="<?= base_url('home/laporan') ?>"><i class="bi bi-file-earmark-text"></i> Laporan</a></li>

    <!-- Admin Konfirmasi Pembayaran Menu -->
    <li><a href="<?= base_url('home/konfirmasi_pembayaran') ?>"><i class="bi bi-check-circle"></i> Konfirmasi Pembayaran</a></li>
</ul>

<?php elseif ($role === 'dokter'): ?>
<!-- Dokter -->
<li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/jadwal') ?>"><i class="bi bi-calendar-check"></i> Jadwal Praktek</a></li>
<li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/pasien') ?>"><i class="bi bi-person-lines-fill"></i> Data Pasien</a></li>


<?php elseif ($role === 'pasien'): ?>
<!-- Pasien -->
<li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/layanan1') ?>"><i class="bi bi-info-circle"></i> Layanan Klinik</a></li>
<li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/jadwal_kunjungan') ?>"><i class="bi bi-calendar2-week"></i> Jadwal Kunjungan</a></li>
<li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/riwayat_pembayaran') ?>"><i class="bi bi-file-earmark-earphones"></i> status Pembayaran</a></li>

<?php elseif ($role === 'kasir'): ?>
<!-- Kasir -->
<li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/pembayaran') ?>"><i class="bi bi-credit-card"></i> Pembayaran Pasien</a></li>

<li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/riwayat_pembayaran') ?>"><i class="bi bi-file-earmark-earphones"></i> Riwayat Pembayaran</a></li>
<?php endif; ?>


<!-- Logout untuk semua role -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url('home/logout') ?>">
        <i class="bi bi-door-open-fill"></i> Logout
    </a>
</li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
      <div class="page-header__bottom">
        <div class="uk-container">
          <div class="uk-navbar-container uk-navbar-transparent" data-uk-navbar>
            <div class="uk-navbar-left">
              <div class="block-with-phone">
             <!--    <img src="<?= base_url('assets/img/icons/delivery.svg') ?>" alt="delivery" data-uk-svg>
                <div>
                  <span>For Delivery, Call us</span>
                  <a href="tel:13205448749">1-320-544-8749</a>
                </div>
              </div>
            </div>
            <div class="uk-navbar-center"></div>
            <div class="uk-navbar-right">
              <div class="other-links">
                <ul class="other-links-list">
                  <li><a href="#modal-full" data-uk-toggle><span data-uk-icon="search"></span></a></li>
                  <li><a href="#!"><span data-uk-icon="user"></span></a></li>
                  <li><a href="<?= base_url('home/lihat_keranjang') ?>"><span data-uk-icon="cart"></span></a></li>
                </ul>
                <a class="uk-button" href="<?= base_url('page-pizza-builder.html') ?>">
                  <span>Make Your Pizza</span>
                  <img class="uk-margin-small-left" src="<?= base_url('assets/img/icons/pizza.png') ?>" alt="pizza">
                </a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </header>


<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            includedLanguages: 'en,id',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
      var timeout = 300; // Waktu dalam detik (5 menit)
      var logoutUrl = "<?= site_url('home/logout') ?>";
      var resetTime = timeout * 1000; // Konversi ke milidetik

      function resetTimer() {
          clearTimeout(timer);
          timer = setTimeout(function() {
              window.location.href = logoutUrl;
          }, resetTime);
      }

      var timer = setTimeout(function() {
          window.location.href = logoutUrl;
      }, resetTime);

      document.addEventListener("mousemove", resetTimer);
      document.addEventListener("keypress", resetTimer);
      document.addEventListener("click", resetTimer);
    </script>
  </body>
</html>
