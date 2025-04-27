<div class="container mt-4">
    <h2 class="text-center text-danger">🍔 Edit Menu</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <form action="<?= base_url('home/simpan_perubahan_menu/' . $menu->id_menu) ?>" method="POST" enctype="multipart/form-data">
                        <!-- Nama Menu -->
                        <div class="mb-3">
                            <label for="nama_menu" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="<?= $menu->nama_menu ?>" required>
                        </div>

                        <!-- Nama Restoran -->
                        <div class="mb-3">
                            <label class="form-label">Restoran</label>
                            <input type="text" class="form-control" value="<?= $menu->nama_restoran ?>" readonly>
                        </div>

                        <!-- Kategori Menu -->
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="Makanan" <?= ($menu->kategori == 'Makanan') ? 'selected' : '' ?>>Makanan</option>
                                <option value="Minuman" <?= ($menu->kategori == 'Minuman') ? 'selected' : '' ?>>Minuman</option>
                                <option value="Snack" <?= ($menu->kategori == 'Snack') ? 'selected' : '' ?>>Snack</option>
                            </select>
                        </div>

                        <!-- Harga -->
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga (Rp)</label>
                            <input type="number" class="form-control" id="harga" name="harga" value="<?= $menu->harga ?>" required>
                        </div>

                        <!-- Status Menu -->
                        <div class="mb-3">
                            <label for="status_menu" class="form-label">Status Menu</label>
                            <select class="form-select" id="status_menu" name="status_menu" required>
                                <option value="Tersedia" <?= ($menu->status_menu == 'Tersedia') ? 'selected' : '' ?>>Tersedia</option>
                                <option value="Habis" <?= ($menu->status_menu == 'Habis') ? 'selected' : '' ?>>Habis</option>
                            </select>
                        </div>

                        <!-- Upload Gambar -->
                        <div class="mb-3">
                            <label for="img" class="form-label">Upload Gambar (Opsional)</label>
                            <input type="file" class="form-control" id="img" name="img" accept="image/*">
                        </div>

                        <!-- Gambar Saat Ini -->
                        <div class="text-center mb-3">
                            <small class="text-muted">Gambar saat ini:</small>
                            <div>
                                <img src="<?= base_url('uploads/img/' . $menu->img) ?>" alt="<?= $menu->nama_menu ?>" class="img-thumbnail" style="width: 200px; border-radius: 10px;">
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">✅ Simpan Perubahan</button>
                            <a href="<?= base_url('home/menu1') ?>" class="btn btn-danger">❌ Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
