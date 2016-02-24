var NEXT_ARTICLE_INDEX = parseInt(Article_manager.gap_articles_view)+1;

function load_more_articles(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("articles_section_contents").innerHTML += xmlhttp.responseText;
            if(NEXT_ARTICLE_INDEX >= Article_manager.total_number){
                document.getElementById("more_articles_wrapper").innerHTML = "";
            }
            NEXT_ARTICLE_INDEX += parseInt(Article_manager.gap_articles_view);
        }
    };
    xmlhttp.open("GET", "lib/php/articles_preview.php?extra_call=x&start_number_articles_list=" + NEXT_ARTICLE_INDEX, true);
    xmlhttp.send();
}
