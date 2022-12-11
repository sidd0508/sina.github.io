<?php
session_start();
session_destroy();
unset($_SESSION['staff']);
header("location: optionspage.php");
?>