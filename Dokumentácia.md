

# Dokumentace projektu ZakarSpearmaSter

## 1. Popis projektu a rozdělení práce

Projekt je webová aplikace postavená na frameworku **CodeIgniter 4**. Slouží pro evidenci lidí, webových stránek a nalezených hesel včetně jejich hashů. Aplikace obsahuje přehledy, filtrování, statistiky a správu záznamů.

| Práce | Gavenda | Formánek | AI |
|---|---:|---|---|
| Struktura databáze | 100% | 0% | 0% |
| Názvologie | 95% | 5% | 0% |
| Web | -1% | 89% | 12% |
| Obsah databáze | 45% | 40% | 15% |
| Programátorská kvalita | -5% | 20% | 85% |
| Dokumentace | 2% | 0% | 98% |
| Github | 80% | 20% | 0% |
| Romská menšina | 21% | 80% | -1% |
| Migrace | 0,01% | 96% | 3,99% |

## 2. Použité externí nástroje a knihovny

Níže jsou uvedené hlavní externí knihovny a nástroje používané v projektu.

| Název knihovny | Verze | Autor | Licence | Odkaz |
|---|---:|---|---|---|
| CodeIgniter Framework | `^4.0` | CodeIgniter Foundation | MIT | https://codeigniter.com / https://github.com/codeigniter4/CodeIgniter4 |
| CodeIgniter Shield | `^1.3` | CodeIgniter Foundation | MIT | https://github.com/codeigniter4/shield |
| Bootstrap | `^5.3` | The Bootstrap Authors | MIT | https://getbootstrap.com |
| Bootswatch Lux theme | `^5.3` | Thomas Park | MIT | https://bootswatch.com/lux/ |
| PHPUnit | `^10.5.16` | Sebastian Bergmann a komunita PHPUnit | BSD-3-Clause | https://phpunit.de |
| Faker | `^1.9` | FakerPHP Community | MIT | https://github.com/FakerPHP/Faker |
| vfsStream | `^1.6` | mikey179 | BSD-3-Clause | https://github.com/mikey179/vfsStream |

### Poznámky k verzím
- Verze jsou převzaty z `composer.json`.
- U některých knihoven je uveden přesný balíček, ne ručně nastavená konkrétní patch verze.
- Bootstrap je v projektu používán přes lokální vendor cestu:
  - CSS: `vendor/thomaspark/bootswatch/dist/lux/bootstrap.min.css`
  - JS: `vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js`

---

## 3. Použité části frameworku CodeIgniter

Projekt využívá standardní architekturu CodeIgniter 4:

- **Controllers** – řídí logiku aplikace
- **Models** – pracují s databází
- **Config** – obsahuje konfigurační třídy
- **Views** – zobrazují HTML
- **Routing** – určuje mapování URL na kontrolery

---

## 4. Přehled kontrolerů a jejich metod

### 4.1 `Home`

Soubor: `app/Controllers/Home.php`

#### `index()`
- Zobrazuje úvodní stránku aplikace.
- Vrací view `index`.

---

### 4.2 `People`

Soubor: `app/Controllers/People.php`

Tento kontroler zajišťuje správu osob.

#### `__construct()`
- Inicializuje model `SearchPeople`.
- Připravuje přístup k datům o osobách.

#### `index()`
- Zobrazí seznam osob.
- Používá stránkování podle hodnoty `PER_PAGE_PEOPLE`.
- Předává do view data `people` a `pager`.

#### `delete($id)`
- Smaže osobu podle ID.
- Nejprve ověří, zda osoba existuje.
- Pokud ano, záznam smaže a vrátí úspěšnou hlášku.
- Pokud ne, vrátí chybovou hlášku.

#### `create()`
- Zobrazí formulář pro vytvoření nové osoby.

#### `store()`
- Zpracuje odeslaný formulář nové osoby.
- Načte jméno, příjmení, datum narození a biografii.
- Zpracuje případný upload profilové fotografie.
- Uloží nového člověka do databáze.

#### `edit($id)`
- Zobrazí formulář pro úpravu osoby.
- Nejprve ověří, zda osoba existuje.
- Pokud neexistuje, přesměruje zpět se zprávou o chybě.

#### `update($id)`
- Aktualizuje existující osobu podle ID.
- Zpracuje nové hodnoty formuláře.
- Pokud je nahrán nový obrázek, uloží jej a smaže starý.
- Uloží změny do databáze.

#### `show($id)`
- Zobrazí detail jedné osoby.
- Předá do view konkrétní záznam osoby.

