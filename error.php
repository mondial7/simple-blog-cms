<?php
    // language switch
    $server_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if(isset($_GET['lang']) && ($_GET['lang'] == "en" || $_GET['lang'] == "it" || $_GET['lang'] == "de")){ $server_lang = $_GET['lang']; $forcelang = $_GET['lang']; }
    $lang = json_decode(file_get_contents("pippo/website_set/".$server_lang."/index.json"),true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>OPS :/</title>
	<style>
	    @import url(https://fonts.googleapis.com/css?family=Raleway:400);
	    html{height:100%;}
	    body{width:100%;height:100%;background-color:#22220b;padding:0;margin:0;font-family:'Raleway',Arial,sans-serif;font-weight:400;}
	    a{display:block;height:100%;width:100%;color:#ffff00;text-decoration:none;line-height:150px;}
	    h1{padding:50px;margin:0;font-size:100px;}
	</style>
</head>
<body>

    <a href="http://example.com/<?php if($forcelang!=null) print '?lang='.$forcelang; ?>">
        
            <div id="box">
                
                <h1><?php print $lang['404error']; ?></h1>    
                
            </div>
        
    </a>
    
</body>
</html>