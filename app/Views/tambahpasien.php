<main id="main" class="main">
  <div class="pagetitle">
    <h1>Form Tambah Pasien</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
        <li class="breadcrumb-item">Forms</li>
        <li class="breadcrumb-item active">Pasien</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h2 class="mt-3">Form Data Pasien</h2>
            <form action="<?= base_url('Home/simpan1') ?>" method="post">
              
              <!-- Field untuk nama pasien -->
              <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $es1->nama ?>">
              </div>

              <!-- Field untuk NIK -->
              <div class="mb-3">
                <label for="nik" class="form-label">NIK:</label>
                <input type="text" class="form-control" id="nik" name="nik" value="<?= $es1->nik ?>">
              </div>

      
         <!-- Field untuk jenis kelamin -->
<div class="mb-3">
  <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
  <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
    <option value="L" <?= $es1->jenis_kelamin == "L" ? "selected" : "" ?>>Laki-laki</option>
    <option value="P" <?= $es1->jenis_kelamin == "P" ? "selected" : "" ?>>Perempuan</option>
  </select>
</div>


              <!-- Field untuk tanggal lahir -->
              <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $es1->tanggal_lahir ?>">
              </div>

              <!-- Field untuk alamat -->
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $es1->alamat ?>">
              </div>

              <!-- Field untuk no HP -->
              <div class="mb-3">
                <label for="no_hp" class="form-label">No HP:</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $es1->no_hp ?>">
              </div>

              <!-- Dropdown untuk memilih user -->
              <div class="mb-3">
                <label for="id_user" class="form-label">User:</label>
                <select class="form-select" id="id_user" name="id_user">
                  <option value="">-- Pilih User --</option>
                 <?php foreach ($user as $u): ?>
  <option value="<?= $u->id_user ?>" <?= $es1->id_user == $u->id_user ? 'selected' : '' ?>>
    <?= $u->nama ?> (<?= $u->email ?>)
  </option>
<?php endforeach; ?>

                </select>
              </div>

              <!-- Hidden field untuk id_pasien -->
              <input type="hidden" name="id_pasien" value="<?= $es1->id_pasien ?>">

              <!-- Tombol submit -->
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div><!-- End card-body -->
        </div><!-- End card -->
      </div><!-- End col -->
    </div><!-- End row -->
  </section>
</main>
