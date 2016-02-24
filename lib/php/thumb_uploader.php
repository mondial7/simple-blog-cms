<?php

session_start();

include "resize_picture.php";

if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    
    if(isset($_FILES['thumb'])){
        
        if($_FILES["thumb"]["error"] > 0){
            $errori = "Error: " . $_FILES["thumb"]["error"] . "<br>";
            echo $errori;
            mail("mondial95@gmail.com","Tourismpo - Errore upload thumb",$errori);
        } else {
            $dir = "../../pub_data/pics/thumb/";
            if(is_dir($dir)){
                    
                    //chdir($dir);
 		            $f = $_FILES['thumb'];
                    if(!file_exists($dir.$f["name"])){
                        if(move_uploaded_file($f["tmp_name"], $dir.$f["name"])){
          
                            // resize jpg image
                            $resized_picture_temp = resize_image($dir.$f["name"], 200, 200);
                            imagejpeg($resized_picture_temp,$dir."RESIZED.jpg");
                            
	                        $message = "File ".$f["name"]." caricato correttamente.";
	                        echo "<script>parent.async_upload_thub_callback('".$message."','".$f['name']."',null);</script>";                      	
                        } else {
	                        $errors = "Errore nel caricamento del file.";
	                        echo "<script>parent.async_upload_thub_callback(null,'".$f['name']."','".$errors."');</script>";                      	
    					}
                    }else{
	                    $errors = "Esiste un file ".$f["name"]." con lo stesso nome. Rinomina il file prima di caricarlo.";
	                    echo "<script>parent.async_upload_thub_callback(null,'".$f['name']."','".$errors."');</script>";                        	
                    }
            }else{
	            $errors = "L'album selezionano non esiste.";
                echo "<script>parent.async_upload_thub_callback(null,'".$f['name']."','".$errors."');</script>"; 
            }

        }
        
    } else {
        
        $errors = "Nessun file selezionato.";
        echo "<script>parent.async_upload_thub_callback(null,'".$f['name']."','".$errors."');</script>"; 
  	
    }
} else {
    echo "Accesso non eseguito. <a href='../../admin_panel/'>ACCEDI</a>";
}

?>