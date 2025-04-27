<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Aplikasi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
</head>
<body>
    <div class="uk-container">
        <h2>Pengaturan Aplikasi</h2>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="uk-alert-success" uk-alert>
                <p><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('home/simpan_pengaturan') ?>" method="post" enctype="multipart/form-data">
            <div class="uk-margin">
                <label>Judul</label>
                <input class="uk-input" type="text" name="judul" value="<?= $pengaturan->judul ?? '' ?>" required>
            </div>
            <div class="uk-margin">
                <label>Owner</label>
                <input class="uk-input" type="text" name="owner" value="<?= $pengaturan->owner ?? '' ?>" required>
            </div>
            <div class="uk-margin">
                <label>Nama Aplikasi</label>
                <input class="uk-input" type="text" name="nama_app" value="<?= $pengaturan->nama_app ?? '' ?>" required>
            </div>
            <div class="uk-margin">
                <label>Logo</label>
                <input class="uk-input" type="file" name="logo">
                <?php if (!empty($pengaturan->logo)): ?>
                    <div class="uk-margin">
                        <img src="<?= base_url('uploads/' . $pengaturan->logo) ?>" alt="Logo" width="100">
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="uk-button uk-button-primary">Simpan</button>
        </form>
    </div>
</body>
</html>