---

### 4.3 `Password`

Soubor: `app/Controllers/Password.php`

Tento kontroler spravuje záznamy o heslech a jejich statistikách.

#### `__construct()`
- Inicializuje modely:
  - `SearchPeople`
  - `Website`
  - `Password`

#### `index()`
- Zobrazí seznam hesel.
- Načítá data z více tabulek přes JOIN:
  - heslo
  - webová stránka
  - osoba, která heslo objevila
- Používá stránkování podle `PER_PAGE_PASSWORDS`.

#### `create()`
- Zobrazí formulář pro přidání nového záznamu o hesle.
- Předává seznam webů a osob pro výběr ve formuláři.

#### `store()`
- Zpracuje uložený formulář hesla.
- Načte heslo, web a osobu, která ho našla.
- Uloží:
  - původní text hesla
  - MD5 hash
  - SHA-256 hash
  - RIPEMD-160 hash
- Vloží záznam do databáze.

#### `statistics()`
- Zobrazí statistiku objevitelů hesel.
- Seskupuje data podle osoby.
- Počítá počet nalezených hashů.
- Seřazuje výsledky sestupně podle počtu nálezů.
- Používá stránkování podle `PER_PAGE_STATISTICS`.

#### `filter($websiteId, $searchPeopleId)`
- Zobrazí seznam hesel filtrovaný podle webu a objevitele.
- Vytváří výsledek přes JOIN a WHERE podmínky.
- Vrací stejné zobrazení jako seznam hesel, ale jen s vybranými daty.

#### `processFilter()`
- Zpracuje odeslaný filtr z formuláře.
- Zkontroluje, zda byly vybrány oba údaje:
  - web
  - objevitel
- Pokud ne, vrací chybu.
- Pokud ano, přesměruje na filtrovaný seznam.

---

### 4.4 `Website`

Soubor: `app/Controllers/Website.php`

Tento kontroler zobrazuje detail webové stránky.

#### `show($id)`
- Načte detail webu podle ID.
- Načte seznam hashovacích funkcí přiřazených k webu.
- Spočítá počet uniklých hesel pro daný web.
- Předá data do view `websites/show`.

---

## 5. Vlastní knihovny a jejich metody

V rámci nalezených souborů nebyla zjištěna samostatná vlastní knihovna v adresáři `app/Libraries`.

Zároveň je vidět, že projekt používá hlavně:
- kontrolery v `app/Controllers`
- modely v `app/Models`
- konfigurační třídy v `app/Config`

Pokud chcete, můžu ještě udělat hlubší průzkum a dohledat případné vlastní helpery, služby nebo knihovny, pokud jsou ve zbytku projektu.

---

## 6. Popis konfiguračních proměnných

### 6.1 `app/Config/Pager.php`

#### `templates`
Určuje šablony pro stránkování.

- `default_full` – standardní plná šablona CodeIgniteru
- `default_simple` – jednoduchá šablona
- `default_head` – hlavičková varianta
- `bootstrap` – vlastní šablona `App\Views\pager\pager`

#### `perPage`
- Výchozí počet položek na stránku.
- V projektu je nastaveno na `9`.

---

### 6.2 `app/Config/Autoload.php`

