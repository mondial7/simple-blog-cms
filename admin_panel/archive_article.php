<?php

session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['password'])){
	
	echo "<div class='alert_no_logged'>Oopsss... non hai eseguito l'accesso. <a href='index.php'>Accedi ora.</a></div>";
	
} else {

    if(isset($_GET['a'])){
        
        // move article to /history/articledeleted/
        $article_directory = '../article/'.$_GET['a']."/";
        $public_article = $article_directory."contents.json";
        $target_article = "../history/articledeleted/".$_GET['a'].date("jn_Gis").".json";
        
        if(is_dir($article_directory)){
            rename($public_article,$target_article);
            
            // remove public folder - article
            unlink("../article/".$_GET['a']."/index.php");
            rmdir("../article/".$_GET['a']);
        
            // remove the article link from the main list
            // prevent article from listing
            $published = false;
            $articles_list = json_decode(file_get_contents("../pippo/data/articles.json"),true);
            for($i=0;$i<count($articles_list);$i++){
                if ($articles_list[$i]['src'] == $_GET['a']){
                    // unset the article
                    unset($articles_list[$i]);
                    // check if article was published to change after the counter
                    if($articles_list[$i]['published'] == "1") $published = true;
                }
            }
            file_put_contents("../pippo/data/articles.json",json_encode($articles_list));
            
            // less counter
            $website_data = json_decode(file_get_contents("../pippo/website_set/general_data.json"),true);
            $website_data['article_manager']['total_number'] -= 1;
            if($published) $website_data['article_manager']['total_published'] -= 1;
            file_put_contents("../pippo/website_set/general_data.json",json_encode($website_data));

            echo "Archiviato correttamente.";
            echo "<script>document.location = 'manage_articles.php';</script>";
        } else {
            echo "Directory non trovata. <a href='manage_articles.php'>Torna all'editor</a>";
        }
            
    }
    
}


?>