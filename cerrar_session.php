<?php

session_start();

unset($_SESSION['name']);
unset($_SESSION['userId']);


session_destroy();
session_unset();


echo "Espere, por favor ...";
sleep(1);
header("Location:login.php");
exit;

?>

