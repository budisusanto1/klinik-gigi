<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Dokter</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('Home') ?>">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Edit Dokter</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Form Edit Dokter</h2>

            <form action="<?= base_url('Home/aksi_e_dokter') ?>" method="post" enctype="multipart/form-data">
              <!-- Pilih Akun User -->
              <div class="form-group mb-3">
                <label for="id_user" class="form-label">Akun User</label>
                <select class="form-control" name="id_user" required>
                  <option value="">Pilih</option>
                  <?php foreach ($RPL12A as $user): ?>
                    <option value="<?= $user->id_user ?>" <?= $user->id_user == $es1->id_user ? 'selected' : '' ?>>
                      <?= $user->username ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <!-- No HP -->
              <div class="form-group mb-3">
                <label for="no_telepon" class="form-label">No HP</label>
                <input type="text" class="form-control" name="no_telepon" placeholder="No HP" value="<?= $es1->no_telepon ?>" required>
              </div>

              <!-- Nama Dokter -->
              <div class="form-group mb-3">
                <label for="nama_dokter" class="form-label">Nama Dokter</label>
                <input type="text" class="form-control" name="nama_dokter" placeholder="Nama Dokter" value="<?= $es1->nama_dokter ?>" required>
              </div>

              <!-- Spesialisasi -->
              <div class="form-group mb-3">
                <label for="spesialisasi" class="form-label">Spesialisasi</label>
                <input type="text" class="form-control" name="spesialisasi" placeholder="Spesialisasi" value="<?= $es1->spesialisasi ?>" required>
              </div>

              <!-- NIP -->
              <div class="form-group mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" name="nip" placeholder="NIP" value="<?= $es1->nip ?>" required>
              </div>

              <!-- Alamat -->
              <div class="form-group mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" required><?= $es1->alamat ?></textarea>
              </div>

              <!-- Foto Dokter (optional) -->
              <div class="form-group mb-3">
                <label for="foto" class="form-label">Foto Dokter</label><br>
                <?php if (!empty($es1->foto)): ?>
                  <img src="<?= base_url('uploads/' . $es1->foto) ?>" alt="Foto Dokter" width="80" class="mb-2"><br>
                <?php endif; ?>
                <input type="file" name="foto" class="form-control">
              </div>

              <!-- Hidden ID Dokter -->
              <input type="hidden" name="id_dokter" value="<?= $es1->id_dokter ?>">

              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
</main>
