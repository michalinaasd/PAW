<?php
session_start();
if (empty($_SESSION['ID'])) {
    $_SESSION['ID'] = array();
}
if (!empty($_GET)) {
    if(!empty($_GET['id'])){
    array_push($_SESSION['ID'], strval($_GET['id']));
    header('Location: index.php');
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
        <a href='index.php' id="logo">Sklepik</a>
        <nav>
            <a href="index.php">MENU</a>
            <a href="cart.php">KOSZYK
            <?php 
                if(!empty($_SESSION['ID'])){
                    echo '['. sizeof($_SESSION['ID']) . ']';
                }
            ?>
            </a>
            
        </nav>
    </header>
    <div class="product-list">
        <?php
        include 'database.php';
        $pdo = Database::connect();
        $sql = 'SELECT * FROM PRODUKTY';
        foreach ($pdo->query($sql) as $row) {
            echo '<div id=' . $row['ID'] . ' class="product"> ';
            echo '
                               <span>';
            echo '<img src="https://diversesystem.com/imagecache/product-list/16982/29336/crop_arris-eco-navy-1-blackhart-eco-navy-price-eco-t-01-white-jdC1.jpg" class="product-photo-1">
                    <img src="https://diversesystem.com/imagecache/product-list/16982/29336/crop_arris-eco-navy-2-XXff.jpg " class="product-photo-2">';
            echo '</span>
                               ';
            echo '<span class="product-name">' . $row['NAZWA'] . ' </span>
                               ';
            echo '<span class="product-price">' . $row['CENA'] . 'zł</span>
                            ';
            echo '<div>';
            echo '<a href="index.php?id=' . $row['ID'] . '" class="add-product"></a>
                               ';

            echo '</div>';
            echo '</div>';
        }
        Database::disconnect();
        ?>
    </div>
</body>

</html>