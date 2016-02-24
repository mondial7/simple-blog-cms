<?php
    
    if(isset($_GET['q'])){
        
        $q = $_GET['q'];
        $result = "";
        
        if($_GET['art'] == "1") $extra_art = "../";
        if($_GET['contact'] == "1") $extra_art = "../article/";
        
        if($q != ""){
        
            $json = json_decode(file_get_contents("../../pippo/data/articles.json"), true);
            
            foreach($json as $article){
                
                if(stristr($article['src'],$q) || stristr($article['title'],$q)){
                    $result = $result."<a href='".$extra_art.$article['src']."' target='_blank'>".$article['title']."</a><br>";
                }
                
            }
            
            if($result == ""){
                $result = "Nessun risultato...";
            }
            
        }
        
        echo $result;
        
    } else {
        
        echo "No values";
        
    }

?>