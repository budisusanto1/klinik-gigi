<div class="container mt-4">
    <h2 class="text-center text-danger">🍔 Menu Restoran 🍟</h2>

  <?php if (session()->get('level') == 4 || session()->get('level') == 6): ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="<?= base_url('home/tambah_menu') ?>" class="btn btn-danger">➕ Tambah Menu Baru</a>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($menus as $menu): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow border-0">
                    <img src="<?= base_url('uploads/img/' . $menu->img) ?>" class="card-img-top" alt="<?= $menu->nama_menu ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-danger">🍽️ <?= $menu->nama_menu ?></h5>
                        <p class="card-text text-muted">Kategori: <?= $menu->kategori ?></p>
                        <p class="card-text">
                            <strong>Restoran: <?= $menu->nama_restoran ?></strong><br> <!-- Menampilkan nama restoran -->
                            
                         <?php if (session()->get('level') == 4 || session()->get('level') == 6): ?>

                                <select class="form-select form-select-sm status-restoran"
                                    data-id="<?= $menu->id_restoran ?>"
                                    data-badge="badge-restoran-<?= $menu->id_restoran ?>">
                                    <option value="buka" <?= $menu->status_restoran == 'buka' ? 'selected' : '' ?>>✅ Buka</option>
                                    <option value="tutup" <?= $menu->status_restoran == 'tutup' ? 'selected' : '' ?>>❌ Tutup</option>
                                </select>
                            <?php else: ?>
                                <span id="badge-restoran-<?= $menu->id_restoran ?>" 
                                      class="badge <?= $menu->status_restoran == 'buka' ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $menu->status_restoran == 'buka' ? '✅ Buka' : '❌ Tutup' ?>
                                </span>
                            <?php endif; ?>
                        </p>
                        <h6 class="text-success">💰 Rp<?= number_format($menu->harga, 0, ',', '.') ?></h6>

                        <?php if (session()->get('level') == 4 || session()->get('level') == 6): ?>

                            <a href="<?= base_url('home/edit_menu/' . $menu->id_menu) ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                             <a href="<?= base_url('home/hapus_menu/' . $menu->id_menu) ?>" class="btn btn-warning btn-sm">✏️ hapus</a>
                        <?php elseif (session()->get('level') == 2): ?>
                            <form action="<?= base_url('home/tambah_ke_keranjang') ?>" method="POST" class="mt-2">
                                <input type="hidden" name="id_menu" value="<?= $menu->id_menu ?>">
                                <input type="hidden" name="nama_menu" value="<?= $menu->nama_menu ?>">
                                <input type="hidden" name="harga" value="<?= $menu->harga ?>">
                                <button type="submit" class="btn btn-success btn-sm">🛒 Tambah ke Keranjang</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (session()->get('level') == 2): ?>
        <div class="text-center mt-4">
            <a href="<?= base_url('home/keranjang') ?>" class="btn btn-warning">🛍️ Lihat Keranjang</a>
        </div>

        <!-- Google Maps -->
        <div id="map" style="height: 400px; margin-top: 30px;"></div>
    <?php endif; ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on("change", ".status-restoran", function (event) {
    event.preventDefault();

    var id_restoran = $(this).data("id");
    var status_baru = $(this).val();

    if (!id_restoran || !status_baru) {
        alert("Terjadi kesalahan! ID atau status restoran tidak valid.");
        return;
    }

    console.log("Mengirim data:", {
        id_restoran: id_restoran,
        status_restoran: status_baru
    });

    $.ajax({
        url: "<?= base_url('home/ubah_status_restoran') ?>",
        type: "POST",
        data: {
            id_restoran: id_restoran,
            status_restoran: status_baru
        },
        dataType: "json",
        success: function (response) {
            console.log("Response dari server:", response);

            if (response.status === "success") {
                alert("Status restoran berhasil diubah!");

                var badgeSelector = "#badge-restoran-" + id_restoran;
                if (status_baru === "buka") {
                    $(badgeSelector).removeClass("bg-danger").addClass("bg-success").text("✅ Buka");
                } else {
                    $(badgeSelector).removeClass("bg-success").addClass("bg-danger").text("❌ Tutup");
                }
            } else {
                alert("Gagal mengubah status: " + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Kesalahan AJAX:", error);
            console.log("Response dari server:", xhr.responseText);
            alert("Terjadi kesalahan saat mengubah status restoran.");
        }
    });
});

// Google Maps
function initMap() {
    var lokasiCustomer = { lat: -6.200000, lng: 106.816666 }; // Gantilah dengan koordinat customer dari database
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: lokasiCustomer
    });

    // Tambahkan marker untuk customer
    new google.maps.Marker({
        position: lokasiCustomer,
        map: map,
        title: "Lokasi Anda (Customer)"
    });

    <?php foreach ($menus as $menu): ?>
        var lokasiRestoran<?= $menu->id_restoran ?> = { lat: <?= $menu->latitude ?>, lng: <?= $menu->longitude ?> };

        var marker<?= $menu->id_restoran ?> = new google.maps.Marker({
            position: lokasiRestoran<?= $menu->id_restoran ?>,
            map: map,
            title: "<?= $menu->nama_restoran ?>"
        });
    <?php endforeach; ?>
}

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLIPyMFaCmSHdLaAYl0Y4H2i-vchx18f0&callback=initMap">
</script>
