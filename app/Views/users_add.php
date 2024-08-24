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
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            aria-describedby="passwordHelpBlock" placeholder="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label mb-2" for="">
                            Choice Role
                        </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="flexRadioDefault1"
                                value="admin">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Admin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="flexRadioDefault2"
                                value="user">
                            <label class="form-check-label" for="flexRadioDefault2">
                                User
                            </label>
                        </div>
                        <button type="reset" class="mt-4 btn btn-secondary">Reset</button>
                        <button type="submit" name="submit" class="mt-4 btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>