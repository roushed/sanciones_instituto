<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/stylel.css">
</head>
<body>
    <div class="container">

    <div class="cuadrito">
        <h2>Lista de todas la sanciones</h2>
        <?php

            //include "./seguridad.php";
            
            $fichero=fopen('./ficheros/AlumnoSancionados.txt', 'r');
            $datos="<table border='1'>";
            $datos.="<tr><th colspan='7'>Sanciones</th></tr>";
            while(!feof($fichero)){

                $linea=fgets($fichero);
                $linea_s=explode(",", $linea);
            
                if(count($linea_s)>1){

                    $datos.="<tr>";
                    for($i=0;$i<count($linea_s); $i++){

                        if($i < 5){
                                    
                            if ($i == 1){
                                $linea_s2=explode(" ",$linea_s[1]);
                                $linea_r=array_reverse($linea_s2);
                                $linea_i=strtolower(implode(" ",$linea_r));
                                $datos.="<td>".ucwords($linea_i)."</td>";
        
                            }else if($i == 3){

                                switch ($linea_s[$i]) {
                                    case "L":
                                        $datos.="<td>Leve</td>";
                                        break;
                                    case "G":
                                        $datos.="<td>Grave</td>";
                                        break;
                                    default:
                                        $datos.="<td>Muy Grave</td>";
                                                    
                                }

                            }else{

                                $datos.="<td>".$linea_s[$i]."</td>";

                            }
                                    
                        }else{
        
                            switch (trim($linea_s[$i])) {
                                case "P":
                                    $datos.="<td><b>Pendiente</b></td>";
                                    break;
                                case "EP":
                                    $datos.="<td><b>En Proceso</b></td>";
                                    break;
                                default:
                                    $datos.="<td><b>Completo</b></td>";
                                                
                            }
                                        
                        }

                    }
                    $datos.="</tr>";
                }

            }
            $datos.="</table>";
            fclose($fichero);
            echo $datos;
        

        ?>
        <p><a href="./sanciona.php">Volver</a></p>
    </div>
    
    </div>
</body>
</html>