<?php
	// meta data
	$data = json_decode(file_get_contents("pippo/website_set/general_data.json"),true);
    // language switch
    $server_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if(isset($_GET['lang']) && ($_GET['lang'] == "en" || $_GET['lang'] == "it" || $_GET['lang'] == "de")){ $server_lang = $_GET['lang']; $forcelang = $_GET['lang']; }
    $lang = json_decode(file_get_contents("pippo/website_set/".$server_lang."/index.json"),true);

    // define random background from pictures in "bg" directory
    $bg_files=glob("pub_data/pics/bg/*.*");
    $bg_count=count($bg_files);
    if ($bg_count>0){ $background=$bg_files[rand(0,$bg_count-1)]; }
    else { $background="pub_data/pics/temp.jpeg"; }

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?php echo $data['meta_title']; ?> </title>
	<meta name="description" content=" <?php echo $data['meta_description']; ?> " />
	<meta name="keywords" content=" <?php echo $data['meta_keywords']; ?> " />
	
	<meta property="og:title" content="<?php echo $data['meta_title']; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="" />
    <meta property="og:locale" content="it_IT" />
    <meta property="og:locale:alternate" content="en_GB" />
    <meta property="og:description" content="<?php echo $data['meta_description']; ?>" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="http://example.com/pub_data/pics/<?php echo $data['background_image']; ?>" />
	
	<link href="lib/style/home.css" rel="stylesheet" media="all and (min-width:525px)" type="text/css">
	<link href="lib/style/mobile_home.css" rel="stylesheet" media="all and (max-width:525px)" type="text/css">
	<link href="lib/style/general.css" rel="stylesheet" media="all" type="text/css">
	<link href="lib/style/home_video_fix.css" rel="stylesheet" media="all" type="text/css">
    <script type="text/javascript">
        var Article_manager = {
            "total_number": "<?php echo $data['article_manager']['total_number']; ?>",
            "gap_articles_view": "<?php echo $data['article_manager']['gap_articles_view']; ?>"
        };
    </script>
</head>
<body lang="<?php print $server_lang; ?>">

<?php
	
	// header & land
	?>

		<div id="loader_land">
			<div></div><div></div><div></div><div></div>
		</div>
		
		<div id="language_menu">
            <p class="center"><a href="./en">EN</a> | <a href="./it">IT</a> | <a href="./de">DE</a></p>
		</div>

		<header>
		    <div class="center">
				<nav>
				    <div id="nav_icon"></div>
				    <ul>
				        <li><a href="#" onclick="enable_searching()" class="t3"><div id="search_icon"></div><?php echo $lang['search']; ?></a></li>
    				    <li><a href="about/<?php if($forcelang!=null) print $forcelang; ?>" class="t3"><?php echo $lang['about']; ?></a></li>
                        <li><a href="contacts/<?php if($forcelang!=null) print $forcelang; ?>" class="t3"><?php echo $lang['contacts']; ?></a></li>
    				</ul>
                </nav>
			</div>
		</header>

    <main>

		<section id="land" style="background-image: url('<?php print $background; ?>');" >
	
			<!-- if you want to add a video background instead of pictures

		    <style>
		    	
		    	/* Temp fix for video layout */
		        .header__video {
		            display: block;
		            left: 0;
                    position: fixed;
                    top: 0px;
                    width: 100%;
                    z-index: -1;
		        }
		        
		    </style>
		    
		    <figure class="header__background">	
        		<video loop="" muted="" autoplay="autoplay" class="header__video">
        			<source type="video/mp4" src="pub_data/video/beach_dunes.mp4">
        			<source type="video/ogg" src="pub_data/video/theme.ogg">
        		</video>
	        	<div class="header__overlay"></div>
            </figure>

            -->
		    
			<div class="center">
    			<div id="title_wrapper">
    				<h1><?php echo $data['title']; ?></h1>
    				<h2><?php echo $data['subtitle']; ?></h2>
    			</div>
    			<div id="bottom_land">
    				<div id="bottom_arrow">
    			</div>
			</div>
		</section>

	<?php

	// print the first articles and loadmore button
	?>
            <section id="articles_section">
                <div id="articles_section_contents" class="center">
                
        			<?php 
        			    $article_loader_gap_x = "ok";
        			    $article_loader_gap = $data['article_manager']['gap_articles_view'];
        			    include 'lib/php/articles_preview.php';
        			?>

                </div>    
    		</section>
    
        <?php if ($data['article_manager']['total_published'] > $data['article_manager']['gap_articles_view']){ ?>
        <!--
    		<section id="more_articles_wrapper">
    			<div id="load_more" class="t3" onclick="load_more_articles();">
    			    <span>Load More</span>
    			</div>
    		</section>
        -->
        <?php } ?>
    
    
        </main>
    
	
	<?php if($data['footer_visibility']=="1"){ ?>

		<footer>

			<p class="center">&copy; <?php echo date("Y") ?></p>
			<p class="center"><a href="mailto:<?php echo $data['mail_footer']; ?>"><?php echo $data['mail_footer']; ?></a></p>

		</footer>

	<?php } ?>

    <div id="search_container" class="hidden t3">
        <div id="close_search" onclick="close_search()"><svg viewbox="0 0 40 40"><path class="close-x" d="M 10,10 L 30,30 M 30,10 L 10,30" /></svg></div>
        <label><div id="search_icon_big"></div>Search<div id="loader_search" class="hidden"></div></label>
        <input type="text" id="search_input" placeholder="Search ..." onkeyup="commit_search(this)" autofocus />
        <div id="search_result" class="center"></div>
    </div>
    
    
    <script type="text/javascript" src="./lib/js/home.js"></script>
    <script type="text/javascript" src="./lib/js/search_engine.js"></script>
    
</body>
</html>