<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login - ContasApp</title>
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
                    <a href="<?= url("/dashboard"); ?>">Dashboard</a>
                </li>
                <li>
                    <a href="<?= url("/categoria"); ?>">Categorias</a>
                </li>
                <li>
                    <a href="#">Contas</a>
                </li>
                <li>
                    <a href="#">Relatórios</a>
                </li>
                <li>
                    <a href="#">Configurações</a>
                </li>
            </ul>
        </nav>
        
        <main class="site_main">

            <h2 class="titulo_pagina"><?= $titulo; ?></h2>
            <hr>

            <?= $v->section("content"); ?>
            
        </main>
        
        <script src="<?= url("/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"); ?>"></script>
    </body>
</html>
