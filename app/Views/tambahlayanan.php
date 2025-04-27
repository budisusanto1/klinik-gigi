<main id="main" class="main">
  <div class="pagetitle">
    <h1>Form Tambah Layanan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Tambah Layanan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h2>Form Tambah Layanan</h2>
            
            <form action="<?= base_url('Home/simpan_layanan') ?>" method="post" enctype="multipart/form-data">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th style="width: 25%;">Nama Layanan</th>
                      <td>
                        <input type="text" class="form-control" placeholder="Nama Layanan" name="nama_layanan" required>
                      </td>
                    </tr>

                    <tr>
                      <th>Deskripsi</th>
                      <td>
                        <textarea class="form-control" placeholder="Deskripsi Layanan" name="deskripsi" required></textarea>
                      </td>
                    </tr>

                    <tr>
                      <th>Harga</th>
                      <td>
                        <input type="text" class="form-control" placeholder="Harga Layanan" name="harga" id="harga" required>
                      </td>
                    </tr>

                    <tr>
                      <th>Foto</th>
                      <td>
                        <input type="file" class="form-control" name="foto" accept="image/*" required>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              
              <button type="submit" class="btn btn-primary mt-3">Submit</button> 
            </form>
            
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
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