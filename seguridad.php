<?php
    session_start();
    if($_SESSION['autentificar'] != true){

        header('Location: ./inicia_sesion.php');
        exit();
    }


?>