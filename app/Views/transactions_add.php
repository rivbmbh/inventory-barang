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
                        <label for="#" class="form-label">Select Items</label>
                        <select class="form-select" name="item_id" aria-label="Default select example">
                            <option value="">--select--</option>
                            <?php foreach($dataItem as $row): ?>
                            <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="value"
                            value="<?= old('quantity') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Transaction Type</label>
                        <select class="form-select" name="type" aria-label="Default select example">
                            <option value="">--type--</option>
                            <option value="in">Goods In</option>
                            <option value="out">Goods Out</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <a class="mt-4 btn btn-warning" href="<?= base_url('transaction');?>">Back</a>
                        <button type="reset" class="mt-4 btn btn-secondary">Reset</button>
                        <button type="submit" name="submit" class="mt-4 btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>