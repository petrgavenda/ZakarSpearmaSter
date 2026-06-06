<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Domů</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('passwords') ?>">Prolomená hesla</a></li>
        <li class="breadcrumb-item active" aria-current="page">Přidat nové heslo</li>
    </ol>
</nav>

<div class="container mt-5">
    <h2>Přidat nové heslo a vygenerovat hashe</h2>
    
    <form action="<?= base_url('passwords/store') ?>" method="post" class="mt-4">
        
        <div class="mb-4">
            <label for="website_id" class="form-label fw-bold">Webová stránka / Společnost</label>
            <select name="website_id" id="website_id" class="form-select border border-dark border-opacity-50 shadow-sm" required>
                <option value="" disabled selected hidden>-- Vyberte webovou stránku --</option>
                
                <?php foreach ($websites as $web): ?>
                    <option value="<?= $web->id ?>"><?= esc($web->company) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="search_people_id" class="form-label fw-bold">Objevitel hashe</label>
            <select name="search_people_id" id="search_people_id" class="form-select border border-dark border-opacity-50 shadow-sm" required>
                <option value="" disabled selected hidden>-- Vyberte objevitele --</option>
                
                <?php foreach ($people as $person): ?>
                    <option value="<?= $person->id ?>"><?= esc($person->firstname) ?> <?= esc($person->lastname) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="password_value" class="form-label fw-bold">Heslo</label>
            <input type="text" name="password_value" id="password_value" class="form-control border border-dark border-opacity-50 shadow-sm" required>
            <div class="form-text">Hashe (MD5, SHA-256, RIPEMD) se vygenerují automaticky po uložení.</div>
        </div>

        <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">Uložit a zahašovat</button>
    </form>
</div>
<?= $this->endSection() ?>