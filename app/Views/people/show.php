<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Domů</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('people') ?>">Vyhledávání osob</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profil objevitele</li>
    </ol>
</nav>

<div class="container mt-5 mb-5">

    <div class="row align-items-start mb-5 bg-dark text-white rounded shadow-sm p-4">
        
        <div class="col-md-8 order-2 order-md-1 mt-4 mt-md-0">
            <h1 class="display-5 fw-bold mb-2 text-white"><?= esc($person->firstname) ?> <?= esc($person->lastname) ?></h1>
            <p class="lead mb-4 text-white">Narozen/a: <?= date('d. m. Y', strtotime($person->born)) ?></p>
            
            <div class="biography mt-4">
                <h4 class="fw-bold mb-3 text-white">Biografie</h4>
                <?= $person->biography ?? 'Tento objevitel zatím nemá vyplněnou biografii.' ?> 
            </div>
        </div>

        <div class="col-md-4 order-1 order-md-2 text-center text-md-end">
            <?php if($person->profile_picture): ?>
                <img src="<?= base_url('uploads/profiles/' . $person->profile_picture) ?>" class="img-fluid rounded shadow" alt="Profil <?= esc($person->firstname) ?>">
            <?php else: ?>
                <div class="bg-light text-muted d-flex justify-content-center align-items-center rounded shadow mx-auto ms-md-auto me-md-0" style="width: 250px; height: 250px;">
                    <span>Bez fotografie</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>