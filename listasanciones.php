<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/stylels.css">

</head>
<body>
    <div class="container">

    <div class="cuadrito">
        <?php

            include "./seguridad.php";
            
            function eliminaContenido($nombref){

                $ficheroborrar =fopen('./alumnos/'.$nombref, "w+");
                fwrite($ficheroborrar, "");
                fclose($ficheroborrar);

            }

            function vuelcaContenido($estado){

                $nombre_fichero=$_POST['n_fichero'];
                $array_volcar=array();
                $fmodificar=fopen('./ficheros/AlumnoSancionados.txt','r');
                while(!feof($fmodificar)){
                    
                    $linea=fgets($fmodificar);
                    $linea_s=explode(",", $linea);

                    if(!in_array($_POST['id_alumno'], $linea_s)){
                        
                    array_push($array_volcar, $linea);

                    }else{

                        array_push($array_volcar, $linea_s[0].",".$linea_s[1].",".$linea_s[2].",".$linea_s[3].",".$linea_s[4].",$estado"."\n");

                    }

                }

                $fvolcar=fopen('./ficheros/AlumnoSancionados.txt','w');
                    for($i=0; $i<count($array_volcar); $i++){
                        fwrite($fvolcar, $array_volcar[$i]);

                    }

                fclose($fvolcar);

                $fichero=fopen('./ficheros/AlumnoSancionados.txt','r');
                eliminaContenido($nombre_fichero);
                while(!feof($fichero)){

                    $linea=fgets($fichero);
                    $linea_s=explode(",", $linea);
                    
                    
                    if(in_array($_POST['alumnos'], $linea_s)){

                        $linea_s2=explode(" ",$linea_s[1]);
                        $linea_r=array_reverse($linea_s2);
                        $linea_i=implode(" ",$linea_r);

                        $fsancion=fopen('./alumnos/'.$nombre_fichero,'a+');
                        if(!$fsancion){
                            die ("No se encuentra el fichero");
                        }
                    
                        fwrite($fsancion, $linea_s[0].",".$linea_i.",".$linea_s[2].",".$linea_s[3].",".$linea_s[4].",".$linea_s[5]);
                        fclose($fsancion);

                    }


                }

                fclose($fichero);

            }

            if(isset($_POST['iniciar'])){

                //echo "Ha iniciado";
                $nombre_fichero=$_POST['n_fichero'];
                echo "<p>";
                echo "El id del alumno seleccionado es ".$_POST['id_alumno'];
                vuelcaContenido("EP");

                include "genera_listasanciones.php";
            
            }

            if(isset($_POST['finalizar'])){

                //echo "Ha finalizado";
                $nombre_fichero=$_POST['n_fichero'];
                echo "<p>";
                echo "El id del alumno seleccionado es ".$_POST['id_alumno'];
                vuelcaContenido("C");
                
                include "genera_listasanciones.php"; 

            }


            if(isset($_POST['listar'])){
            
                $fichero=fopen('./ficheros/AlumnoSancionados.txt','r');
                $elimina=true;
                $encontrado=false;
                while(!feof($fichero)){

                    $linea=fgets($fichero);
                    $linea_s=explode(",", $linea);
                    
                    if(in_array($_POST['alumnos'], $linea_s)){
                        
                        $linea_s2=explode(" ",$linea_s[1]);
                        $linea_r=array_reverse($linea_s2);
                        $linea_i=implode(" ",$linea_r);

                        $nombre_fichero=strtolower($linea_s2[2]."_".$linea_s2[1].".txt");
                        if($elimina){
                            eliminaContenido($nombre_fichero);
                            $elimina=false;
                        }
                        
                        $fsancion=fopen('./alumnos/'.$nombre_fichero,'a+');
                        if(!$fsancion){
                            die ("No se encuentra el fichero");
                        }
                    
                        fwrite($fsancion, $linea_s[0].",".$linea_i.",".$linea_s[2].",".$linea_s[3].",".$linea_s[4].",".$linea_s[5]);

                        fclose($fsancion);
                        $encontrado=true;

                    }

                }

                fclose($fichero);

                if(!$encontrado){

                    header('Location: ./errorbd.php');
                    exit();
                }else{
                    echo "<h3>Listado de sanciones unipersonales</h3>";

                    include "genera_listasanciones.php";
                }

            }
    
        ?>
        <p><a href="./sanciones.php">Volver</a></p>
    </div>
    </div>
</body>
</html>