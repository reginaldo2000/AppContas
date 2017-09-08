<?php
//importa a conexao com o banco de dados

include('../database/Conexao.php');

//função para fazer login (parâmetro igual a 0)

if($_GET['action'] == 0) {
    $user = $_POST['user'];
    $senha = md5($_POST['password']);
    
    $st = $pdo->prepare("select * from md_users where nome = :a and senha = :b");
    $st->bindValue(":a", $user);
    $st->bindValue(":b", $senha);
    $st->execute();
    
    if($st->rowCount() > 0) {
        // starta a sessão
        session_start();
        $rs = $st->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userid'] = $rs['id'];
        header("location: ../home.php");
    } else {
        session_start();
        $_SESSION['error'] = true;
        header("location:../index.php");
    }
}

//cadastra o usuário
if($_GET['action'] == 1) {
    $st = $pdo->prepare('INSERT INTO md_users (nome, senha, dia_vencimento, dia_fechamento) VALUES(:a,:b,:c,:d)');
    $st->bindValue(':a', $_POST['usuario']);
    $st->bindValue(':b', md5($_POST['senha_user']));
    $st->bindValue(':c', $_POST['vencimento']);
    $st->bindValue(':d', $_POST['fechamento']);
    $st->execute();
    
    $st2 = $pdo->prepare('INSERT INTO md_users_mail (userid, email) VALUES((SELECT id FROM md_users ORDER BY id DESC LIMIT 1), :a)');
    $st2->bindValue(':a', $_POST['email']);
    $st2->execute();
    if($st && $st2) {
        header("location:../cadusuario.php?confirm=true");
    } else {
        header("location:../cadusuario.php?error=true");
    }
}

if($_GET['action'] == 2) {
    //fecha a sessão
    session_start();
    session_destroy();
    header("location: ../index.php");
}
