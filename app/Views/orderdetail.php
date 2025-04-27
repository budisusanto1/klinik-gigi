<table>
    <thead>
        <tr>
            <th>No</th>
            <th>ID Order</th>
            <th>Customer</th>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($orderdetail)): ?>
            <?php foreach ($orderdetail as $key => $order): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= esc($order->id_order) ?></td>
                    <td><?= esc($order->nama_customer) ?></td> <!-- Customer name -->
                    <td><?= esc($order->nama_menu) ?></td> <!-- Menu name -->
                    <td><?= esc($order->jumlah) ?></td>
                    <td><?= esc($order->jumlah * $order->harga) ?></td> <!-- Total price -->
                    <td><?= esc($order->status) ?></td> <!-- Status -->
                    <td><!-- Add action buttons (View/Edit) here --></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8">No results found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
