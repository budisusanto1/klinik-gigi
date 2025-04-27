<main id="main" class="main">
  <div class="pagetitle">
    <h1>Table Layanan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Layanan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h2>Form Edit Layanan</h2>
            <form action="<?= base_url('Home/simpan_layanan1') ?>" method="POST" enctype="multipart/form-data">
              <div class="mb-3 mt-3">
                <label for="nama_layanan" class="form-label">Nama Layanan:</label>
                <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="<?= $es1->nama_layanan ?>">
              </div>
              <div class="mb-3 mt-3">
                <label for="deskripsi" class="form-label">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"><?= $es1->deskripsi ?></textarea>
              </div>
              <div class="mb-3 mt-3">
                <label for="harga" class="form-label">Harga:</label>
                <input type="text" class="form-control" id="harga" name="harga" value="<?= number_format($es1->harga, 0, ',', '.') ?>">
              </div>
              <div class="mb-3">
                <label for="foto" class="form-label">Foto Layanan:</label>
                <input type="file" class="form-control" id="foto" name="foto">
                <small>Jika tidak ingin mengubah foto, biarkan kosong</small>
              </div>
              <input type="hidden" value="<?= $es1->id_layanan ?>" name="id">
              <button type="submit" class="btn btn-primary">Simpan</button> 
            </form>  
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
