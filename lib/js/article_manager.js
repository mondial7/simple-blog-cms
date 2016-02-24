
function art_delete(elem){

    var a_src = elem.parentNode.getAttribute("articlesrc");
    
    var check = confirm("ATTENZIONE!\nStai per eliminare l'articolo " + a_src +".\n\nSicuro di voler continuare?");
    
    if(check){
        document.location.reload(); 
        return true;
    } else {
        return false;
    }
    
}


