<?php

    $file = "../pippo/website_set/general_data.json";
    $json = json_decode(file_get_contents($file),true);
    
    $action = false;
    
    
    if(isset($_POST['title'])){
        $json['title'] = $_POST['title'];
        $action = true;
    }
    
    if(isset($_POST['subtitle'])){
        $json['subtitle'] = $_POST['subtitle'];
        $action = true;
    }
    
    if(isset($_POST['meta_title'])){
        $json['meta_title'] = $_POST['meta_title'];
        $action = true;
    }
    
    if(isset($_POST['meta_description'])){
        $json['meta_description'] = $_POST['meta_description'];
        $action = true;
    }
    
    if(isset($_POST['meta_keywords'])){
        $json['meta_keywords'] = $_POST['meta_keywords'];
        $action = true;
    }
    
    if(isset($_POST['narticle_per_view'])){
        $json['article_manager']['gap_articles_view'] = $_POST['narticle_per_view'];
        $action = true;
    }
    
    if(isset($_POST['footer_visibility'])){
        $json['footer_visibility'] = $_POST['footer_visibility'];
        $action = true;
    } 
    

    if($action){
        
        file_put_contents($file,json_encode($json));
        echo "OK";
        
    }

?>