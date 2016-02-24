<?php 
    include '../../lib/php/load_article_contents.php';
    // language switch
    $server_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if(isset($_GET['lang']) && ($_GET['lang'] == "en" || $_GET['lang'] == "it" || $_GET['lang'] == "de")){ $server_lang = $_GET['lang']; $forcelang=$_GET['lang']; }
    $lang = json_decode(file_get_contents("../../pippo/website_set/".$server_lang."/index.json"),true);
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../../lib/style/article.css" rel="stylesheet" media="all" type="text/css">
        <link href="../../lib/style/general.css" rel="stylesheet" media="all" type="text/css">
        <title><?php echo $data_array['meta_title']; ?></title>
        <meta name="description" content="<?php echo $data_array['meta_description']; ?>" />
        <meta name="keywords" content="<?php echo $data_array['meta_keywords']; ?>" />
        
        <meta property="og:title" content="<?php echo $data_array['meta_title']; ?>" />
        <meta property="og:type" content="article" />
        <meta property="article:published_time" content="<?php echo $data_array['birthday']; ?>" />
        <meta property="article:modified_time" content="<?php echo $data_array['date_edit']; ?>" />
        <meta property="article:section" content="<?php echo $data_array['category']; ?>" />
        <meta property="article:tag" content="<?php echo $data_array['tag']; ?>" />
        <meta property="og:site_name" content="TourismPo" />
        <meta property="og:locale" content="it_IT" />
        <meta property="og:locale:alternate" content="en_GB" />
        <meta property="og:locale:alternate" content="de_DE" />
        <meta property="og:description" content="<?php echo $data_array['meta_description']; ?>" />
        <meta property="og:url" content="<?php print "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
        <meta property="og:image" content="http://tourismpo.com/pub_data/pics/thumb/<?php echo $data_array['thumb']; ?>" />
        
        <!-- Add twitter meta tags -->
        <meta property="twitter:card" content="summary" />
        <!-- <meta property="twitter:url" content="" /> -->
        <meta property="twitter:title" content="<?php print $data_array['meta_title']; ?>" />
        <meta property="twitter:description" content="<?php print $data_array['meta_description']; ?>" />
        <meta property="twitter:image" content="http://tourismpo.com/pub_data/pics/thumb/<?php echo $data_array['thumb']; ?>" />

    </head>
    <body lang="<?php print($server_lang); ?>">

        <div id="loader_land">
			<div></div><div></div><div></div><div></div>
		</div>

		<?php include '../../admin_panel/article_template/header.php'; ?>
    
        <main itemscope itemtype="http://schema.org/Article">
            
            <div id="article_title" itemprop="name">
                <h1><?php echo $data_array['title']; ?></h1>
            </div>
            
            <div id="article_subtitle">
                <h2><?php echo $data_array['subtitle']; ?></h2>
            </div>
            
            <div id="article_author">
                <span itemprop="author">TourismPo</span>
            </div>

            <div id="article_date">
                <span><?php echo $data_array['']; ?></span>
            </div>
            
            <div id="contents" articleBody >
            <?php 
                for($i=0;$i<count($data_array['contents']);$i++){
                    
                    $content = $data_array['contents'][$i];
                    
                    ?><div class="contents"><?
                        switch($content['type']){
                            case 'image':
                                
                                    ?>
                                        
                                        <div class="picture_wraper">
                                            <img src="../../pub_data/pics/general/<?php print $content['src']; ?>" alt="<?php print $content['alt']; ?>" title="<?php print $content['title']; ?>" />
                                            <div class="picture_description">
                                                <div class="title"><?php print $content['title']; ?></div>
                                                <?php if($content['rights_url'] != "") { ?>
                                                    <div class="picture_rights"><a href="<?php print $content['rights_url']; ?>" target="_blank" title="<?php print $content['rights_url']; ?>">&copy; <?php print $content['rights']; ?></a></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        
                                    <?
                                
                                break;
                            case 'video':
                                    
                                    ?>
                                        <iframe src="<?php print $content['src']; ?>" frameborder="0" allowfullscreen></iframe>
                                    <?
                                    
                                break;
                            case 'text':
                                    
                                    ?>
                                        <p>
                                            <?php print $content['src']; ?>
                                        </p>
                                    <?
                                    
                                break;
                            case 'gallery':
                    
                                    ?>
                                        
                                        <style>.slider_<?php print $i; ?> {width:<?php print count($content['data'])*100; ?>%}</style>
                                    
                                        <div class="wrapper_slider">
            
                                            <div class="slider slider_<?php print $i; ?>" id="ccc">
                                                <?php foreach($content['data'] as $img){ ?>
                                                    <div class="picture_container">
                                                        <img src="../../pub_data/pics/general/<?php print $img['src']; ?>" alt="<?php print $img['alt']; ?>" />
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            
                                            <div class="controls">
                                                <span class="left_arrow" onclick="show_prev(this)" data="<?php print count($content['data']); ?>"><</span>
                                                <span class="right_arrow" onclick="show_next(this)" data="1">></span>
                                                <span class="autoplay_button" onclick="start_play(this)">Play</span>
                                                <span class="autoplay_button" onclick="stop_play(this)" style="display:none">Stop</span>
                                            </div>
                                            
                                        </div>
                                        
                                    <?php
                                    
                                break;
                        }
                    ?></div><?
                    
                }
            
            ?>
            </div>
                    
            <section id="articles_navigator">
                <!-- add navigation link to next and prev articles -->
            </section>

            <section id="comments">
                <!-- add comment engine -->
            </section>

        </main>
        
        <script src="../../lib/js/search_engine_article.js"></script>
        <div id="search_container" class="hidden t3">
            <div id="close_search" onclick="close_search()"><svg viewbox="0 0 40 40"><path class="close-x" d="M 10,10 L 30,30 M 30,10 L 10,30" /></svg></div>
            <label><div id="search_icon_big"></div>Search<div id="loader_search" class="hidden"></div></label>
            <input type="text" id="search_input" placeholder="Search ..." onkeyup="commit_search(this)" autofocus />
            <div id="search_result" class="center"></div>
        </div>
        
        <?php include '../../admin_panel/article_template/footer.php'; ?>

    </body>
</html>