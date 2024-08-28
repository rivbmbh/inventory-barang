<?= $this->extend('layout\sign_layout');?>
<?= $this->section('user_content'); ?>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header bg-primary text-light">
                                <h3 class="text-center font-weight-light my-4">Create Account</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <!-- Tampilkan pesan error jika ada -->
                                    <?php if (session()->getFlashdata('errors')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                            <li><?= esc($error) ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="username" id="inputFirstName" type="text"
                                            placeholder="Enter your first name" />
                                        <label for="inputFirstName">Username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="email" id="inputEmail" type="email"
                                            placeholder="name@example.com" />
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" name="password" id="inputPassword"
                                                    type="password" placeholder="Create a password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" name="password_confirm"
                                                    id="inputPasswordConfirm" type="password"
                                                    placeholder="Confirm password" />
                                                <label for="inputPasswordConfirm">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0 text-end">
                                        <button type="submit" class="btn btn-primary btn-block" name="submit">Create
                                            Account</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="<?= base_url('auth/login') ?>">Have an account? Go
                                        to login</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?= $this->endSection(); ?>