<main id="main" class="main">
  <div class="pagetitle">
    <h1>Layanan Klinik</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('home/dashboard') ?>">Home</a></li>
        <li class="breadcrumb-item active">Layanan Klinik</li>
      </ol>
    </nav>
  </div>

  <style>
    .overlay-title {
      position: absolute;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.85);
      color: #fff;
      width: 100%;
      text-align: center;
      padding: 8px;
      font-weight: bold;
      font-size: 1rem;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
      border-bottom-left-radius: 4px;
      border-bottom-right-radius: 4px;
    }

    .card-img-container {
      position: relative;
      cursor: pointer;
      overflow: hidden;
      border-radius: 8px;
    }

    .modal-content {
      background-color: #fff;
      color: #000;
    }

    .modal-title {
      color: #333;
      font-weight: bold;
    }

    .modal-body p {
      color: #555;
    }

    .modal-body .text-primary {
      color: #007bff !important;
    }
  </style>

  <section class="section">
    <div class="row">
      <?php foreach ($layanan as $index => $l): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-img-container" data-bs-toggle="modal" data-bs-target="#layananModal<?= $index ?>">
              <?php if (!empty($l->foto)): ?>
                <img src="<?= base_url('uploads/layanan/' . $l->foto) ?>" class="card-img-top" alt="<?= $l->nama_layanan ?>">
              <?php else: ?>
                <img src="<?= base_url('assets/img/default-layanan.jpg') ?>" class="card-img-top" alt="Default">
              <?php endif; ?>
              <div class="overlay-title"><?= $l->nama_layanan ?></div>
            </div>
          </div>
        </div>

        <!-- Modal untuk detail layanan -->
        <div class="modal fade" id="layananModal<?= $index ?>" tabindex="-1" aria-labelledby="layananModalLabel<?= $index ?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="layananModalLabel<?= $index ?>"><?= $l->nama_layanan ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
              </div>
              <div class="modal-body">
                <?php if (!empty($l->foto)): ?>
                  <img src="<?= base_url('uploads/layanan/' . $l->foto) ?>" class="img-fluid mb-3" alt="<?= $l->nama_layanan ?>">
                <?php endif; ?>
                <p><?= $l->deskripsi ?></p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <p class="text-primary fw-bold mb-0">Rp <?= number_format($l->harga, 0, ',', '.') ?></p>
                  <a href="<?= base_url('home/booking/' . $l->id_layanan) ?>" class="btn btn-success btn-sm">
                    <i class="bi bi-calendar-check"></i> Booking
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>
