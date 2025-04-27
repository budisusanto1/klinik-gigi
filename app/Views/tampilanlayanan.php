<main id="main" class="main">
  <div class="pagetitle">
    <h1>Table Layanan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data Layanan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <button class="btn btn-success mb-3">
              <a href="/home/tambahlayanan" class="text-white">Tambah</a>
            </button>
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col" width="3%">No</th>
                  <th>Nama Layanan</th>
                  <th>Deskripsi</th>
                  <th>Harga</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($layanan as $value): ?>
                  <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $value->nama_layanan ?></td>
                    <td><?= $value->deskripsi ?></td>
                    <td>Rp <?= number_format($value->harga, 0, ',', '.') ?></td>
                    <td>
                      <img src="<?= base_url('uploads/layanan/' . $value->foto) ?>" alt="<?= $value->nama_layanan ?>" width="100">
                    </td>
                    <td>
                      <a href="<?= base_url('Home/edit_layanan/' . $value->id_layanan) ?>" class="btn btn-warning">✏️ Edit</a>
                      <a href="<?= base_url('Home/hapus_layanan/' . $value->id_layanan) ?>" class="btn btn-danger"
                         onclick="return confirm('Yakin ingin menghapus layanan ini?');">🗑️ Hapus</a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
