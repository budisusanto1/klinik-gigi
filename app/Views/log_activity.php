<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Log Aktivitas</h2>
            <a href="<?= base_url('home/hai') ?>" class="btn btn-primary">Back</a>
        </div>
        
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Aktivitas</th>
                    <th>Waktu</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($logs)) : ?>
                    <?php foreach ($logs as $log) : ?>
                        <tr>
                            <td><?= htmlspecialchars($log['id_user'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($log['username']) ?></td>
                            <td><?= htmlspecialchars($log['activity']) ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($log['created_at'])) ?></td>
                            <td><?= htmlspecialchars($log['ip_address']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data log aktivitas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>