<!DOCTYPE html>
<?php
session_start();
//echo '<br><br><br><br>'.date('U').'<br>'.date('U', strtotime('2016-08-01'));
include_once('./functions/ContasClass.php');
$contas = new ContasClass();
?>
<html>
    <?php
    include_once('./imports/import_head.php');
    ?>
    <body>
        <?php
        include('./themes/header.php');
        include('./themes/menu.php');
        ?>
        <div class="container">
            <div class="main-content">
                <?php
                if (isset($_SESSION['confirm'])) {
                    echo '<div class="alert alert-success alert-dismissible">
                        <span>Conta cadastrada com sucesso!</span>
                        </div>';
                    unset($_SESSION['confirm']);
                }
                ?>

                <div class="form-title">Cadastrar Conta</div>
                <form method="post" autocomplete="off" name="cadcontas" action="./functions/Contas.php?action=1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="label-form">Descrição</span>
                                <input type="text" name="descricao" class="form-control text-uppercase" minlength="4" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="label-form">Categoria da Conta</span>
                                <select name="categoria" class="form-control" required onchange="setData(this,<?php echo $contas->getDiaVencimento(); ?>,<?php echo $contas->getDiaFechamento(); ?>);">
                                    <option value="">Selecione uma...</option>
                                    <option value="Avulsa">Avulsa</option>
                                    <option value="Fatura">Fatura</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="label-form">Data para Pagamento</span>
                                <input type="date" id="data-pag" name="data_conta" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="label-form">Valor</span>
                                <input type="text" name="valor" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-footer">
                            <input type="submit" value="Cadastrar" class="btn btn-success">
                            <a href="consultacontas.php"><input type="button" value="Consultar" class="btn btn-primary"></a>
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
