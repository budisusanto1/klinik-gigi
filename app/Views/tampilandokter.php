<main id="main" class="main">
  <div class="pagetitle">
    <h1>Table Dokter</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('Home') ?>">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Dokter</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <!-- Tombol untuk menambah dokter -->
            <button class="btn btn-success mb-3">
              <a href="<?= base_url('Home/tambahdokter') ?>" class="text-white">Tambah Dokter</a>
            </button>

            <!-- Tabel Dokter -->
            <table class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th scope="col" width="3%">No</th>
                  <th>Akun User</th>
                  <th>No HP</th>
                  <th>Nama Dokter</th>
                  <th>Spesialisasi</th>
                  <th>NIP</th>
                  <th>Alamat</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $ms = 1;
                if (!empty($dokter_data)): // Menambahkan pengecekan data kosong ?>
                  <?php foreach ($dokter_data as $dokter): ?>
                    <tr>
                      <th scope="row"><?= $ms++ ?></th>
                      <td><?= $dokter->username ?></td>
                      <td><?= $dokter->no_telepon ?></td>
                      <td><?= $dokter->nama_dokter ?></td>
                      <td><?= $dokter->spesialisasi ?></td>
                      <td><?= $dokter->nip ?></td>
                      <td><?= $dokter->alamat ?></td>
                      <td>
                        <?php if (!empty($dokter->foto)): ?>
                          <img src="<?= base_url('uploads/'.$dokter->foto) ?>" alt="Foto Dokter" width="50">
                        <?php else: ?>
                          <img src="<?= base_url('uploads/default.jpg') ?>" alt="Foto Default" width="50">
                        <?php endif; ?>
                      </td>
                      <td><?= $dokter->status ?></td>
                      <td>
                        <!-- Tombol untuk mengedit dokter -->
                        <a href="<?= base_url('Home/edit_dokter/'.$dokter->id_dokter) ?>" class="btn btn-warning">✏️ Edit</a>
                        <!-- Tombol untuk menghapus dokter -->
                        <a href="<?= base_url('Home/hapus_dokter/'.$dokter->id_dokter) ?>" class="btn btn-danger" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus dokter ini?');">
                          <i class="ri-delete-bin-line"></i>🗑️ Hapus
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="10" class="text-center">Tidak ada data dokter yang tersedia.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
