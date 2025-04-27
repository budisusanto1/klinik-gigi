
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>fastfood</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url ('img/logo.png')?>" rel="icon">
  <link href="<?= base_url ('img/logo.png')?>" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url ('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?= base_url ('assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?= base_url ('assets/vendor/boxicons/css/boxicons.min.css')?>" rel="stylesheet">
  <link href="<?= base_url ('assets/vendor/quill/quill.snow.css')?>" rel="stylesheet">
  <link href="<?= base_url ('assets/vendor/quill/quill.bubble.css')?>" rel="stylesheet">
  <link href="<?= base_url ('assets/vendor/remixicon/remixicon.css')?>" rel="stylesheet">
  <link href="<?= base_url ('assets/vendor/simple-datatables/style.css')?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url ('assets/css/style.css')?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
<div class="container">
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

          <!-- Logo -->
          <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
              <img 
                src="<?= base_url('img/logo.png'); ?>" 
                style="width: 45px; height: auto;" 
                alt="Elysium Logo">
              <span class="d-none d-lg-block">LOGIN TO WEBSITE</span>
            </a>
          </div>
          <!-- End Logo -->

          <!-- Login Card -->
          <div class="card mb-3" style="width: 100%; max-width: 500px; min-height: 300px;">
            <div class="card-body d-flex flex-column justify-content-between">

              <!-- Header -->
              <div>
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">(LOGIN NOW.)</h5>
                  <p class="text-center small">Enter your email and we'll link to your email.</p>
                </div>
              </div>
              <!-- End Header -->

              <!-- Forgot Password Form -->
              <div>
                <form action="<?= base_url('/home/forgot_password') ?>" method="POST">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input 
                      type="email" 
                      class="form-control" 
                      id="email" 
                      name="email" 
                      placeholder="Enter your email" 
                      style="height: 50px;" 
                      required>
                  </div>
                  <div class="d-grid mt-auto">
                <button type="submit" class="btn btn-danger">Send Reset Link</button>
              </div>
                </form>

              </div>
              <!-- End Forgot Password Form -->

              <!-- Submit Button -->
              
              <!-- End Submit Button -->

            </div>
          </div>
          <!-- End Login Card -->

          <!-- Footer -->
          <div class="credits">
            <!-- Licensing and credits information -->
            This <a href="https://bootstrapmade.com/">BootstrapMade</a> Bro made the template
          </div>
          <!-- End Footer -->

        </div>
      </div>
    </div>
  </section>
</div>
 </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/chart.js/chart.umd.js')?>"></script>
  <script src="<?= base_url('assets/vendor/echarts/echarts.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/quill/quill.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js')?>"></script>
  <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/php-email-form/validate.js')?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/js/main.js')?>"></script>
</body>

</html>