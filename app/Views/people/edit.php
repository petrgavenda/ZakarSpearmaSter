<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Domů</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('people') ?>">Vyhledávání osob</a></li>
        <li class="breadcrumb-item active" aria-current="page">Upravit osobu</li>
    </ol>
</nav>

<div class="card shadow-sm mt-4">
    <div class="card-header bg-white">
        <h2 class="mb-0">Upravit osobu: <?= esc($person->firstname) ?> <?= esc($person->lastname) ?></h2>
    </div>
    <div class="card-body">
        
        <?= form_open_multipart('people/update/' . $person->id) ?>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstname" class="form-label">Jméno *</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?= set_value('firstname', $person->firstname) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastname" class="form-label">Příjmení *</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?= set_value('lastname', $person->lastname) ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="born" class="form-label">Datum narození *</label>
                    <input type="date" class="form-control" id="born" name="born" value="<?= set_value('born', date('Y-m-d', strtotime($person->born))) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="profile_picture" class="form-label">Profilová fotka</label>
                    <input type="file" class="form-control mb-2" id="profile_picture" name="profile_picture" accept="image/*">
                    <small class="text-muted">Pokud nevyberete žádný soubor, zůstane zachován stávající obrázek.</small>
                    
                    <?php if($person->profile_picture): ?>
                        <div class="mt-2">
                            <strong>Aktuální obrázek:</strong><br>
                            <img src="<?= base_url('uploads/profiles/' . $person->profile_picture) ?>" alt="Aktuální profilovka" class="img-thumbnail mt-1" style="max-height: 100px;">
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="biography" class="form-label">Biografie</label>
                <textarea class="form-control" id="biography" name="biography" rows="5"><?= set_value('biography', $person->biography) ?></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <a href="<?= base_url('people') ?>" class="btn btn-secondary me-2">Zrušit</a>
                <button type="submit" class="btn btn-primary">Uložit změny</button>
            </div>

        <?= form_close() ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    tinymce.init({
        selector: '#biography',
        language: 'cs',
        menubar: false,
        plugins: 'lists link',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
</script>
<?= $this->endSection() ?>