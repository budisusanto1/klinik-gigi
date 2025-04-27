<!-- file: app/Views/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login FastFood</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .image-container img {
      max-width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>
<section class="p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="card shadow-sm">
      <div class="row g-0">
        <div class="col-md-6 bg-primary text-white d-flex flex-column justify-content-center p-4">
          <div class="image-container mb-3 text-center">
            <img src="<?= base_url('assets/img/2.png') ?>" alt="Image">
          </div>
          <h2 class="text-center">Selamat datang di klinik gigi !</h2>
          <p class="text-center">Belum punya akun? Yuk daftar dulu!</p>
        </div>
        <div class="col-md-6">
          <div class="card-body p-4">
            <h3 class="text-center mb-4">Log in</h3>

            <?php if(session()->getFlashdata('error')): ?>
              <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('home/aksi_login') ?>" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                  <span class="input-group-text">@</span>
                  <input type="email" name="email" id="email" class="form-control" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="pswd" class="form-label">Password</label>
                <input type="password" name="pswd" id="pswd" class="form-control" required>
              </div>

              <!-- Captcha Google & Lokal -->
              <div class="mb-3" id="captcha-google">
                <div class="g-recaptcha" data-sitekey="6Ldv9-gqAAAAAFnkKLu08glA2kOZs0-5mIuDHMuI"></div>
              </div>

              <div class="mb-3 d-none" id="captcha-local">
                <label for="captcha_answer" class="form-label" id="math-question">Berapa hasil dari ...?</label>
                <input type="number" class="form-control" name="captcha_answer" id="captcha_answer">
                <input type="hidden" name="captcha_correct" id="captcha-correct">
              </div>

              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember_me">
                <label class="form-check-label" for="remember_me">Keep me logged in</label>
              </div>

              <button type="submit" class="btn btn-primary w-100">Log in now</button>
            </form>

            <hr class="my-4">

            <div class="d-flex justify-content-between">
              <a href="<?= base_url('home/register') ?>">Buat akun baru</a>
              <a href="<?= base_url('home/forgorpass') ?>">Lupa password?</a>
            </div>

            <p class="text-center mt-4">Atau login dengan</p>
            <div class="d-flex gap-3 justify-content-center">
              <a href="#" class="btn btn-outline-primary"><img src="<?= base_url('assets/img/google.png') ?>" width="20"> Google</a>
              <a href="#" class="btn btn-outline-primary"><img src="<?= base_url('assets/img/feb.png') ?>" width="20"> Facebook</a>
              <a href="#" class="btn btn-outline-primary"><img src="<?= base_url('assets/img/twi.png') ?>" width="20"> Twitter</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function aktifkanCaptchaLokal() {
    const num1 = Math.floor(Math.random() * 10) + 1;
    const num2 = Math.floor(Math.random() * 10) + 1;
    const soal = `Berapa hasil dari ${num1} + ${num2} ?`;
    const jawaban = num1 + num2;

    document.getElementById('math-question').innerText = soal;
    document.getElementById('captcha-correct').value = jawaban;
  }

  function cekKoneksiInternet() {
    if (!navigator.onLine) {
      document.getElementById('captcha-google').classList.add('d-none');
      document.getElementById('captcha-local').classList.remove('d-none');
      aktifkanCaptchaLokal();
    }
  }

  window.addEventListener('load', cekKoneksiInternet);
</script>
</body>
</html>
