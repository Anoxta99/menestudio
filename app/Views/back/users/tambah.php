<?= $this->extend('back/layouts/main'); ?>
<?= $this->section('content'); ?>
<?= $this->section('sidebar') ?>
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('/admin/dashboard'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item active">
    <a class="nav-link collapsed" href="<?= base_url() ?>users" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-users"></i>
        <span>Users</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url() ?>admin/users">Semua</a>
            <a class="collapse-item" href="<?= base_url() ?>admin/users/admin">Admin</a>
            <a class="collapse-item" href="<?= base_url() ?>admin/users/pelanggan">Pelanggan</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/paket">
        <i class="fas fa-fw fa-box"></i>
        <span>Paket</span></a>
</li>

<!-- Nav Item - Transaksi -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/transaksi">
        <i class="fas fa-fw fa-table"></i>
        <span>Transaksi</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
<?= $this->endSection() ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>

    <!-- Display error or success message -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('admin/users/tambah') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="row px-2 mb-3">
                    <label for="no_hp" class="form-label">Nomor Telepon</label>
                    <input type="number" class="form-control" id="no_hp" name="no_hp">
                </div>
                <div class="row px-2 mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" id="role" required>
                        <option value="1">Admin</option>
                        <option value="2">Pelanggan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="foto_profil" class="form-label">Foto Profil</label>
                    <input type="file" class="form-control" id="foto_profil" name="foto_profil">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>