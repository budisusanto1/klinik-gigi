<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Pasien</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Edit Pasien</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h2>Form Edit Pasien</h2>

            <!-- Menambahkan Notifikasi Error -->
            <?php if(session()->getFlashdata('error')): ?>
              <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
              </div>
            <?php endif; ?>

           <form action="<?= base_url('Home/aksi_e_pasien') ?>" method="post">
    <div class="form-group row">
        <label for="akunUser" class="col-sm-2 col-form-label">Akun User</label>
        <div class="col-sm-10">
            <select class="form-control" name="u" required>
                <option value="">Pilih</option>
                <?php foreach ($RPL12A as $D): ?>
                    <option value="<?= $D->id_user ?>" <?= $D->id_user == $es1->id_user ? 'selected' : '' ?>>
                        <?= $D->username ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="nama_pasien" class="form-label">Nama Pasien</label>
        <input type="text" class="form-control" placeholder="Nama Pasien" name="nama_pasien" value="<?= old('nama', $es1->nama) ?>" required>
    </div>

    <div class="mb-3">
        <label for="nik" class="form-label">Nik</label>
        <input type="text" class="form-control" placeholder="Nik" name="nik" value="<?= old('nik', $es1->nik) ?>" required>
    </div>

    <div class="mb-3">
        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" name="tgl_lahir" value="<?= old('tgl_lahir', $es1->tanggal_lahir) ?>" required>
    </div>

    <div class="mb-3">
        <label for="no_hp" class="form-label">No HP</label>
        <input type="text" class="form-control" placeholder="No HP" name="no_hp" value="<?= old('no_hp', $es1->no_hp) ?>" required>
    </div>

    <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-control" name="jenis_kelamin" required>
            <option value="L" <?= old('jenis_kelamin', $es1->jenis_kelamin) == 'L' ? 'selected' : '' ?>>Laki-laki</option>
            <option value="P" <?= old('jenis_kelamin', $es1->jenis_kelamin) == 'P' ? 'selected' : '' ?>>Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" name="alamat" required><?= old('alamat', $es1->alamat) ?></textarea>
    </div>

    <input type="hidden" name="id_pasien" value="<?= $es1->id_pasien ?>">

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

          </div><!-- End card-body -->
        </div><!-- End card -->
      </div><!-- End col -->
    </div><!-- End row -->
  </section>
</main>
