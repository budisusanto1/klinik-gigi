<div class="container mt-4">
    <h4 class="mb-4"><i class="bi bi-plus-lg"></i> Tambah Rekam Medis</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif ?>
<form action="<?= base_url('home/rekammedissimpan') ?>" method="POST">

        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="id_pasien" class="form-label">Pasien</label>
            <select name="id_pasien" class="form-control" required>
                <option value="">-- Pilih Pasien --</option>
                <?php foreach ($pasien as $p): ?>
                    <option value="<?= $p->id_pasien ?>"><?= $p->nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
            <input type="date" name="tanggal_periksa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="diagnosa" class="form-label">Diagnosa</label>
            <textarea name="diagnosa" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea name="catatan" class="form-control" required></textarea>
        </div>
<input type="hidden" name="id" value="<?= $id_rekam ?>">

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
