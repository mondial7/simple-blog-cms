<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<link href="../lib/style/admin_panel_general.css" rel="stylesheet" media="all" type="text/css">
    <link href="../lib/style/admin_panel_land.css" rel="stylesheet" media="all" type="text/css">
    <title>ADMIN PANEL | Tourismpo</title>
</head>
<body>
<?php 
	// check if user is already logged
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
	    
	?>
	
	    
	    <main>
	        
	        <section class="panel_landing_section">
	            <a href="manage_articles.php" title="Article Manager">Gestisci Articoli</a>
	        </section><!--
	        --><section class="panel_landing_section">
	            <a href="new_article.php" title="New Article">Nuovo Articolo</a>
	        </section><!--
	        --><section class="panel_landing_section">
	            <a href="manage_website.php" title="Website Manager">Gestisci Sito</a>
	        </section><!--
	        --><section class="panel_landing_section">
	            <a href="logout.php" title="Logout">Esci</a>
	        </section>
	        
	    </main>
	   
	
	<?php
	    
	} else {
        
        echo "Nothing to see.";
        	    
	}
	
?>
</body>
</html>