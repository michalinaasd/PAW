<?php
session_start();
$_SESSION=array();
header('Location: cart.php?clear=true');
?>