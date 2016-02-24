<?php

session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    
    if(isset($_POST['upload_image'])){
        
        if($_FILES["file"]["error"] > 0){
            $errori = "Error: " . $_FILES["file"]["error"] . "<br>";
            echo $errori;
            mail("mondial95@gmail.com","Tourismpo - Errori upload",$errori);
        } else {
            $dir = "../pub_data/pics/general/";
            if(is_dir($dir)){
                chdir($dir);
                foreach($_FILES['file'] as $f){
                    if(!file_exists($f["name"])){
                        move_uploaded_file($f["tmp_name"], $f["name"]);
                        echo "File ".$f["name"]." caricato correttamente.";
                        echo "<script>var file = '".$f["name"]."';var errors = null;parent.async_upload_callback(file,errors);</script>";
                    }else{
                        echo "Esiste un file ".$f["name"]." con lo stesso nome. Rinomina il file prima di caricarlo.";
                    }
                }
            }else{
                echo "Devi prima creare un album";
            }
        }
        
    } else {
        
        echo "Mond Dev -- Ciao :)";
        
    }
} else {
    echo "Accesso non eseguito. <a href='../../admin_panel/'>ACCEDI</a>";
}

?>