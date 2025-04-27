<table border="1" id="My-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal Pembayaran</th>
        <th>Metode Pembayaran</th>
        <th>Total Pendapatan</th>
        <th>Jumlah Transaksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $ms = 1; // Initialize the row counter
      foreach ($ss as $key => $value) {
        ?>
        <tr>
          <td align="center"><?= $ms++ ?></td> <!-- Row counter -->
          <td align="center"><?= $value->tanggal_pembayaran ?></td> <!-- Payment date -->
          <td align="center"><?= $value->metode_pembayaran ?></td> <!-- Payment method -->
          <td align="center">Rp <?= number_format($value->total_pendapatan, 0, ',', '.') ?></td> <!-- Total income formatted -->
          <td align="center"><?= $value->jumlah_transaksi ?></td> <!-- Number of transactions -->
        </tr>
      <?php } ?>
    </tbody>
</table>

<script>
  // Automatically trigger export when the page loads
  window.onload = () => {
      const table = document.getElementById('My-table');
      exportTable(table, 'laporan_keuangan.xls'); // Specify the Excel filename
  };

  // Function to export the table content to Excel
  function exportTable(table, filename) {
      const tableHTML = encodeURIComponent(table.outerHTML); // Get the table HTML encoded
      const downloadLink = document.createElement('a'); // Create a download link

      downloadLink.href = `data:application/vnd.ms-excel,${tableHTML}`; // Set the href to the encoded table HTML for Excel
      downloadLink.download = filename; // Set the filename for the Excel file
      document.body.appendChild(downloadLink); // Append the link to the document body
      downloadLink.click(); // Trigger a click on the link to start downloading
      document.body.removeChild(downloadLink); // Remove the link from the document body
      window.close(); // Close the window after the download starts
  }
</script>
