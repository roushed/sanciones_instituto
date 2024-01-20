<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <div class="container">

        <div class="cuadrito">
            <h2>Lista de sanciones por alumno</h2>
            
            <form method="post" action="listasanciones.php">
                <p>
                <label>Alumno:</label><select name="alumnos">

                        <?php
                        
                            include "./seguridad.php";

                            $fichero=fopen('./ficheros/Alumnos.txt','r');
                            while(!feof($fichero)){
                                $linea=fgets($fichero);
                                $linea_s=explode(",", $linea);
                                $linea_s2=explode(" ",$linea_s[0]);
                                $linea_r=array_reverse($linea_s2);
                            
                                $linea_i=implode(" ",$linea_r);
                                
                                echo "<option value='".$linea_s[0]."'>$linea_i</option>";
                            }
                            fclose($fichero);

                            ?>
                    
                    </select>

                </p>

                    <p><input type="submit" name="listar" value="Listar sanciones"></p>
        
            </form>
            <a href="./sanciona.php">Volver</a>
        </div>
    </div>
</body>
</html>