<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    if(isset($_GET['confirm'])) {
        header("location:index.php");
    }
    include_once('./imports/import_head.php');
    ?>
    <body>
        <?php
        include('./themes/header.php');
        ?>
        <div class="container">
            <div class="main-content">
                <div class="content-title">Formulário de Cadastro</div>
                <form method="post" action="./functions/Usuario.php?action=1" autocomplete="off">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Usuário</label>
                                <input type="text" name="usuario" class="form-control" required="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" name="senha_user" id="senha" class="form-control" minlength="6" required="true">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirmar Senha</label>
                                <input type="password" name="confirm-senha" class="form-control" required="true" onkeyup="verificarSenha(this.value);">
                            </div>
                        </div>
                        <div id="valida-senha" class="alert alert-danger alert-dismissible">
                            <span>Senhas incompatíveis!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Fechamento da Fatura</label>
                                <select name="fechamento" class="form-control">
                                    <?php
                                    for ($i = 1; $i <= 31; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Vencimento da Fatura</label>
                                <select name="vencimento" class="form-control">
                                    <?php
                                    for ($i = 1; $i <= 31; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="submit" value="Cadastrar" class="btn btn-success width-100">
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
