<?php
    setcookie("css", $_GET['choice'], time()+3600, '/');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    //header("Location: ../index.php");
?>