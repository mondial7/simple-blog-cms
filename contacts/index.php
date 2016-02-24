<?php
	// meta data
	$data = json_decode(file_get_contents("../pippo/website_set/general_data.json"),true);
    // language switch
    $server_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    // temp --> implement array check with all available languages
    if(isset($_GET['lang']) && ($_GET['lang'] == "en" || $_GET['lang'] == "it" || $_GET['lang'] == "de")){ $server_lang = $_GET['lang'];  $forcelang = $_GET['lang']; }
    $lang = json_decode(file_get_contents("../pippo/website_set/".$server_lang."/index.json"),true);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-with,initial-scale=1">
	<title> <?php echo $data['meta_title']; ?> </title>
	<meta name="description" content=" <?php echo $data['meta_description']; ?> " />
	<meta name="keywords" content=" <?php echo $data['meta_keywords']; ?> " />
	<link href="../lib/style/contact.css" rel="stylesheet" media="all" type="text/css">
	<link href="../lib/style/article.css" rel="stylesheet" media="all" type="text/css">
	<link href="../lib/style/general.css" rel="stylesheet" media="all" type="text/css">
    <script type="text/javascript" src="../lib/js/contact.js"></script>
    <script type="text/javascript" src="../lib/js/search_engine_contact.js"></script>
</head>
<body>

<?php
	
	// header & land
	?>

		<div id="loader_land">
			<div></div><div></div><div></div><div></div>
		</div>

		<header>
			<div class="center">
			    <h1 id="logo">
			        <a href="../<?php if($forcelang!=null) print $forcelang; ?>" title="Delta del Po"><span><?php echo $data['title']; ?></span></a>
			    </h1>
				<nav>
				    <div id="nav_icon"></div>
				    <ul>
				        <li><a href="#" onclick="enable_searching()" class="t3"><div id="search_icon"></div><?php echo $lang['search']; ?></a></li>
    					<li><a href="../about/<?php if($forcelang!=null) print $forcelang; ?>" class="t3"><?php echo $lang['about']; ?></a></li>
    				</ul>
                </nav>
			</div>
	    </header>

	<section id="small_land"></section>
    
    <main>
        
        <section id="alert">
            <p>
                <?php if(isset($_GET['sent'])){
                    if($_GET['sent'] == 1){
                        echo $lang['alert_message_ok'];
                    } else {
                        echo $lang['alert_message_error'];  
                    }
                }
                ?>
            </p>
        </section>

    	<section id="contact_form">
			
			<span><?php print $lang['message_form_label']; ?> <a href="mailto:<?php echo $data['mail_footer']; ?>"><?php echo $data['mail_footer']; ?></a></span>
			
			<form action="../lib/php/mail_sender.php" method="post">
				<input type="text" name="name" required="" placeholder="<?php print $lang['name']; ?>">
				<input type="mail" name="mail" required="" placeholder="Mail">
				<textarea name="content" placeholder="<?php print $lang['message_placeholder']; ?>"></textarea>
				<input type="submit" value="<?php print $lang['submit']; ?>" name="submit" />
			</form>

		</section>

    </main>
    
    <div id="search_container" class="hidden t3">
        <div id="close_search" onclick="close_search()"><svg viewbox="0 0 40 40"><path class="close-x" d="M 10,10 L 30,30 M 30,10 L 10,30" /></svg></div>
        <label><div id="search_icon_big"></div><?php echo $lang['search']; ?><div id="loader_search" class="hidden"></div></label>
        <input type="text" id="search_input" placeholder="<?php echo $lang['search']; ?> ..." onkeyup="commit_search(this)" autofocus />
        <div id="search_result" class="center"></div>
    </div>

    <?php if($data['footer_visibility']=="1"){ ?>

		<footer>

			<p class="center">Copyright 2016</p>
			<p class="center"><a href="mailto:<?php echo $data['mail_footer']; ?>"><?php echo $data['mail_footer']; ?></a></p>
			<!--<p class="center">Developed by <a href="http://mondspace.com" target="_blank">Mondspace</a></p>-->
            <p class="center"><a href="./en">EN</a> | <a href="./it">IT</a> | <a href="./de">DE</a></p>
            
		</footer>

	<?php } ?>

</body>
</html>