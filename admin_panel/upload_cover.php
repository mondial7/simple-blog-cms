<?php

session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    
    if(isset($_FILES['cover_picture'])){
        
        if($_FILES["cover_picture"]["error"] > 0){
            $errori = "Error: " . $_FILES["cover_picture"]["error"] . "<br>";
            echo $errori;
            mail("mondial95@gmail.com","Tourismpo - Errore upload cover_picture",$errori);
        } else {
            $dir = "../../pub_data/pics/general/";
            if(is_dir($dir)){
                //chdir($dir);
 		            $f = $_FILES['cover_picture'];
                    if(!file_exists($dir.$f["name"])){
                        if(move_uploaded_file($f["tmp_name"], $dir.$f["name"])){
	                        $message = "File ".$f["name"]." caricato correttamente.";
	                        echo "<script>parent.async_upload_callback('".$message."','".$f['name']."',null);</script>";                      	
                        } else {
	                        $errors = "Errore nel caricamento del file.";
	                        echo "<script>parent.async_upload_callback(null,'".$f['name']."','".$errors."');</script>";                      	
    					}
                    }else{
	                    $errors = "Esiste un file ".$f["name"]." con lo stesso nome. Rinomina il file prima di caricarlo.";
	                    echo "<script>parent.async_upload_callback(null,'".$f['name']."','".$errors."');</script>";                        	
                    }
            }else{
	            $errors = "L'album selezionano non esiste.";
                echo "<script>parent.async_upload_callback(null,'".$f['name']."','".$errors."');</script>"; 
            }

        }
        
    } else {
        
        $errors = "Nessun file selezionato.";
        echo "<script>parent.async_upload_callback(null,'".$f['name']."','".$errors."');</script>"; 
  	
    }
} else {
    echo "Accesso non eseguito. <a href='../../admin_panel/'>ACCEDI</a>";
}

?>