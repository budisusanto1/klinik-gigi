<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Dokter</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Home') ?>">Home</a></li>
                <li class="breadcrumb-item active">Tambah Dokter</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('Home/simpan_dokter') ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="id_user">Akun User</label>
                                <select name="id_user" class="form-control" id="id_user" required>
                                    <option value="">Pilih Akun User</option>
                                    <?php foreach ($RPL12A as $user): ?>
                                        <option value="<?= $user->id_user ?>"><?= $user->username ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nama_dokter">Nama Dokter</label>
                                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" required>
                            </div>

                            <div class="form-group">
                                <label for="spesialisasi">Spesialisasi</label>
                                <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" required>
                            </div>

                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" required>
                            </div>

                            <div class="form-group">
                                <label for="no_telepon">No Telepon</label>
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto Dokter</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            </div>
                           <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
