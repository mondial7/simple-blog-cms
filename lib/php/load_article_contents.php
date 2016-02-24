<?php

// temp --> implement array check with all available languages
if(isset($_GET['lang']) && ($_GET['lang'] == "it" || $_GET['lang'] == "de") && file_exists("contents-".$_GET['lang'].".json")){ 
    // get data from contents.json
    $data_array = json_decode(file_get_contents("contents-".$_GET['lang'].".json"),true);    
} else {
    // get data from contents.json
    $data_array = json_decode(file_get_contents("contents.json"),true);
}

// get general webiste data
$website_data = json_decode(file_get_contents("../../pippo/website_set/general_data.json"),true);

?>