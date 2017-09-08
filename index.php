<!DOCTYPE html>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    session_start();
    include_once('imports/import_head.php');
    ?>
    <body>
        <?php
        ?>
        <div class="container">
            <div class="main-content">
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" arial-label="Close"><span arial-hidden="true">&times;</span></button>
                        <span>Usuário ou senha incorretos!</span>
                        </div>';
                    unset($_SESSION['error']);
                }
                ?>
                <div class="content-title">SistConts Login</div>
                <form method="post" action="./functions/Usuario.php?action=0" autocomplete="off">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Usuário</label>
                                <input type="text" name="user" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span class="label-form">Senha</span>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9">
                            <input type="submit" value="Acessar" class="btn btn-success">
                        </div>
                        <div class="col-sm-3">
                            <a href="cadusuario.php">cadastre-se</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <?php
        include_once('./imports/import_footer.php');
        ?>
    </body>
</html>
