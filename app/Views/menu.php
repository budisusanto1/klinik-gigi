<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('dashboard') ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <?php $role = session()->get('role'); ?>

        <?php if ($role === 'admin'): ?>
        <!-- Admin -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#admin-nav">
                <i class="bi bi-gear"></i><span>Kelola Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="admin-nav" class="nav-content collapse">
                <li><a href="<?= base_url('home/dokter') ?>"><i class="bi bi-circle"></i>Data Dokter</a></li>
                <li><a href="<?= base_url('home/jadwal') ?>"><i class="bi bi-circle"></i>Jadwal Dokter</a></li>
                <li><a href="<?= base_url('home/layanan') ?>"><i class="bi bi-circle"></i>Layanan Klinik</a></li>
                <li><a href="<?= base_url('home/user') ?>"><i class="bi bi-circle"></i>Users</a></li>
                  <li><a href="<?= base_url('home/pasien') ?>"><i class="bi bi-circle"></i>pasien</a></li>
                    <li><a href="<?= base_url('home/booking') ?>"><i class="bi bi-circle"></i>booking</a></li>
                <li><a href="<?= base_url('home/log_activity') ?>"><i class="bi bi-circle"></i>Log Aktivitas</a></li>
                <li><a href="<?= base_url('home/laporan') ?>"><i class="bi bi-file-earmark-text"></i>Laporan</a></li>
            </ul>
        </li>
        <?php endif; ?>

        <?php if ($role === 'dokter'): ?>
        <!-- Dokter -->
        <li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/jadwal') ?>"><i class="bi bi-calendar-check"></i>Jadwal Praktek</a></li>
        <li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/rekam_medis') ?>"><i class="bi bi-journal-medical"></i>Rekam Medis</a></li>
        <li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/pasien') ?>"><i class="bi bi-person-lines-fill"></i>Data Pasien</a></li>
        <?php endif; ?>

        <?php if ($role === 'resepsionis'): ?>
        <!-- Resepsionis -->
        <li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/pasien') ?>"><i class="bi bi-person-plus"></i>Data Pasien</a></li>
        <li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/jadwal') ?>"><i class="bi bi-calendar-event"></i>Jadwal Kunjungan</a></li>
        <li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/pembayaran') ?>"><i class="bi bi-wallet2"></i>Pembayaran</a></li>
        <?php endif; ?>

        <?php if ($role === 'pasien'): ?>
        <!-- Pasien -->
        <li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/layanan1') ?>"><i class="bi bi-info-circle"></i>Layanan Klinik</a></li>
        <li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/rekam_medis_saya') ?>"><i class="bi bi-file-medical"></i>Rekam Medis Saya</a></li>
        <li class="nav-item"><a class="nav-link collapsed" href="<?= base_url('home/jadwal_kunjungan') ?>"><i class="bi bi-calendar2-week"></i>Jadwal Kunjungan</a></li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('logout') ?>">
                <i class="bi bi-door-open-fill"></i>Logout
            </a>
        </li>

    </ul>
</aside>
