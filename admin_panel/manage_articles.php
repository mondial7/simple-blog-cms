<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<link href="../lib/style/admin_panel_general.css" rel="stylesheet" media="all" type="text/css">
    <link href="../lib/style/admin_panel_manage_articles.css" rel="stylesheet" media="all" type="text/css">
    <script src="../lib/js/article_manager.js"></script>
    <title>ADMIN PANEL | Tourismpo</title>
</head>
<body>

<?php

    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])){
    	
    	echo "<div class='alert_no_logged'><p>Oopsss... non hai eseguito l'accesso!</p><a href='index.php' class='link_box'>Accedi ora</a></div>";
    	
    } else {
        
        $webpage_name = "Gestisci Articoli";
        include 'header.php';

		if (!isset($_GET['articlename'])){

			// get the article list
			$file_ = "../pippo/data/articles.json";
			$articles = json_decode(file_get_contents($file_),true);

			// display a list with all the articles
			// ...
			foreach($articles as $article){

				?>
					<div class="element_article">
						<div class="element_title">
							<a href="../article/<?php echo $article['src']; ?>/" target="_blank"><?php echo $article['title'] ?></a>
						</div>
                        <div class="manage_buttons" articlesrc="<?php echo $article['src']; ?>">
    						<div class="edit_button">
    							<a href="article_editor.php?a=<?php echo $article['src']; ?>" target="_blank"><span>Modifica</span></a>
    						</div>
    						<?php if($article['published']=="true"){ ?>
    							<div class="hide_button">
    								<a href="article_publisher.php?a=<?php echo $article['src']; ?>&published=false" target="_blank" onclick="javascript:document.location.reload(true);"><span>Nascondi</span></a>
    							</div>
    						<?php }else{ ?>
    							<div class="publish_button">
    								<a href="article_publisher.php?a=<?php echo $article['src']; ?>&published=true" target="_blank" onclick="javascript:document.location.reload(true);"><span>Pubblica</span></a>
    							</div>
    						<?php } ?>
    						<div class="delete_button">
    							<a href="archive_article.php?a=<?php echo $article['src']; ?>" onclick="return art_delete(this);"><span>Elimina</span></a>
    						</div>
    					</div>
					</div>
				<?

			}

		}

	}

?>

</body>
</html>