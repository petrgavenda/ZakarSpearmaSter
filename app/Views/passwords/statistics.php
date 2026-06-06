<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Domů</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nejlepší objevitelé</li>
    </ol>
</nav>

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
                    <?php $rank = ($currentPage - 1) * $limit + 1; ?>
                    <?php foreach ($stats as $stat): ?>
                        <tr>
                            <td><?= $rank++ ?>.</td>
                            <td class="fw-bold"><a href="<?= base_url('people/show/' . $stat->finder_id) ?>"><?= esc($stat->firstname) ?> <?= esc($stat->lastname) ?></a></td>
                            <td><span class="badge bg-success fs-6"><?= $stat->total_discovered ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
</div>
<?= $this->endSection() ?>