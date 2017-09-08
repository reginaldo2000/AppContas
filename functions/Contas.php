<?php

session_start();
include('../database/Conexao.php');

if ($_GET['action'] == 1) {
    $st = $pdo->prepare('insert into md_contas (userid, descricao, categoria, valor, data_conta) values(:user, :a,:b,:c,:d)');
    $st->bindValue(':user', $_SESSION['userid']);
    $st->bindValue(':a', strtoupper(utf8_decode($_POST['descricao'])));
    $st->bindValue(':b', $_POST['categoria']);
    $st->bindValue(':c', $_POST['valor']);
    $st->bindValue(':d', $_POST['data_conta']);
    $st->execute();
    if ($st) {
        $_SESSION['confirm'] = "Conta cadastrada com sucesso!";
        header("location:../cadcontas.php");
    }
}

if ($_GET['action'] == 2) {
    $st = $pdo->prepare('select * from md_contas where data_conta >= :a and categoria = :b and userid = :c');
    $st->bindValue(':a', $_POST['data']);
    $st->bindValue(':b', $_POST['cat']);
    $st->bindValue(':c', $_SESSION['userid']);
    $st->execute();
    $response = '';
    if ($st->rowCount() > 0) {
        $valor = 0.0;
        while ($linha = $st->fetch(PDO::FETCH_ASSOC)) {
            $valor += $linha['valor'];
            $response .= '<tr><td>' . utf8_encode($linha['descricao']) . '</td><td>' . date('d/m/Y', strtotime($linha['data_conta'])) . '</td><td>R$' . str_replace(".", ",", $linha['valor']) . '</td><td><a href=""><i class="fa fa-edit"></i></a></td></tr>';
            $_SESSION['valor_total'] = $valor;
        }
        echo $response;
    } else {
        echo '<tr><td colspan="4">Nenhuma conta encontrada!</td></tr>';
    }
}

if ($_GET['action'] == 3) {
    $st = $pdo->prepare('select * from md_contas where data_conta >= :a and categoria = :b and userid = :c');
    $st->bindValue(':a', $_POST['data']);
    $st->bindValue(':b', $_POST['cat']);
    $st->bindValue(':c', $_SESSION['userid']);
    $st->execute();

    $valor = 0.0;
    if ($st->rowCount() > 0) {
        while ($linha = $st->fetch(PDO::FETCH_ASSOC)) {
            $valor += $linha['valor'];
        }
    }
    echo $valor;
}

