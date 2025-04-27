<table class="table table-bordered mt-4">
    <thead class="table-dark">
        <tr>
            <th>ID Order</th>
            <th>Tanggal Order</th>
            <th>Total Harga</th>
            <th>Nama Customer</th>
            <th>Nama Restoran</th>
            <th>Status Order</th>
            <th>Riwayat Pengiriman</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= esc($order['id_order']); ?></td>
                <td><?= esc($order['tanggal_order']); ?></td>
                <td>Rp<?= number_format($order['total_harga'], 0, ',', '.'); ?></td>
                <td><?= esc($order['nama_customer']) ?: 'Nama customer tidak ditemukan'; ?></td>
                <td><?= esc($order['nama_restoran']) ?: 'Nama restoran tidak ditemukan'; ?></td>
                <td><?= esc($order['status_order']); ?></td>
                <td>
                    <ul>
                        <?php if (!empty($order['tracking'])): ?>
                            <?php foreach ($order['tracking'] as $track): ?>
                                <li><?= esc($track['status_pengiriman']) ?> - <?= esc($track['waktu_perubahan']) ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>Belum ada riwayat pengiriman</li>
                        <?php endif; ?>
                    </ul>
                </td>
                <td>
                    <?php if ($order['status_pengiriman'] === 'Belum Dikirim'): ?>
                        <a href="<?= base_url('home/konfirmasi_pengiriman/' . esc($order['id_order'])) ?>" class="btn btn-sm btn-success">Konfirmasi</a>
                        <a href="<?= base_url('home/batal_pengiriman/' . esc($order['id_order'])) ?>" class="btn btn-sm btn-danger">Batal</a>
                    <?php elseif ($order['status_pengiriman'] === 'Sedang Dikirim'): ?>
                        <button onclick="updateLokasi(<?= esc($order['id_order']) ?>)" class="btn btn-sm btn-primary">Update Lokasi</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?= base_url('home/hai') ?>">Kembali</a>

<!-- Map for Driver Locations -->
<div id="map" style="height: 400px; width: 100%;"></div>

<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: { lat: -6.200000, lng: 106.816666 }
    });

    var driverLocations = <?= json_encode($driver_locations); ?>;
    driverLocations.forEach(function(driver) {
        new google.maps.Marker({
            position: { lat: parseFloat(driver.lat), lng: parseFloat(driver.lng) },
            map: map,
            icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
            title: 'Driver: ' + driver.nama_driver
        });
    });
}

function updateLokasi(id_order) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            fetch("<?= base_url('home/update_lokasi_driver') ?>", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id_order=" + id_order + "&lat=" + lat + "&lng=" + lng
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert("Lokasi berhasil diperbarui!");
                    location.reload();
                }
            });
        });
    } else {
        alert("Geolokasi tidak didukung di browser Anda.");
    }
}
</script>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAiwwLa3Io_Yfr9zLbh2T-EXY65AiM6W4&callback=initMap" async defer></script>
