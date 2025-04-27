<!-- Form untuk menambahkan makanan ke keranjang -->
                            <form action="<?= base_url('home/tambah_ke_keranjang') ?>" method="POST" class="mt-2">
                                <input type="hidden" name="id_menu" value="<?= $menu->id_menu ?>">
                                <input type="hidden" name="nama_menu" value="<?= $menu->nama_menu ?>">
                                <input type="hidden" name="harga" value="<?= $menu->harga ?>">
                                <button type="submit" class="btn btn-success btn-sm">
                                    🛒 Tambah ke Keranjang
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center text-muted">Menu tidak tersedia.</p>
        <?php endif; ?>
    </div>

    <div class="text-center mt-4">
        <a href="<?= base_url('home/keranjang') ?>" class="btn btn-warning">
            🛍️ Lihat Keranjang
        </a>
    </div>
</div>