<main id="main" class="main">
  <div class="pagetitle">
    <h1>Table Pasien</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data Pasien</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <a href="<?= base_url('home/tambahpasien') ?>" class="btn btn-success mb-3 text-white">Tambah Pasien</a>

            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Jenis Kelamin</th>
                  <th>Tanggal Lahir</th>
                  <th>Alamat</th>
                  <th>No HP</th>
                  <th>ID User</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($pasien as $p) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p->nama ?></td>
                    <td><?= $p->nik ?></td>
                    <td><?= $p->jenis_kelamin ?></td>
                    <td><?= $p->tanggal_lahir ?></td>
                    <td><?= $p->alamat ?></td>
                    <td><?= $p->no_hp ?></td>
                    <td><?= $p->id_user ?></td>
                    <td>
                      <a href="<?= base_url('Home/edit_pasien/'.$p->id_pasien) ?>" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                      </a>
                      <a href="<?= base_url('Home/hapus_pasien/'.$p->id_pasien) ?>" 
                         class="btn btn-danger btn-sm"
                         onclick="return confirm('Yakin ingin menghapus data pasien ini?');">
                        <i class="bi bi-trash"></i> Hapus
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </section>
</main>
