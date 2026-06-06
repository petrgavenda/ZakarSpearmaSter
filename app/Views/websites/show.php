<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Domů</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('passwords') ?>">Prolomená hesla</a></li>
        <li class="breadcrumb-item active" aria-current="page">Webová stránka/společnost</li>
    </ol>
</nav>

<div class="container mt-5 mb-5">

    <div class="row">
        
        <div class="col-md-6 mb-4">
            <div class="p-4 bg-white rounded-4 shadow-sm border border-secondary border-opacity-25 h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white rounded-3 p-3 me-3">
                        <span class="fs-4">🌐</span>
                    </div>
                    <h1 class="display-6 fw-bold mb-0"><?= esc($website->company) ?></h1>
                </div>
                
                <hr>
                
                <p class="fs-5 mb-2">
                    <span class="text-muted">IP Adresa serveru:</span> 
                    <strong><?= esc($website->ip_address) ?></strong>
                </p>
                <p class="fs-5 mb-0">
                    <span class="text-muted">Počet uniklých hesel v databázi:</span> 
                    <span class="badge bg-danger rounded-pill"><?= $leakedPasswordsCount ?></span>
                </p>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card rounded-4 shadow-sm h-100 border-dark border-opacity-25 overflow-hidden">
                <div class="card-header bg-dark text-white border-0 py-3">
                    <h5 class="mb-0">Používané hashovací algoritmy</h5>
                </div>
                <div class="card-body p-0">
                    <?php if(!empty($hashingFunctions)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($hashingFunctions as $hf): ?>
                                <li class="list-group-item d-flex align-items-center p-3">
                                    <span class="badge bg-secondary me-3">Algoritmus</span>
                                    <span class="fs-5 fw-semibold"><?= esc($hf->name) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <div class="p-4 text-muted text-center h-100 d-flex align-items-center justify-content-center">
                            Pro tuto společnost zatím neevidujeme žádné konkrétní hashovací algoritmy.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>