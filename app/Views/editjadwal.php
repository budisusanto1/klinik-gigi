<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Jadwal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Edit Jadwal</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h2>Form Edit Jadwal</h2>
            
            <form action="<?= base_url('Home/aksi_e_jadwal') ?>" method="post">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th style="width: 25%;">Hari</th>
                      <td>
                        <input type="text" class="form-control" placeholder="Hari" name="hari" value="<?= $jadwal->hari ?>" required>
                      </td>
                    </tr>

                    <tr>
                      <th>Jam Mulai</th>
                      <td>
                        <input type="time" class="form-control" name="jam_mulai" value="<?= $jadwal->jam_mulai ?>" required>
                      </td>
                    </tr>

                    <tr>
                      <th>Jam Selesai</th>
                      <td>
                        <input type="time" class="form-control" name="jam_selesai" value="<?= $jadwal->jam_selesai ?>" required>
                      </td>
                    </tr>

                    <tr>
                      <th>dokter</th>
                      <td>
                        <<select class="form-control" name="id_dokter" required>
  <option value="">Pilih Dokter</option>
  <?php foreach ($RPL12A as $D): ?>
    <option value="<?= $D->id_dokter ?>" <?= $D->id_dokter == $jadwal->id_dokter ? 'selected' : '' ?>>
      <?= $D->nama_dokter ?>
    </option>
  <?php endforeach; ?>
</select>

                      </td>
                    </tr>

                    <tr>
                      <th>Keterangan</th>
                      <td>
                        <input type="text" class="form-control" name="keterangan" value="<?= $jadwal->keterangan ?>" placeholder="Contoh: Shift Pagi / Sore / Full Day">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <input type="hidden" name="id_jadwal" value="<?= $jadwal->id_jadwal ?>">
              <button type="submit" class="btn btn-primary mt-3">Submit</button> 
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
</main>
