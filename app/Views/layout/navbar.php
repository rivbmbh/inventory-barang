<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html"><?= $subtitle ?></a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw" style="color:red;"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="<?= base_url('home'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <?php 
                        // Mendapatkan URI segmen pertama
                        $currentSegment = service('uri')->getSegment(1);

                        // Tentukan apakah dropdown harus terbuka (misalnya jika ada segmen URI yang cocok)
                        $isDropdownOpen = in_array($currentSegment, ['user', 'item', 'transaction']);
                    ?>
                    <a class="nav-link <?= $isDropdownOpen ? '' : 'collapsed' ?>" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="<?= $isDropdownOpen ? 'true' : 'false' ?>"
                        aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        <?php if(session()->get('role') === 'admin'): ?>
                        Administrator
                        <?php elseif(session()->get('role') === 'user'): ?>
                        Inventory
                        <?php endif ?>
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?= $isDropdownOpen ? 'show' : '' ?>" id="collapseLayouts"
                        aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <?php if(session()->get('role') === 'admin'): ?>
                            <a class="nav-link <?= ($currentSegment === 'user') ? 'active' : '' ?>"
                                href="<?= base_url('user') ?>">User List</a>
                            <?php endif ?>
                            <a class="nav-link <?= ($currentSegment === 'item') ? 'active' : '' ?>"
                                href="<?= base_url('item') ?>">Item List</a>
                            <a class="nav-link <?= ($currentSegment === 'transaction') ? 'active' : '' ?>"
                                href="<?= base_url('transaction') ?>">Transactions</a>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="sb-sidenav-footer">
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">