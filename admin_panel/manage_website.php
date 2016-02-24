<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link href="../lib/style/admin_panel_general.css" rel="stylesheet" media="all" type="text/css">
    <link href="../lib/style/admin_panel_new_article.css" rel="stylesheet" media="all" type="text/css">
    <link href="../lib/style/admin_panel_manage_website.css" rel="stylesheet" media="all" type="text/css">
    <script src="../lib/js/website_editor.js"></script>
    <title>ADMIN PANEL | TourismPo</title>
</head>
<body>

<?php

    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])){
    	
    	echo "<div class='alert_no_logged'>Oopsss... non hai eseguito l'accesso. <a href='index.php'>Accedi ora.</a></div>";
    	
    } else {
        
        
        $webpage_name = "Gestisci Sito";
        $article_editor = "false";
        include 'header.php';

        $data = json_decode(file_get_contents("../pippo/website_set/general_data.json"),true);


        ?>

            <main>

                <div class="website_element">
                    <label for="title">TITOLO</label>
                    <input type="text" required="" name="title" onclick="editor(this);" oninput="prepare_saver(this);" placeholder="<?php echo $data['title']; ?>" />
                    <div class="saver">
                        <div class="general_saver_placeholder"></div>
                        <div class="general_saver" onclick="force_save(this,'title');">Salva</div>
                    </div>
                </div>
                <div class="website_element">
                    <label for="subtitle">SOTTOTITOLO</label>
                    <input type="text" required="" name="subtitle" onclick="editor(this);" oninput="prepare_saver(this);" placeholder="<?php echo $data['subtitle']; ?>" />
                    <div class="saver">
                        <div class="general_saver_placeholder"></div>
                        <div class="general_saver" onclick="force_save(this,'subtitle');">Salva</div>
                    </div>
                </div><!-- 
                <div class="website_element" id="cover_picture_form_wrapper">
                    <label>COVER</label>
                    <form id="cover_picture_form" action="../lib/php/image_uploader.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="image_content">
                        <input type="button" name="submit_cover" value="Carica" onclick="async_upload_redirect(this);" />
                    </form>
                </div> -->
                <div class="website_element">
                    <label for="meta_title">META TITOLO</label>
                    <input type="text" required="" name="meta_title" onclick="editor(this);" oninput="prepare_saver(this);" placeholder="<?php echo $data['meta_title']; ?>" />
                    <div class="saver">
                        <div class="general_saver_placeholder"></div>
                        <div class="general_saver" onclick="force_save(this,'meta_title');">Salva</div>
                    </div>
                </div>
                <div class="website_element">
                    <label for="meta_description">META DESCRIPTION</label>
                    <input type="text" required="" name="meta_description" onclick="editor(this);" oninput="prepare_saver(this);" placeholder="<?php echo $data['meta_description']; ?>" />
                    <div class="saver">
                        <div class="general_saver_placeholder"></div>
                        <div class="general_saver" onclick="force_save(this,'meta_description');">Salva</div>
                    </div>
                </div>
                <div class="website_element">
                    <label for="meta_keywords">META KEYWORDS</label>
                    <input type="text" required="" name="meta_keywords" onclick="editor(this);" oninput="prepare_saver(this);" placeholder="<?php echo $data['meta_keywords']; ?>" />
                    <div class="saver">
                        <div class="general_saver_placeholder"></div>
                        <div class="general_saver" onclick="force_save(this,'meta_keywords');">Salva</div>
                    </div>
                </div>
                <div class="website_element">
                    <label for="narticle_per_view">NUMERO ARTICOLI PER SEZIONE</label>
                    <input type="number" min="1" step="1" required="" onclick="editor(this);" oninput="prepare_saver(this);" name="narticle_per_view" placeholder="<?php echo $data['article_manager']['gap_articles_view']; ?>" />
                    <div class="saver">
                        <div class="general_saver_placeholder"></div>
                        <div class="general_saver" onclick="force_save(this,'narticle_per_view');">Salva</div>
                    </div>
                </div>
                <div class="website_element">
                    <label for="footer_visibility">VISIBILITA' FOOTER</label>
                    <select name="footer_visibility" onchange="prepare_saver(this);">
                        <option value="1" <?php if($data['footer_visibility']=="1"){echo 'selected="selected"';} ?>>Visibile</option>
                        <option value="0" <?php if($data['footer_visibility']=="0"){echo 'selected="selected"';} ?>>Non visibile</option>
                    </select>
                    <div class="saver">
                        <div class="general_saver_placeholder"></div>
                        <div class="general_saver" onclick="force_save(this,'footer_visibility');">Salva</div>
                    </div>
                </div>

                <!-- Need for async uploads -->
                <iframe id='my_iframe_notification' height="0" width="0" name='my_iframe_notification' src=""></iframe>

            </main>
        
        <?php
                    
    }

?>