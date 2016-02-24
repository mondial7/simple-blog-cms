<?php

session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['password'])){
	
		echo "<div class='alert_no_logged'>Oopsss... non hai eseguito l'accesso. <a href='index.php'>Accedi ora.</a></div>";
	
} else {

    if(isset($_POST['save_new_article']) || isset($_POST['publish_new_article'])){
        
        // TODO: CHANGE WHEN JUST UPDATING AN ARTICLE --> hidden input existing=true
        
        // set all the values
        if (isset($_POST['publish_new_article'])) $a_published = "true";
        else $a_published = "false";
        $a_title = $_POST['title'];
        $a_subtitle = $_POST['subtitle'];
        $a_category = $_POST['category'];
        $a_tags = $_POST['tags'];
        $a_thumb = $_POST['thumb'];
        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];
        $meta_keywords = $_POST['meta_keywords'];
        
        $a_text_contents = $_POST['text_content'];
        $a_image_contents = $_POST['image_content'];
        $a_video_contents = $_POST['video_content'];

        // NEW CONTENTS ORDERING
        
        $a_contents = $_POST['content'];
        
        date_default_timezone_set('Europe/Rome');
        $current_date = date('Y-m-d\TH:i:s');
        
        if (isset($_POST['dir'])){
            $a_dir = str_replace(array('\\','\'','"',' ','/','?','!','-','=',')','(','£','$','%','&','°','*','§','^'),'_',$_POST['dir']);
        } else {
            $a_dir = str_replace(array('\\','\'','"',' ','/','?','!','-','=',')','(','£','$','%','&','°','*','§','^'),'_',$a_title);
        }
        if($a_dir == "") $a_dir = $a_title; // TODO: TO FIX
        $final_dir = "../article/".$a_dir;
        
        if (!file_exists($final_dir)){
            // create new directory if it does not exists
            mkdir($final_dir);
            // Create index.php with link to template
            $new_article_index = fopen($final_dir."/index.php", "w");
            $link_to_template = "<?php include '../../admin_panel/article_template/index.php'; ?>";
            fwrite($new_article_index, $link_to_template);
            fclose($new_article_index);
            
            // add article to file list
            $articles_list = json_decode(file_get_contents("../pippo/data/articles.json"),true);
            $articles_list[] = array("published"=>$a_published,"src"=>$a_dir,"title"=>$a_title,"thumb"=>$a_thumb);
            file_put_contents("../pippo/data/articles.json",json_encode($articles_list));
            // add counter
            $website_data = json_decode(file_get_contents("../pippo/website_set/general_data.json"),true);
            $website_data['article_manager']['total_number'] += 1;
            file_put_contents("../pippo/website_set/general_data.json",json_encode($website_data));
        }
        
        // TODO: NOW IT ALWAYS OVERRIDE OLD DATA
        
        // define new data_array to save in contents.json
        $data_array = array("title"=>$a_title,"src"=>$a_dir,"thumb"=>$a_thumb,"subtitle"=>$a_subtitle,"meta_title"=>$meta_title,"meta_description"=>$meta_description,"meta_keywords"=>$meta_keywords,"category"=>$a_category,"tag"=>$a_tags,"contents"=>array(),"birthday"=>$current_date,"date_edit"=>$current_date);
        
        // push contents inside data_array
        if ($a_video_contents != null){
            foreach($a_video_contents as $content){
                $data_array['contents'][] = array("type"=>"video","src"=>$content);
            }
        }
        if ($a_image_contents != null){
            foreach($a_image_contents as $content){
                $data_array['contents'][] = array("type"=>"image","src"=>$content,"alt"=>$content);
            }
        }
        if ($a_text_contents != null){
            foreach($a_text_contents as $content){
                $data_array['contents'][] = array("type"=>"text","src"=>$content);
            }
        }
        
        // NEW CONTENTS ORDERING
        if($a_contents != null){
            foreach($a_contents as $content){
                switch(key($content)){
                    case 'video':
                        $data_array['contents'][] = array("type"=>"video","src"=>$content[key($content)]);
                        break;
                    case 'image':
                        $data_array['contents'][] = array("type"=>"image","src"=>$content[key($content)],"alt"=>$content[key($content)]);
                        break;
                    case 'text':
                        $data_array['contents'][] = array("type"=>"text","src"=>$content[key($content)]);
                        break;
                }
            }
        }
        
        // save new data to contents.json
        file_put_contents($final_dir."/contents.json",json_encode($data_array));
        
        echo "Saved <a href='manage_articles.php'>Torna all'editor</a>";
        echo "<script>document.location = 'manage_articles.php';</script>";
    } else {
        echo "Submit not set";
    }
    
}

?>