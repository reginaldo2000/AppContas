<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - ContasApp</title>
        <link href="<?= url("/vendor/twbs/bootstrap/dist/css/bootstrap.min.css"); ?>" rel="stylesheet">
        <link href="<?= url("/assets/style.css"); ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    </head>
    <body>
        <main class="content_main">
            <section class="content_login">
                
                <?php openAlertMessage(); ?>
                
                <h1 class="login_title">Login - ContasApp</h1>
                
                <form method="POST" action="<?= url("/logar"); ?>" autocomplete="off">
                    <div class="row">
                        
                        <div class="col-lg-12 mb-3">
                            <label>Usuário:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-emoji-smile-fill"></i></span>
                                <input type="text" name="login_usuario" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-lg-12 mb-3">
                            <label>Senha:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="login_senha" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                <i class="bi bi-door-open-fill"></i> Entrar
                            </button>
                        </div>
                        
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>
