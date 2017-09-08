<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<html>
    <?php
    include_once('./imports/import_head.php');
    ?>
    <body onresize="tableResponsiva();">
        <?php
        include('./themes/header.php');
        include('./themes/menu.php');
        ?>
        <div class="container">
            <div class="main-content">
                <div class="form-title">Consultar Contas</div>
                <form method="post" name="consulta" class="form-inline">
                    <div class="panel">
                        <div class="panel-footer">
                            <div class="form-group">
                                <label class="text-capitalize">Data Inicial: </label>
                                <input type="date" name="data_inicial" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="label-form">Categoria: </label>
                                <select name="categoria" class="form-control">
                                    <option value="">Selecione uma...</option>
                                    <option value="Avulsa">Avulsa</option>
                                    <option value="Fatura">Fatura</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="button" value="Buscar" class="btn btn-success" onclick="buscarContas();">
                            </div>
                        </div>
                    </div>
                </form>
                <br>

                <div class="table-responsive">
                    <table id="tabela-consulta" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Descrição</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Valor</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="dados-table">

                        </tbody>
                    </table>
                </div>

                <div class="valor-total ocultar"></div>

            </div>
        </div>
        <?php
        include_once('./imports/import_footer.php');
        ?>
    </body>
</html>
