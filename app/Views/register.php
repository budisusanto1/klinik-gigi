<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .bg-image {
            background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.5);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
        .form-container {
            position: relative;
            z-index: 1;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
        }
    </style>
</head>
<body class="bg-image d-flex align-items-center justify-content-center">

    <div class="overlay"></div>

    <div class="form-container text-center">
        <h2 class="text-uppercase mb-4">Create an account</h2>

        <form action="<?=base_url('home/aksi_register')?>" method="POST" onsubmit="return validatePassword()">
            <div class="form-outline mb-3">
                <label class="form-label w-100" for="username">Your username</label>
                <input type="text" name="username" class="form-control form-control-lg text-center" required />
            </div>

            <div class="form-outline mb-3">
                <label class="form-label w-100" for="email">Your Email</label>
                <input type="email" name="email" class="form-control form-control-lg text-center" required />
            </div>

            <!-- Password Input -->
  <!-- Password Input -->
<div class="form-outline mb-3 position-relative">
    <label class="form-label w-100" for="password">Password</label>
    <input type="password" id="password" name="password" class="form-control" required onkeyup="validatePassword()"/>
    <span id="togglePassword" class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;">
        👁️
    </span>
    <ul class="text-start mt-2" style="list-style-type: none; padding: 0;">
        <li id="lengthCheck" class="text-danger">❌ Minimal 8 karakter</li>
        <li id="uppercaseCheck" class="text-danger">❌ Harus ada huruf besar (A-Z)</li>
        <li id="lowercaseCheck" class="text-danger">❌ Harus ada huruf kecil (a-z)</li>
        <li id="numberCheck" class="text-danger">❌ Harus ada angka (0-9)</li>
        <li id="specialCheck" class="text-danger">❌ Harus ada karakter spesial (!@#$%^&*)</li>
    </ul>
</div>

            <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" id="terms" required />
                <label class="form-check-label" for="terms">
                    I agree to all statements in <a href="#" class="text-primary"><u>Terms of Service</u></a>
                </label>
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100">Register</button>

            <p class="text-center text-muted mt-4">
                Already have an account? <a href="<?=base_url('home/Login')?>" class="fw-bold text-primary"><u>Login here</u></a>
            </p>
        </form>
    </div>


<script>
document.getElementById("togglePassword").addEventListener("click", function() {
    let passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        this.innerHTML = "🙈"; // Ubah icon jadi mata tertutup
    } else {
        passwordField.type = "password";
        this.innerHTML = "👁️"; // Ubah icon jadi mata terbuka
    }
});

function validatePassword() {
    let password = document.getElementById("password").value;

    function updateValidation(elementId, condition, message) {
        let element = document.getElementById(elementId);
        if (condition) {
            element.innerHTML = "✅ " + message;
            element.classList.remove("text-danger");
            element.classList.add("text-success");
        } else {
            element.innerHTML = "❌ " + message;
            element.classList.add("text-danger");
            element.classList.remove("text-success");
        }
    }

    updateValidation("lengthCheck", password.length >= 8, "Minimal 8 karakter");
    updateValidation("uppercaseCheck", /[A-Z]/.test(password), "Harus ada huruf besar (A-Z)");
    updateValidation("lowercaseCheck", /[a-z]/.test(password), "Harus ada huruf kecil (a-z)");
    updateValidation("numberCheck", /[0-9]/.test(password), "Harus ada angka (0-9)");
    updateValidation("specialCheck", /[!@#$%^&*]/.test(password), "Harus ada karakter spesial (!@#$%^&*)");
}
</script>
</body>
</html>
