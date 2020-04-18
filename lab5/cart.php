<?php
if (!empty($_GET)) {
    if (!empty($_GET['clear'])&&$_GET['clear']) {
        echo '<script>
        alert("Twój koszyk jest pusty");
        window.location.href="cart.php";
        </script>';
    }
    if(!empty($_GET['buy']) && $_GET['buy']){
        echo '<script>
        alert("Zakupiłeś przedmioty");
        window.location.href="cart.php";
        </script>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link href="style.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
</head>

<body>
    <header>
        <a href="index.php" id="logo">Sklepik</a>
        <nav>
            <a href="index.php">MENU</a>
            <a href="cart.php">KOSZYK</a>
        </nav>
    </header>
    <div class='menu'>
        <span>Twoja lista zakupów</span>
        <div class='list'>
            <div class='row'>
                <div class='column'>
                    <?php
                    include 'database.php';
                    $pdo = Database::connect();
                    session_start();
                    if (!empty($_SESSION['ID'])) {
                        foreach ($_SESSION['ID'] as &$value) {
                            $sql = 'SELECT * FROM PRODUKTY WHERE ID =?';
                            $q = $pdo->prepare($sql);
                            $q->execute(array($value));
                            $data = $q->fetch(PDO::FETCH_ASSOC);
                            echo '<div class="cart_element_name">' .
                                $data['NAZWA'] .
                                '</div>';
                        }
                        echo '</div> <div class="column">';
                        foreach ($_SESSION['ID'] as &$value) {
                            $sql = 'SELECT * FROM PRODUKTY WHERE ID =?';
                            $q = $pdo->prepare($sql);
                            $q->execute(array($value));
                            $data = $q->fetch(PDO::FETCH_ASSOC);
                            echo '<div class="cart_element_price">' .
                                $data['CENA'] .
                                'zł </div>';
                        }
                    }
                    echo '</div>';

                    ?>
                </div>
            </div>
            <div class='cart-buttons'>
                <a href='buy.php'>Kup</a>
                <a href='clear.php'>Opróżnij</a>
            </div>
        </div>
</body>

</html>