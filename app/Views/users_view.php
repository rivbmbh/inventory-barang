<?= $this->extend('layout\user_layout');?>
<?= $this->section('user_content'); ?>
<?= $this->include('layout\user_navbar') ?>
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
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Created At</th>
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
                            <td><?= $row['password']?></td>
                            <td><?= $row['role']?></td>
                            <td><?= $row['created_at']?></td>
                            <td>
                                <a href="#">edit</a>
                                <a href="#">delete</a>
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