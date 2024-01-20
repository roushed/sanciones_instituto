<?php


$falumno=fopen('./alumnos/'.$nombre_fichero, "r");
$datos="<table border='1'>";
$datos.="<tr><th colspan='7'>Sanciones unipersonales</th></tr>";

    while(!feof($falumno)){
                    
        $linea=fgets($falumno);
        $linea_s=explode(',', $linea);
                    
                    
        if(count($linea_s) > 1){
            $datos.="<tr>";
            $datos.="<form method='post' action='listasanciones.php'>";
            $datos.="<input type='hidden' value='$nombre_fichero' name='n_fichero'>";
            $datos.="<input type='hidden' value='".$linea_s[0]."' name='id_alumno'>";
            $datos.="<input type='hidden' value='".$_POST['alumnos']."' name='alumnos'>";

            
            for($i=0; $i<count($linea_s); $i++){
                if($i < 5){
                                
                    if ($i == 1){
                        $linea_s2=explode(" ",$linea_s[1]);
                        $linea_i=strtolower(implode(" ",$linea_s2));
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
                    
            switch (trim($linea_s[5])) {
                case "P":
                    $datos.="<td><input type='submit' value='Iniciar' name='iniciar'></td>";
                    break;
                case "EP":
                    $datos.="<td><input type='submit' value='Finalizar' name='finalizar'></td>";
                    break;
                default:
                    $datos.="<td></td>";
                                
            }
                        //$datos.="<td><input type='submit' value='Botoncito'></td>";
            $datos.="</form>";
            $datos.="</tr>";
        }
                    
    }
                
    $datos.="</table>";
    
    fclose($falumno);
                
    echo $datos;

?>