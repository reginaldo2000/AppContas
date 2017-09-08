<?php

class ContasClass {
    
    public function __construct() {
        ;
    }
    
    public function getDiaVencimento() {
        include('./database/Conexao.php');
        $st = $pdo->prepare('SELECT dia_vencimento FROM md_users WHERE id = :u');
        $st->bindValue(':u', $_SESSION['userid']);
        $st->execute();
        $rs = $st->fetch(PDO::FETCH_ASSOC);
        return $rs['dia_vencimento'];
    }
    
    public function getDiaFechamento() {
        include('./database/Conexao.php');
        $st2 = $pdo->prepare('SELECT dia_fechamento FROM md_users WHERE id = :u');
        $st2->bindValue(':u', $_SESSION['userid']);
        $st2->execute();
        $rs2 = $st2->fetch(PDO::FETCH_ASSOC);
        return $rs2['dia_fechamento'];
    }
}

