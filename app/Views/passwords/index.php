<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Seznam prolomených hesel</h2>
        <a href="<?= base_url('passwords/create') ?>" class="btn btn-success">Zaznamenat nový objev</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Webová stránka / Společnost</th>
                        <th>Heslo</th>
                        <th>Hash objevil/a</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($passwords)): ?>
                        <?php foreach ($passwords as $pass): ?>
                            <tr>
                                <td><?= $pass->id ?></td>
                                <td>
                                    <span class="badge bg-primary px-2 py-1">
                                        <?= esc($pass->website_company ?? 'Neznámý web') ?>
                                    </span>
                                </td>
                                <td>
                                    <code><?= esc($pass->text) ?></code>
                                </td>
                                <td>
                                    <?php if ($pass->finder_firstname): ?>
                                        <?= esc($pass->finder_firstname) ?> <?= esc($pass->finder_lastname) ?>
                                    <?php else: ?>
                                        <span class="text-muted italic">Anonymní výzkumník</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4">Zatím nebyla zaznamenána žádná hesla ani objevy.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
</div>
<?= $this->endSection() ?>