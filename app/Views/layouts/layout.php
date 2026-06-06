<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hash</title>
    <script src="https://cdn.tiny.cloud/1/e9a0wrdevrnhw5rf1h4uqei2xh52j9b8ep2qfdnuxyen8j5o/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <?= $this->include('layouts/css') ?>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            
            <a class="navbar-brand" href="<?= base_url() ?>">Hash</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Rozbalit navigaci">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('people') ?>">Objevitelé</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('passwords') ?>">Hesla</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('passwords/statistics') ?>">Nejlepší objevitelé</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <?php if (auth()->loggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url('logout') ?>">Odhlásit se</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login') ?>">Přihlásit se</a>
                        </li>
                        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                            <a class="nav-link" href="<?= base_url('register') ?>">Registrace</a>
                        </li>
                    <?php endif; ?>
                </ul>
                
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zavřít"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zavřít"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

    <?= $this->renderSection('scripts') ?>
    <?= $this->include('layouts/scripts') ?>
</body>
</html>
