<?php

if (isset($_GET['a']) && isset($_GET['published'])){

    // add article to file list
    $articles_list = json_decode(file_get_contents("../pippo/data/articles.json"),true);
    
    for($i=0;$i<count($articles_list);$i++){
        if ($articles_list[$i]['src'] == $_GET['a']){
            $articles_list[$i]['published'] = $_GET['published'];
        }
    }
    
    file_put_contents("../pippo/data/articles.json",json_encode($articles_list));
    
    // change counter
    $website_data = json_decode(file_get_contents("../pippo/website_set/general_data.json"),true);
    if ($_GET['published'] == "true"){
        $website_data['article_manager']['total_published'] += 1;
    } else {
        $website_data['article_manager']['total_published'] -= 1;
    }
    file_put_contents("../pippo/website_set/general_data.json",json_encode($website_data));

    echo "Done.";

} else {
    echo "Submit not set";
}

    echo "<script>window.close();</script>";

?>