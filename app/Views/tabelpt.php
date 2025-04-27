<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan Transaksi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <h2>Laporan Transaksi</h2>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>ID Order</th>
        <th>Metode Pembayaran</th>
        <th>Status</th>
        <th>Tanggal Pembayaran</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $no = 1;
      foreach ($chelsica as $value) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $value->id_order ?></td>
          <td><?= $value->metode_pembayaran ?></td>
          <td><?= $value->status ?></td>
          <td><?= $value->tanggal_pembayaran ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <script>
    window.print();
  </script>
</body>
</html>
