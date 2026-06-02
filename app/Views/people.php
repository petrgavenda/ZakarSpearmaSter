<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-decoration-none">Domů</a></li>
        <li class="breadcrumb-item active" aria-current="page">Vyhledávání osob</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Seznam osob</h1>
    <a href="<?= base_url('create') ?>" class="btn btn-primary">Přidat osobu</a>
</div>

<div class="row">
    <?php if(!empty($people) && is_array($people)): ?>
        <?php foreach ($people as $person): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if($person->profile_picture): ?>
                        <div class="ratio ratio-1x1">
                            <img src="<?= base_url('uploads/profiles/' . $person->profile_picture) ?>" class="card-img-top object-fit-cover" alt="Profil">
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($person->firstname) ?> <?= esc($person->lastname) ?></h5>
                        <p class="card-text text-muted">Narozen/a: <?= date('Y-m-d', strtotime($person->born)) ?> </p>
                        
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('edit/' . $person->id) ?>" class="btn btn-sm btn-dark"><span class="text-white">Upravit</span></a>
                            
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $person->id ?>">
                                Smazat
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteModal<?= $person->id ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $person->id ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel<?= $person->id ?>">Potvrzení smazání</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zavřít"></button>
                        </div>
                        <div class="modal-body">
                            Opravdu chcete smazat osobu <strong><?= esc($person->firstname) ?> <?= esc($person->lastname) ?></strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="<?= base_url('delete/' . $person->id) ?>" method="post">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
                                <button type="submit" class="btn btn-danger">Ano, smazat</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Zatím nebyly přidány žádné osoby.</p>
    <?php endif; ?>
</div>

<div class="mt-4">
    <?= $pager->links('default', 'bootstrap') ?>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Potvrzení smazání</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zavřít"></button>
      </div>
      <div class="modal-body">
        Opravdu chcete tento záznam smazat? Záznam bude odstraněn.
      </div>
      <div class="modal-footer">
        <form id="deleteForm" action="" method="post">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
            <button type="submit" class="btn btn-danger">Ano, smazat</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
