<?php

    $to = "info@tourismpo.com";
    $object = "TOURISMPO BACKUP - ".date("jn_Gis");

    $dir_target = "../history/virtualbp_".date("jn_Gis")."/";
    mkdir($dir_target);
    foreach(scandir("../article/") as $article){
        if($article != "." && $article != ".."){
            copy("../article/".$article."/contents.json",$dir_target.$article.".json");
            $message = file_get_contents("../article/".$article."/contents.json");
            mail($to,$object,$message);
        }
    }
    echo "Done";
    

?>