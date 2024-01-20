<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/stylei.css">
    <?php
        session_start();
        if(isset($_SESSION['autentificar'])){
            header('Location: ./sanciona.php');
            exit();

        }

    ?>

    <?php
        if(isset($_POST['login'])){
            
            session_start();

            if(!isset($_SESSION['autentificar'])){
                if(!empty($_POST['usuario']) && !empty($_POST['contrasena'])){
                    
                    if($_POST['usuario'] == "prueba" && $_POST['contrasena'] == "1234"){
                        $_SESSION['autentificar']=true;
                        $_SESSION['nombre']=$_POST['usuario'];
                        header('Location:./sanciones.php');


                    }else{

                        header('Location:./inicia_sesion.php?error=1');


                    }


                }else{
                    header('Location:./inicia_sesion.php?error=2');


                }


            }else{

                header('Location:./sanciona.php');

            }


        }



    ?>
</head>
<body>
    <div class="container">

        <div class="cuadrito">
            <form method="POST" action="inicia_sesion.php">
                <p><label>Login: </label></p>
                <p><input type="text" name="usuario"></p>
                <p><label>Password: </label></p>
                <p><input type="password" name="contrasena"></p>
                <p><input type="submit" value="Entrar" name="login" class="boton"></p>

                <div class="msg_error">

                    <?php

                        if(isset($_GET['error'])){
                            if($_GET['error'] == 1){


                                echo "<p>Nombre de usuario y contraseña incorrectos</p>";
                            }

                            if($_GET['error'] == 2){


                                echo "<p>Campos vacios</p>";
                            }



                        }

                    ?>

                </div>

                <a href="./sanciona.php">Volver</a>
            </form>
           
        </div>

    </div>
</body>
</html>