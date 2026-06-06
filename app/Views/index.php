<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4 mb-5">
    
    <div class="p-5 mb-4 bg-dark text-white rounded-3 shadow">
        <div class="container-fluid py-3">
            <h1 class="display-5 fw-bold mb-3 text-light">Projekt HASH</h1>
            <p class="col-md-10 fs-5 text-light opacity-75">
                Vítejte v centralizovaném systému pro evidenci, studium a analýzu prolomených kryptografických hashů. 
                Tato platforma slouží ke sledování bezpečnostních zranitelností a mapování uniklých přihlašovacích údajů z různých webových stránek.
            </p>
            <div class="mt-4">
                <a href="<?= base_url('passwords') ?>" class="btn btn-primary btn-lg shadow-sm me-2">Prozkoumat databázi</a>
            </div>
        </div>
    </div>

    <div class="row align-items-md-stretch mt-5 g-4">
        
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-dark border-opacity-25">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">Technologie</span>
                    </div>
                    <h3 class="card-title fw-bold">Hash funkce</h3>
                    <p class="card-text mt-3 text-muted">
                        Hashovací funkce (například <strong>MD5, SHA-256 nebo RIPEMD</strong>) převádějí libovolně dlouhý text na jedinečný řetězec pevné délky. 
                        V ideálním světě je tento proces přísně jednosměrný. V našem projektu analyzujeme historické případy, kdy k reverznímu prolomení došlo, a zkoumáme slabiny zastaralých algoritmů.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-dark border-opacity-25">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <span class="badge bg-success fs-6">Výzkumníci</span>
                    </div>
                    <h3 class="card-title fw-bold">Objevitelé</h3>
                    <p class="card-text mt-3 text-muted">
                        Prolomení složitých hashů vyžaduje obrovský výpočetní výkon a hluboké kryptografické znalosti. 
                        Naši <strong>objevitelé</strong> jsou bezpečnostní výzkumníci a analytici (tzv. white-hat hackeři), 
                        kteří tyto zranitelnosti objevili, hashe dešifrovali a bezpečně je zaznamenali do našeho systému pro další studium.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-dark border-opacity-25">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <span class="badge bg-danger fs-6">Zranitelnosti</span>
                    </div>
                    <h3 class="card-title fw-bold">Uniklá hesla</h3>
                    <p class="card-text mt-3 text-muted">
                        Evidujeme záznamy o prolomených heslech k desítkám webových stránek a společností. 
                        Naše rozsáhlá databáze neslouží ke zneužití, ale funguje jako <strong>studijní a preventivní materiál</strong>. 
                        Jasně demonstruje, proč je pro dnešní systémy kriticky důležité používat silné solení (salting) a moderní šifrování.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>
