<?php
// File: customer_dashboard.php
?>
<h1>Dashboard Customer</h1>
<p>Selamat datang, <?= session()->get('u'); ?>!</p>
<a href="<?= base_url('home/restoran'); ?>">Lihat Restoran</a>
<a href="<?= base_url('home/keranjang'); ?>">Lihat Keranjang</a>
<a href="<?= base_url('home/logout'); ?>">Logout</a>

<?php
// File: restoran_list.php
?>
<h1>Daftar Restoran</h1>
<?php foreach ($restoran as $r): ?>
    <h2><?= $r['nama_restoran']; ?></h2>
    <p><?= $r['alamat']; ?></p>
    <h3>Menu:</h3>
    <table border="1">
        <tr>
            <th>Nama Menu</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($menu[$r['id_restoran']] as $m): ?>
        <tr>
            <td><?= $m['nama_menu']; ?></td>
            <td>Rp<?= number_format($m['harga'], 0, ',', '.'); ?></td>
            <td><a href="<?= base_url('home/tambah_ke_keranjang/'.$m['id_menu']); ?>">Tambah</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endforeach; ?>

<?php
// File: keranjang.php
?>
<h1>Keranjang Belanja</h1>
<table border="1">
    <tr>
        <th>Nama Menu</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($keranjang as $item): ?>
    <tr>
        <td><?= $item['nama_menu']; ?></td>
        <td><?= $item['jumlah']; ?></td>
        <td>Rp<?= number_format($item['total_harga'], 0, ',', '.'); ?></td>
        <td><a href="<?= base_url('home/hapus_dari_keranjang/'.$item['id_menu']); ?>">Hapus</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="<?= base_url('home/checkout'); ?>">Checkout</a>

<?php
// File: checkout.php
?>
<h1>Checkout</h1>
<form action="<?= base_url('home/proses_checkout'); ?>" method="post">
    <label for="alamat">Alamat Pengiriman:</label>
    <input type="text" name="alamat" required>
    <br>
    <label for="pembayaran">Metode Pembayaran:</label>
    <select name="pembayaran">
        <option value="transfer">Transfer Bank</option>
        <option value="cod">Cash on Delivery</option>
    </select>
    <br>
    <button type="submit">Proses Checkout</button>
</form>
