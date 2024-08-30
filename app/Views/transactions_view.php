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
                <!-- Tampilkan pesan success jika ada -->
                <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <div class="mb-3">
                    <a class="btn btn-success" href="<?= base_url('transaction/add') ?>">📑Add
                        Transaction</a>
                </div>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item ID</th>
                            <th>User ID</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Transaction Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Item ID</th>
                            <th>User ID</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Transaction Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                                $no = 1;
                                foreach($dataTransaction as $row):
                            ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['item_name']?></td>
                            <td><?= $row['user_name']?></td>
                            <td><?= $row['type']?></td>
                            <td><?= $row['quantity']?></td>
                            <td><?= $row['transaction_date']?></td>
                            <td class="d-flex justify-content-between">
                                <a class="fs-6 p-1" href="<?= base_url('transaction/update/'). $row['id']?>"><i
                                        class="fa-solid fa-file-pen" style="color:skyblue"></i></a>
                                <a class="fs-6 p-1" href="<?= base_url('transaction/delete/'). $row['id']?>"
                                    onclick="return confirm('Are you sure you want to delete this transaction?');"><i
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