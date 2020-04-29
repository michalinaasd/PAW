<?php
include 'database.php';
$pdo = Database::connect();
session_start();
if (!empty($_SESSION['ID'])) {
    $alert = false;
    foreach ($_SESSION['ID'] as &$value) {
       
        $sql = 'SELECT * FROM PRODUKTY WHERE ID =? ';
        $q = $pdo->prepare($sql);
        $q->execute(array($value));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if(empty($data)){
            $_SESSION['ID']=array();
            header('Location: cart.php?buy=false');
            $alert = true;
        }
        $sql = 'DELETE FROM PRODUKTY WHERE ID =? ';
        $q = $pdo->prepare($sql);
        $q->execute(array($value));

    }

    $_SESSION['ID'] = array();
    if($alert==false){header('Location: cart.php?buy=true'); $pdo->commit();}
    else{$pdo->rollBack();}
    }
else{
    header('Location: cart.php');
}
?>