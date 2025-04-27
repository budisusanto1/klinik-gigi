<h2>Daftar Pesanan</h2>

<?php if (!empty($orders)): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Status Pesanan</th>
                <th>Nama Restoran</th>
                <th>Nama Driver</th>
                <th>Metode Pembayaran</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= esc($order['id_order']); ?></td>
                    <td><?= esc($order['tanggal_order']); ?></td>
                    <td>Rp<?= number_format($order['total_harga'], 0, ',', '.'); ?></td>
                    <td><?= esc($order['status_order']); ?></td>
                    <td><?= esc($order['nama_restoran'] ?? 'Tidak Diketahui'); ?></td>
                    <td><?= isset($order['nama_driver']) ? esc($order['nama_driver']) : 'Belum Ditugaskan'; ?></td>
                    <td><?= !empty($order['metode_pembayaran']) ? esc($order['metode_pembayaran']) : 'Belum Dibayar'; ?></td>
                    <td><?= esc($order['status_pembayaran'] ?? 'Belum Dibayar'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<a href="<?=base_url('home/hai')?>">kembali</a>
    <h3>Lokasi Pengiriman</h3>
<div id="map" style="width:100%; height:400px;"></div>

<!-- Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    var map = L.map('map').setView([-6.200000, 106.816666], 13); // Default Jakarta

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    <?php foreach ($orders as $order): ?>
        <?php 
        // Pastikan koordinat tidak kosong dan aman dari karakter khusus
        $customer_lat = !empty($order['customer_lat']) ? $order['customer_lat'] : null;
        $customer_lng = !empty($order['customer_lng']) ? $order['customer_lng'] : null;
        $restoran_lat = !empty($order['restoran_lat']) ? $order['restoran_lat'] : null;
        $restoran_lng = !empty($order['restoran_lng']) ? $order['restoran_lng'] : null;
        $driver_lat = !empty($order['driver_lat']) ? $order['driver_lat'] : null;
        $driver_lng = !empty($order['driver_lng']) ? $order['driver_lng'] : null;

        // Mengencode data ke dalam format JSON untuk memastikan tidak ada masalah dengan tanda kutip
        ?>
        
        <?php if ($customer_lat && $customer_lng): ?>
            L.marker([<?= $customer_lat; ?>, <?= $customer_lng; ?>], {
                icon: L.icon({
                    iconUrl: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41]
                })
            }).addTo(map).bindPopup("<b>Customer</b>");
        <?php endif; ?>

        <?php if ($restoran_lat && $restoran_lng): ?>
            L.marker([<?= $restoran_lat; ?>, <?= $restoran_lng; ?>], {
                icon: L.icon({
                    iconUrl: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41]
                })
            }).addTo(map).bindPopup("<b>Restoran: <?= esc(json_encode($order['nama_restoran'] ?? 'Tidak Diketahui')) ?></b>");
        <?php endif; ?>

        <?php if ($driver_lat && $driver_lng): ?>
            L.marker([<?= $driver_lat; ?>, <?= $driver_lng; ?>], {
                icon: L.icon({
                    iconUrl: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41]
                })
            }).addTo(map).bindPopup("<b>Driver: <?= esc(json_encode($order['nama_driver'] ?? 'Belum Ditugaskan')) ?></b>");
        <?php endif; ?>
    <?php endforeach; ?>
</script>

<?php endif; ?>
