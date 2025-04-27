<main id="main" class="main">
  <div class="pagetitle">
    <h1 class="text-primary"><i class="bi bi-calendar-event-fill"></i> Daftar Jadwal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">🏠 Home</a></li>
        <li class="breadcrumb-item">📅 Jadwal</li>
        <li class="breadcrumb-item active text-primary">📆 Data Jadwal</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card shadow border-0">
          <div class="card-body">
            <a href="<?= base_url('home/tambahjadwal'); ?>" class="btn btn-primary mb-3">
              ➕ Tambah Jadwal
            </a>

            <div class="table-responsive">
              <table class="table table-hover table-bordered text-center">
                <thead class="bg-primary text-white">
                  <tr>
                    <th>No</th>
                    <th>Dokter</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody class="bg-light">
                  <?php if (!empty($rpl12)): ?>
                    <?php $no = 1; foreach ($rpl12 as $row): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row->nama_dokter) ?></td>
                        <td><?= htmlspecialchars($row->hari) ?></td>
                        <td><?= htmlspecialchars($row->jam_mulai) ?></td>
                        <td><?= htmlspecialchars($row->jam_selesai) ?></td>
                        <td><?= htmlspecialchars($row->status) ?></td>
                        <td>
                          <a href="<?= base_url('home/edit_jadwal/'.$row->id_jadwal) ?>" class="btn btn-warning btn-sm">
                            ✏️ Edit
                          </a>
                          <a href="<?= base_url('home/hapus_jadwal/'.$row->id_jadwal) ?>" class="btn btn-danger btn-sm"
                             onclick="return confirm('Yakin ingin menghapus jadwal ini?');">
                            🗑️ Hapus
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="7">Tidak ada data jadwal.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div> <!-- End Table -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
