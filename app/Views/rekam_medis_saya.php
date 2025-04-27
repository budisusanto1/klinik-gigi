<div class="container mt-4">
    <h4 class="mb-4"><i class="bi bi-file-medical"></i> Rekam Medis Saya</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif ?>

    <?php if (session()->get('role') === 'dokter'): ?>
        <a href="<?= base_url('home/rekamMedisTambah') ?>" class="btn btn-primary mb-3">
            <i class="bi bi-plus-lg"></i> Tambah Rekam Medis
        </a>
    <?php endif; ?>

    <?php if (!empty($rekam_medis)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Tanggal Periksa</th>
                        <th>Dokter</th>
                        <th>Diagnosa</th>
                        <th>Catatan</th>
                        <th>Pasien</th>
                        <?php if (session()->get('role') === 'dokter'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rekam_medis as $rm): ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($rm->tanggal_periksa)) ?></td>
                            <td><?= $rm->nama_dokter ?></td>
                            <td><?= $rm->diagnosa ?></td>
                            <td><?= $rm->catatan ?></td>
                            <td><?= $rm->nama_pasien ?? 'Pasien Tidak Ditemukan' ?></td>
                            <?php if (session()->get('role') === 'dokter'): ?>
                                <td>
                                    <a href="<?= base_url('home/rekamMedisEdit/' . $rm->id_rekam) ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="<?= base_url('home/rekamMedisHapus/' . $rm->id_rekam) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus rekam medis ini?');">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Belum ada rekam medis yang tersedia.</div>
    <?php endif ?>
</div>
