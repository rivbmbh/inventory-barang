<?= $this->extend('layout\header');?>
namespace App\Views;
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $subtitle; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <h1 class="mt-4"><?= $tableTitle ?></h1>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>