<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Domů</a></li>
        <li class="breadcrumb-item"><a href="/">Vyhledávání osob</a></li>
        <li class="breadcrumb-item active" aria-current="page">Přidat osobu</li>
    </ol>
</nav>

<div class="card shadow-sm mt-4">
    <div class="card-header bg-white">
        <h2 class="mb-0">Přidat novou osobu</h2>
    </div>
    <div class="card-body">
        <form action="<?= base_url('store') ?>" method="post" enctype="multipart/form-data">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstname" class="form-label">Jméno *</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastname" class="form-label">Příjmení *</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="born" class="form-label">Datum narození *</label>
                    <input type="date" class="form-control" id="born" name="born" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="profile_picture" class="form-label">Profilová fotka (Upload)</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                </div>
            </div>

            <div class="mb-3">
                <label for="biography" class="form-label">Biografie (WYSIWYG)</label>
                <textarea class="form-control" id="biography" name="biography" rows="5"></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <a href="/" class="btn btn-secondary me-2">Zrušit</a>
                <button type="submit" class="btn btn-success">Uložit osobu</button>
            </div>

        </form>
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