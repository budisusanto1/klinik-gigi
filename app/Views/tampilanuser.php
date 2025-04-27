<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
      <h5 class="card-header">User</h5>

      <div class="table-responsive text-nowrap">
        <table class="table datatable">
          <thead class="table-light">
            <tr>
              <th colspan="4">
                <a href="/home/tambahuser" class="btn btn-success mb-3 text-white">
                  Tambah
                </a>
              </th>
            </tr>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php $ms = 1; ?>
            <?php foreach ($es1 as $value) : ?>
              <tr>
                <th scope="row"><?= $ms++ ?></th>
                <td><?= esc($value->username) ?></td>
                <td><?= esc($value->email) ?></td>
                <td>
                  <a href="<?= base_url('home/edit_user/' . $value->id_user) ?>" class="btn btn-warning">
                    <i class="ri-edit-line"></i> Edit
                  </a>
                  <a href="<?= base_url('home/hapus_user/' . $value->id_user) ?>" class="btn btn-danger"
                     onclick="return confirm('Are you sure you want to delete this item?');">
                    <i class="ri-delete-bin-line"></i> Delete
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Tampilkan hanya jika role adalah admin -->
    <?php if (session()->get('role') == 'admin') : ?>
      <div class="card mt-4">
        <h5 class="card-header">Deleted User</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($deleted_items as $item) : ?>
                <tr>
                  <td><?= esc($item->username) ?></td>
                  <td><?= esc($item->email) ?></td>
                  <td>
                    <a href="<?= base_url('home/restore_user/' . $item->id_user) ?>" class="btn btn-outline-primary">
                      <i class="ri-arrow-go-back-line"></i> Restore
                    </a>
                    <a href="<?= base_url('home/delete_permanently_user/' . $item->id_user) ?>" class="btn btn-outline-danger">
                      <i class="ri-delete-bin-line"></i> Delete Permanently
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
