<?= $this->extend('layout\header');?>
<?= $this->section('content'); ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $subtitle ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $tableTitle ?>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <!-- Tampilkan pesan error atau gagal jika ada -->
                    <?php if (session()->getFlashdata('errors') || session()->getFlashdata('gagal')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            <!-- Looping untuk menampilkan semua error jika ada -->
                            <?php if (session()->getFlashdata('errors')): ?>
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                            <?php endif; ?>
                            <!-- Tampilkan pesan gagal jika ada -->
                            <?php if (session()->getFlashdata('gagal')): ?>
                            <li><?= esc(session()->getFlashdata('gagal')) ?></li>
                            <?php endif; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="name"
                            value="<?= old('name') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" id="stock" placeholder="value"
                            value="<?= old('stock') ?>">
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="description" placeholder="about item" id="description"
                            style="height: 100px"><?= old('description') ?></textarea>
                        <label for="floatingTextarea2">Description</label>
                    </div>
                    <div class="mb-3">
                        <a class="mt-4 btn btn-warning" href="<?= base_url('item');?>">Back</a>
                        <button type="reset" class="mt-4 btn btn-secondary">Reset</button>
                        <button type="submit" name="submit" class="mt-4 btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>