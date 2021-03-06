<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<link href="../lib/style/admin_panel_general.css" rel="stylesheet" media="all" type="text/css">
	<link href="../lib/style/admin_panel_new_article.css" rel="stylesheet" media="all" type="text/css">
	<script src="../lib/js/article_editor.js"></script>
	<title>ADMIN PANEL | TourismPo</title>
</head>
<body onload="render_cover_upload_form()">

<?php

    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])){

		echo "<div class='alert_no_logged'><p>Oopsss... non hai eseguito l'accesso!</p><a href='index.php' class='link_box'>Accedi ora</a></div>";

	} else {

        
        $webpage_name = "Nuovo Articolo";
        include 'header.php';
	    
	
		// Form to create a new content
		?>

			<main>
				<form method="post" action="article_saver.php">
					<div id="public_data">
					    <!-- add form for thumbainal input here -->
						<label for="title">TITOLO</label>
						<input type="text" name="title" required="">
						<label for="subtitle">SOTTOTITOLO</label>
						<input type="text" name="subtitle">
						<label for="category">CATEGORIA</label>
						<input type="text" name="category" required="">
						<label for="tags">TAGS</label>
						<input type="text" name="tags" required="">
						<div id="thumb_section">
							<label for="thumb">COVER HOME</label>
						</div>
						<div id="section_content"></div>
						<div id="new_content_element">
							<p>AGGIUNGI CONTENUTO</p>
							<div id="new_content_type_selector">
    							<div id="new_content_text" onclick="attachNewContent('text');">
    								<span>Testo</span>
    							</div>
    							<div id="new_content_picture" onclick="attachNewContent('image');">
    								<span>Immagine</span>
    							</div>
    							<div id="new_content_text" onclick="attachNewContent('video');">
    								<span>Video</span>
    							</div>
						    </div>
						</div>
					</div>
					<div id="meta_data">
						<label for="meta_title">META TITLE</label>
						<input type="text" name="meta_title" required="">
						<label for="meta_description">META DESCRIPTION</label>
						<input type="text" name="meta_description" required="">
						<label for="subtitle">META KEYWORDS (separate da una ",")</label>
						<input type="text" name="meta_keywords">
					</div>
                    <div id="submit_buttons">
    					<input type="submit" name="save_new_article" onclick="return checkContentsNumber();" value="Salva">
	    		        <input type="submit" name="publish_new_article" onclick="return checkContentsNumber();" value="Pubblica direttamente">
		            </div>
				</form>
				
				<!-- Need for async uploads, and used as upload notification box -->
				<iframe id='my_iframe_notification' name='my_iframe_notification' src=""></iframe>
			</main>
			
			<div id="loader_wrapper" class="hidden"><div id="loader"></div></div>
			
		<?php

	}


?>
</body>
</html>