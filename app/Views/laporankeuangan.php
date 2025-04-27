<h3>Laporan Keuangan</h3>

<form action="<?= base_url('home/excellapor_keuangan') ?>" method="post">
    <div class="row">
        <div class="col">
            <input type="date" class="form-control" name="tanggal_awal" required>
        </div>
        <div class="col">
            <input type="date" class="form-control" name="tanggal_akhir" required>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
        </div>
    </div>
</form>
