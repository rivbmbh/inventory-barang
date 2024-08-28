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
                <!-- Tampilkan pesan error jika ada -->
                <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <!-- Tampilkan pesan success jika ada -->
                <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <div class="mb-3">
                    <a class="btn btn-success" href="<?= base_url('item/add') ?>">📑Add
                        Item</a>
                </div>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                                $no = 1;
                                foreach($dataItems as $row):
                            ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['name']?></td>
                            <td><?= $row['description']?></td>
                            <td><?= $row['stock']?></td>
                            <td><?= $row['created_at']?></td>
                            <td class="d-flex justify-content-between">
                                <a class="fs-6 p-1" href="<?= base_url('item/update/'). $row['id']?>"><i
                                        class="fa-solid fa-file-pen" style="color:skyblue"></i></a>
                                <a class="fs-6 p-1" href="<?= base_url('item/delete/'). $row['id']?>"
                                    onclick="return confirm('Are you sure you want to delete this item?');"><i
                                        class="fa-solid fa-circle-xmark" style="color:red"></i></a>
                            </td>
                        </tr>
                        <?php 
                            $no++;
                            endforeach; 
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>