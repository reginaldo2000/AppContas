<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ContasApp</title>
        <link href="<?= url("/vendor/twbs/bootstrap/dist/css/bootstrap.min.css"); ?>" rel="stylesheet">
        <link href="<?= url("/assets/style.css"); ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    </head>
    <body>
        <header class="cabecalho">
            <h1 class="titulo_sistema">ContasApp 1.0</h1>
        </header>
        
        <nav class="menu_site">
            <ul>
                <li>
                    <a href="<?= url("/dashboard"); ?>">
                        <i class="bi bi-microsoft"></i>&nbsp;Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= url("/categoria"); ?>">
                        <i class="bi bi-layers-fill"></i>&nbsp;Categorias
                    </a>
                </li>
                <li>
                    <a href="<?= url("/conta"); ?>">
                       <i class="bi bi-currency-exchange"></i>&nbsp;Contas
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-printer-fill"></i>&nbsp;Relatórios
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-gear-fill"></i>&nbsp;Configurações
                    </a>
                </li>
            </ul>
        </nav>
        
        <main class="site_main">

            <h2 class="titulo_pagina"><?= $titulo; ?></h2>
            <hr>

            <?= $v->section("content"); ?>
            
        </main>
        
        <script src="<?= url("/assets/jquery.min.js"); ?>"></script>
        <script src="<?= url("/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"); ?>"></script>
        <script src="<?= url("/assets/ajax-form.js"); ?>"></script>
        <script src="<?= url("/assets/functions.js"); ?>"></script>
        <?= $v->section("script"); ?>
    </body>
</html>
