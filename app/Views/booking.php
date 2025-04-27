<main class="main">
  <div class="container mt-4">
    <h2>Form Booking Layanan</h2>

    <form action="<?= base_url('home/simpan_booking') ?>" method="post" onsubmit="return validateForm(this)">
      <?= csrf_field() ?> <!-- CSRF Protection -->

      <input type="hidden" name="id_layanan" value="<?= $layanan->id_layanan ?>">
      <input type="hidden" name="status" value="Menunggu Konfirmasi"> <!-- Status default -->

      <div class="mb-3">
        <label class="form-label">Layanan</label>
        <input type="text" class="form-control" value="<?= $layanan->nama_layanan ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Tanggal Kunjungan</label>
        <input type="date" name="tanggal_kunjungan" class="form-control" required id="tanggalKunjungan">
      </div>

      <div class="mb-3">
        <label class="form-label">Jam Kunjungan</label>
        <input type="time" name="jam_kunjungan" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Pilih Jadwal Dokter</label>
        <select name="id_jadwal" class="form-control" required>
          <option value="">-- Pilih Jadwal --</option>
          <?php if (!empty($jadwal)) : ?>
            <?php foreach ($jadwal as $j) : ?>
              <option value="<?= $j->id_jadwal ?>">
                <?= $j->hari ?>, <?= $j->jam_mulai ?> - <?= $j->jam_selesai ?> (<?= isset($j->nama_dokter) ? $j->nama_dokter : 'Tanpa Nama Dokter' ?>)
              </option>
            <?php endforeach; ?>
          <?php else : ?>
            <option value="">Jadwal tidak tersedia</option>
          <?php endif; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Keluhan</label>
        <textarea name="keluhan" class="form-control" placeholder="Tulis keluhan jika ada..."></textarea>
      </div>

      <button type="submit" id="btnBooking" class="btn btn-primary">Booking Sekarang</button>
    </form>
  </div>
</main>

<script>
  function validateForm(form) {
    const tanggalKunjungan = document.getElementById('tanggalKunjungan').value;
    const today = new Date().toISOString().split('T')[0];

    if (tanggalKunjungan < today) {
      alert("Tanggal kunjungan tidak boleh di masa lalu.");
      return false;
    }

    // Disable button agar tidak double submit
    document.getElementById('btnBooking').disabled = true;
    document.getElementById('btnBooking').textContent = "Memproses...";
    return true;
  }
</script>
