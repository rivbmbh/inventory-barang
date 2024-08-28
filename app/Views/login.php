<?= $this->extend('layout\sign_layout');?>
<?= $this->section('user_content'); ?>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header bg-primary text-light">
                                <h3 class="text-center font-weight-light my-4">Login</h3>
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
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>

                                    <!-- Tampilkan pesan success jika ada -->
                                    <?php if(session()->getFlashdata('success')): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?= session()->getFlashdata('success') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="email" id="inputEmail" type="email"
                                            placeholder="name@example.com" value="<?= old('username') ?>" />
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="password" id="inputPassword" type="password"
                                            placeholder="Password" />
                                        <label for="inputPassword">Password</label>
                                    </div>
                                    <!-- <div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                            value="" />
                                        <label class="form-check-label" for="inputRememberPassword">Remember
                                            Password</label>
                                    </div> -->
                                    <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                        <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                        <button type="submit" class="btn btn-primary btn-block"
                                            name="login">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="<?= base_url('auth/register') ?>">Need an
                                        account? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?= $this->endSection(); ?>