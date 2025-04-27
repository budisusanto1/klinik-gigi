<div class="container mt-4">
    <h2 class="text-center text-danger">➕ Tambah Menu Baru</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body">
                    <form action="<?= base_url('home/simpan_menu') ?>" method="POST" enctype="multipart/form-data">
                        
                        <!-- Pilih Restoran -->
                        <div class="mb-3">
                            <label for="id_restoran" class="form-label">Pilih Restoran</label>
                            <select class="form-select" id="id_restoran" name="id_restoran" required>
                                <option value="">-- Pilih Restoran --</option>
                                <?php foreach ($restorans as $restoran): ?>
                                    <option value="<?= $restoran->id_restoran ?>">
                                        <?= $restoran->nama_restoran ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Nama Menu -->
                        <div class="mb-3">
                            <label for="nama_menu" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control" id="nama_menu" name="nama_menu" required>
                        </div>

                        <!-- Kategori Menu -->
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Snack">Snack</option>
                            </select>
                        </div>

                        <!-- Harga -->
                        <!-- Harga -->
<div class="mb-3">
    <label for="harga" class="form-label">Harga (Rp)</label>
    <input type="text" class="form-control" id="harga" name="harga" required>
</div>


                        <!-- Upload Gambar -->
                        <div class="mb-3">
                            <label for="img" class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" id="img" name="img" accept="image/*" required>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">✅ Simpan Menu</button>
                            <a href="<?= base_url('home/menu1') ?>" class="btn btn-secondary">❌ Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('harga').addEventListener('input', function (e) {
    let value = e.target.value.replace(/[^0-9]/g, ''); // Hapus semua karakter kecuali angka

    if (value) {
        let formattedValue = new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 2, // Pastikan selalu ada dua desimal
            maximumFractionDigits: 2
        }).format(value / 100); // Dibagi 100 agar sesuai format RpX.XXX,00
        
        e.target.value = 'Rp ' + formattedValue; // Tambahkan simbol Rp di depan
    } else {
        e.target.value = ''; // Kosongkan jika input dihapus
    }
});
</script>


