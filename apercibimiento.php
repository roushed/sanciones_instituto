<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/stylea.css">
    <?php
        
        //include "./seguridad.php";
        
        function contar(){

            $fichero=fopen('./ficheros/contador.txt','r+');
            $contador=intval(fgets($fichero));
            $contador++;
            rewind($fichero);
            fputs($fichero, strval($contador));
            fclose($fichero);

            return $contador;
        
        }
        
        if(isset($_POST['insertar'])){

            $escorrecto=true;
            if(empty($_POST['sancion'])){
                $escorrecto=false;
            }
            if(!isset($_POST['tfalta'])){
                $escorrecto=false;
            }
           
            
            if($escorrecto){

                //$sancion=$_POST['sancion'];
                $sancion=str_replace(" ","_", $_POST['sancion']);
                $alumnos=$_POST['alumnos'];
                $result=$_POST['tfalta'];
                $tipo_sancion=$_POST['tsancion'];
                $fecha=date("d/m/Y");
                $contador=contar();
                $fichero=fopen('./ficheros/AlumnoSancionados.txt','a+');

                if(!$fichero){
                    die ("No se encuentra el fichero");
                }

                fwrite($fichero, $contador.",".$alumnos.",".$fecha.",".$result.",".$sancion.",".$tipo_sancion."\n");

                fclose($fichero);

        }
    }

    ?>
    
</head>
<body>
<div class="container">

    <div class="cuadrito">
        <h2>Insertar Apercibimiento</h2>
        <form method="post" action="apercibimiento.php">
            <p>
                
            <label>Alumno apercibido:</label>
            <select name="alumnos">
                <?php
                
                    $fichero=fopen('./ficheros/Alumnos.txt','r');
                    while(!feof($fichero)){
                        $linea=fgets($fichero);
                        $linea_s=explode(",", $linea);
                        //$linea_s2=explode(" ",$linea_s[0]);
                        //$linea_r=array_reverse($linea_s2);
                        //$linea_i=implode(" ",$linea_r);
                        echo "<option value='".$linea_s[0]."'>$linea</option>";
                    }
                    fclose($fichero);

                ?>

            </select>
            </p>
            <p>
            <label>Tipo de falta:</label>
            <input type="radio" name="tfalta" value="L"><label>Leve</label>
            <input type="radio" name="tfalta" value="G"><label>Grave</label>
            <input type="radio" name="tfalta" value="MG"><label>Muy grave</label>
            </p>
            <p>
            <label>Sanción:</label>
            <input type="text" name="sancion" size="10">
            </p>
            <p>
            <label>Estado de sanción:</label>
            <select name="tsancion">
                <option value="P">Pendiente</option>
                <option value="EP">En proceso</option>
                <option value="C">Cumplido</option>

            </select>
            </p>
            <p>
                <input type="submit" value="Insertar" name="insertar">
            </p>
        </form>
        <div>
                <?php
                    if(isset($_POST['insertar'])){

                        if(!$escorrecto){

                            echo "<p><font color='red'>Debe de rellenar todos los campos</font></p>";
                        }else{

                            echo "<p><font color='green'>Se ha registrado correctamente</font></p>";
                        }

                    }
                ?>

        </div>
        <a href="./sanciona.php">Volver</a>
    </div>
    </div>
    
</body>
</html>