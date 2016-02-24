<?php 

    session_start();
	
	// check if user is already logged
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){


        if(!$article_editor){
	    
	?>
	
	    
	    <script src="../lib/js/article_editor.js"></script>

    <?php
    
        }
        
    ?>

	    <header>
        	<div id="title">
        		<span>EDITOR | <?php echo $webpage_name; ?></span>
        	</div>
        	<nav>
        		<div class="menu_element"><a href="../" target="_blank">Visualizza il sito</a></div>
        		<div class="menu_element"><a href="manage_articles.php">Gestisci Articoli</a></div>
        		<div class="menu_element"><a href="new_article.php">Nuovo Articolo</a></div>
        		<div class="menu_element"><a href="manage_website.php">Modifica Sito</a></div>
        		<div class="menu_element"><a href="logout.php">Esci</a></div>
        	</nav>
        </header>
	   
	
	<?php
	    
	} else {
        
        echo "nothing to see.";
        	    
	}
	
?>