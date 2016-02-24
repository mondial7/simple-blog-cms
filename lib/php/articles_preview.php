<?php
	
	// get the articles list {article_name,article_thumb}
	if($_GET['extra_call'] == "x") $extra_call = "../../";
	$tables_path = $extra_call."pippo/data/";
	$articles_file = file_get_contents($tables_path."articles.json");
	$articles = json_decode($articles_file,true);
	$articles = array_reverse($articles);
    $articles_counter = count($articles);

	if($articles != null){
    	$start = 0; // start to show from first article
    	$end = 4; // default show 4 articles
    	if(isset($_GET['start_number_articles_list'])){
    	    $start = $_GET['start_number_articles_list'];  
    	    $end = $start + $end;
    	}
    	if($article_loader_gap_x == "ok"){
    	    $end = $start + $article_loader_gap;
    	}
    	if (isset($_GET['gap_articles_views'])){
    	    $end = $start + $_GET['gap_articles_views'];
    	}
        // it is always null after first call beacuse it is asynchronous called
        if($forcelang!=null) $extra_lang = $forcelang;
    	
    	// Loop thruogh articles and pusblish visible ones
    	$i = $start;
    	while($i<$articles_counter && $start<=$end){
    	    if($articles[$i] != null && $articles[$i]['published'] == "true"){
        	    $start++;
        		echo 	'<div class="article_box">
        		            <div class="article_box_content t3" style="background-image: url(\'pub_data/pics/thumb/'.$articles[$i]['thumb'].'\');">
            					<a href="article/'.$articles[$i]['src'].'/'.$extra_lang.'" class="t3"></a>
        	    				<span class="t3">'.$articles[$i]['title'].'</span>
        		    			<div class="t3 back_box"></div>
        			        </div>
        			   	</div>';
    	    }
    	    $i++;
    	}
	} else { 
	    echo "No articles yet";
	}
	

?>