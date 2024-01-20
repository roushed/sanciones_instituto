<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php

        //include "./seguridad.php";

        if (isset($_GET['cerrar'])){
  
            $_COOKIE=array();
            setcookie(session_name(), time()-3600);
            session_destroy();
            header('Location:./sanciona.php');
        }

    ?>
</head>
<body>
    <div class="container">

        <div class="cuadrito">
            <?php
                session_start();
                if(isset($_SESSION['autentificar'])){
                   
                    echo "<div class='is'>Bienvenido ".ucfirst($_SESSION['nombre'])."</div>";
                }else{
                    echo "<div class='is'>Guest</div>";
                }

            ?>
            <p><a href="./apercibimiento.php">Insertar Apercibimiento</a></p>
            <p><a href="./sanciones.php">Ejecuta sanción</a></p>
            <p><a href="./listar.php">Listado de sanciones</a></p>
            <?php
                 
                 if(isset($_SESSION['autentificar'])){
                    echo "<p><a href='./sanciona.php?cerrar'>Cerrar Sesion</a></p>";
                     //header('Location: ./sanciona.php');
                     //exit();
         
                 }
            ?>
            


        </div>


    </div>
</body>
</html>