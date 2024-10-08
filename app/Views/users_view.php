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
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                                $no = 1;
                                foreach($dataUsers as $row):
                            ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['username']?></td>
                            <td><?= $row['email']?></td>
                            <td><?= $row['password']?></td>
                            <td><?= $row['role']?></td>
                            <td><?= $row['created_at']?></td>
                            <td><?= $row['updated_at']?></td>
                            <td class="d-flex justify-content-between">
                                <a class="fs-6 p-1" href="<?= base_url('user/update/'). $row['id']?>"><i
                                        class="fa-solid fa-file-pen" style="color:skyblue"></i></a>
                                <a class="fs-6 p-1" href="<?= base_url('user/delete/'). $row['id']?>"
                                    onclick="return confirm('Are you sure you want to delete this user?');"><i
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