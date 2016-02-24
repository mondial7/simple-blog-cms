function enable_searching(){
    // display search container
    var search_container = document.getElementById("search_container");
    search_container.className = "t3 visible";
    document.getElementById("search_input").focus();
}

function close_search(){
    // hide search container
    var search_container = document.getElementById("search_container");
    search_container.className = "t3 hidden";
}

function commit_search(input){
    document.getElementById("loader_search").className = "";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("search_result").innerHTML = xmlhttp.responseText;
            document.getElementById("loader_search").className = "hidden";
        }
    };
    xmlhttp.open("GET", "./lib/php/search.php?q=" + input.value, true);
    xmlhttp.send();
}