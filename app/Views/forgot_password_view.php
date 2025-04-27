<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="<?= base_url ('assets/css/style.css')?>" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <p>Enter your email and we’ll send a reset link.</p>
        <form action="<?= base_url('/home/forgot_password') ?>" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Send Reset Link</button>
        </form>
    </div>
</body>
</html>
