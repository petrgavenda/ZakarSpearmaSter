<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="mb-4">Top objevitelé</h2>
    
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Pořadí</th>
                        <th>Jméno objevitele</th>
                        <th>Počet objevených hashů</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $rank = 1; ?>
                    <?php foreach ($stats as $stat): ?>
                        <tr>
                            <td><?= $rank++ ?>.</td>
                            <td class="fw-bold"><?= esc($stat->firstname) ?> <?= esc($stat->lastname) ?></td>
                            <td><span class="badge bg-success fs-6"><?= $stat->total_discovered ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>