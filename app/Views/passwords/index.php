<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Domů</a></li>
        <li class="breadcrumb-item active" aria-current="page">Prolomená hesla</li>
    </ol>
</nav>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Seznam prolomených hesel</h2>
        <a href="<?= base_url('passwords/create') ?>" class="btn btn-success">Zaznamenat nový objev</a>
    </div>

    <div class="card shadow-sm mb-4 bg-light">
            <div class="card-body">
                <form action="<?= base_url('passwords/process-filter') ?>" method="post" class="row g-3 align-items-end">
                    
                    <div class="col-md-4">
                        <label for="website_id" class="form-label fw-bold">Filtrovat podle webu:</label>
                        <select name="website_id" id="website_id" class="form-select border-dark border-opacity-50" required>
                            <option value="" disabled selected hidden>-- Vyberte společnost --</option>
                            <?php foreach($websites as $web): ?>
                                <option value="<?= $web->id ?>"><?= esc($web->company) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="search_people_id" class="form-label fw-bold">Filtrovat podle objevitele:</label>
                        <select name="search_people_id" id="search_people_id" class="form-select border-dark border-opacity-50" required>
                            <option value="" disabled selected hidden>-- Vyberte člověka --</option>
                            <?php foreach($people as $person): ?>
                                <option value="<?= $person->id ?>"><?= esc($person->firstname) ?> <?= esc($person->lastname) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1 shadow-sm">Filtrovat výsledky</button>
                        <a href="<?= base_url('passwords') ?>" class="btn btn-outline-secondary shadow-sm">Zrušit</a>
                    </div>
                    
                </form>
            </div>
    </div>       
    <div class="card shadow-sm">
        </div>
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
                                    <a href="<?= base_url('websites/show/' . $pass->website_id) ?>">
                                        <span class="badge bg-primary px-2 py-1">
                                            <?= esc($pass->website_company) ?>
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <code><?= esc($pass->text) ?></code>
                                </td>
                                <td>
                                    <?php if ($pass->finder_firstname): ?>
                                        <a href="<?= base_url('people/show/' . $pass->finder_id) ?>">
                                            <?= esc($pass->finder_firstname) ?> <?= esc($pass->finder_lastname) ?>
                                        </a>
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