#### `psr4`
- Mapuje namespace `App\` na složku `app/`.
- Slouží k automatickému načítání tříd.

#### `classmap`
- Ruční mapa tříd.
- V projektu je prázdná.

#### `files`
- Seznam souborů, které se mají načíst automaticky.
- V projektu je prázdný.

#### `helpers`
- Automaticky načítané helpery.
- V projektu:
  - `auth`
  - `setting`

---

### 6.3 `app/Config/Routes.php`

Soubor definuje směrování URL.

#### Hlavní routy
- `/` → `Home::index`
- `/people` → `People::index`
- `/passwords` → `Password::index`
- `/websites/show/{id}` → `Website::show`

#### Skupina `people`
Chrání CRUD operace nad osobami filtrem:
- `group:admin`

Obsahuje:
- `people/create`
- `people/store`
- `people/edit/(:num)`
- `people/update/(:num)`
- `people/delete/(:num)`

#### Password routy
- `passwords/create`
- `passwords/store`
- `passwords/filter/(:num)/(:num)`
- `passwords/process-filter`
- `passwords/statistics`

---

### 6.4 `app/Config/Database.php`

#### `filesPath`
- Cesta k migracím a seedům.

#### `defaultGroup`
- Výchozí skupina připojení k databázi.
- Hodnota: `default`

#### `default`
Hlavní databázové připojení:
- `hostname` = `localhost`
- `username` = `root`
- `password` = prázdné
- `database` = `ZakarSpearmaSter`
- `DBDriver` = `MySQLi`
- `DBDebug` = `true`
- `charset` = `utf8mb4`
- `DBCollat` = `utf8mb4_general_ci`

#### Význam
Tato konfigurace určuje, jak se aplikace připojuje k databázi a jaké použije výchozí parametry.

---

### 6.5 `app/Config/Filters.php`

#### `aliases`
Mapování názvů filtrů na jejich třídy:
- `csrf`
- `toolbar`
- `honeypot`
- `invalidchars`
- `secureheaders`
- další CodeIgniter filtry

#### `globals`
Filtry aplikované globálně:
- `before`
- `after`

V projektu jsou globální filtry převážně vypnuté, připravené pro případné zapnutí.

#### `methods`
- Filtry podle HTTP metod.
- V ukázaných částech nejsou aktivně nastavené.

#### `filters`
- Cílené routové filtry.
- V projektu jsou připravené pro další konfiguraci.

---

### 6.6 `app/Config/Exceptions.php`

#### `log`
- Určuje, zda se mají výjimky logovat.
- Hodnota: `true`

#### `ignoreCodes`
- Seznam HTTP kódů, které se nebudou logovat.
- V projektu: `404`

---

### 6.7 `app/Config/UserAgents.php`

Tento soubor obsahuje mapování pro rozpoznávání uživatelských agentů.

#### `platforms`
- Seznam operačních systémů a platforem.

#### `browsers`
- Seznam prohlížečů.

#### `robots`
- Seznam robotů a crawlerů.

#### `mobiles`
- Seznam mobilních zařízení.

#### Význam
Třída pomáhá systému identifikovat:
- prohlížeč
- platformu
- robota
- mobilní zařízení

---

### 6.8 `app/Config/Honeypot.php`

#### `hidden`
- Určuje, zda je honeypot skrytý.
- Hodnota: `true`

#### `label`
- Text labelu honeypot pole.
- Hodnota: `Fill This Field`

#### `name`
- Název pole.
- Hodnota: `honeypot`

#### `template`
- HTML šablona honeypot pole.

#### `container`
- Obalující HTML kontejner.

#### `containerId`
- ID kontejneru.
- Hodnota: `hpc`

---

### 6.9 `app/Config/Kint.php`

Konfigurace ladicí knihovny Kint.

#### `maxDepth`
- Maximální hloubka zobrazení dat.

#### `displayCalledFrom`
- Zobrazuje místo, odkud byl dump zavolán.

#### `expanded`
- Určuje, zda má být výstup rozbalený.

#### `richTheme`
- Téma pro rich renderer.

#### `richFolder`
- Zobrazení jako složka.

Tento soubor slouží hlavně pro debugování a výpis proměnných.

---

### 6.10 `app/Config/Images.php`

#### `defaultHandler`
- Výchozí image handler.
- Hodnota: `gd`

#### `libraryPath`
- Cesta k obrazové knihovně.

#### `handlers`
- Dostupné handlery:
  - `gd`
  - `imagick`

---

### 6.11 `app/Config/Logger.php`

Tento soubor určuje úroveň logování.

#### `threshold`
- V dokumentaci souboru je uvedeno, že hodnoty:
  - `0` = vypnuto
  - `1` = emergency
  - `2` = alert
  - `3` = critical
  - `4` = runtime errors
  - `5` = warnings
  - `6` = notices
  - `7` = info
  - `8` = debug

Tento soubor slouží pro nastavení, co se bude zapisovat do logu aplikace.

---

## 7. Použití Bootstrapu

Bootstrap je použit pro vzhled a responzivitu aplikace.

### Použití v projektu
- CSS:
  - `app/Views/layouts/css.php`
- JS:
  - `app/Views/layouts/scripts.php`
- V paginatoru:
  - `app/Config/Pager.php` → template `bootstrap`

### Přínos
- responzivní layout
- komponenty jako tabulky, karty, breadcrumb, tlačítka
- lepší vizuální konzistence aplikace

---

## 8. Shrnutí funkcionality aplikace

Aplikace umožňuje:
- správu osob
- přidávání a úpravu osob
- ukládání profilových obrázků
- evidenci hesel
- generování hashů hesel
- filtrování hesel podle webu a osoby
- statistiku nejaktivnějších objevitelů
- zobrazení detailů webů a jejich hashovacích funkcí

---
