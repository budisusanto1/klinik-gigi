<main id="main" class="main">
  <div class="pagetitle">
    <h1>Form Tambah Jadwal Dokter</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
        <li class="breadcrumb-item">Jadwal</li>
        <li class="breadcrumb-item active">Tambah Jadwal</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h2 class="mt-3">Form Tambah Jadwal</h2>

            <form action="<?= base_url('home/simpan_jadwal') ?>" method="post">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th style="width: 25%;">Dokter</th>
                      <td>
                        <select class="form-control" name="id_dokter" required>
                          <option value="">Pilih Dokter</option>
                          <?php foreach ($RPL12A as $dokter): ?>
                            <option value="<?= $dokter->id_dokter ?>">
                              <?= $dokter->nama_dokter ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <th>Hari Praktik</th>
                      <td>
                        <select class="form-control" name="hari" required>
                          <option value="">Pilih Hari</option>
                          <option value="Senin">Senin</option>
                          <option value="Selasa">Selasa</option>
                          <option value="Rabu">Rabu</option>
                          <option value="Kamis">Kamis</option>
                          <option value="Jumat">Jumat</option>
                          <option value="Sabtu">Sabtu</option>
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <th>Jam Mulai</th>
                      <td>
                        <input type="time" class="form-control" name="jam_mulai" required>
                      </td>
                    </tr>

                    <tr>
                      <th>Jam Selesai</th>
                      <td>
                        <input type="time" class="form-control" name="jam_selesai" required>
                      </td>
                    </tr>

                    <tr>
                      <th>Status</th>
                      <td>
                        <select class="form-control" name="status" required>
                          <option value="Aktif">Aktif</option>
                          <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <button type="submit" class="btn btn-primary mt-3">Simpan Jadwal</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
</main>
