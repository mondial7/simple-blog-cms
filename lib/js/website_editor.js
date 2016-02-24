/* GLOBAL VARIABLES */

var STATE_CHANGED = false;

/* FUCTIONS */

function force_save(elem,inputName){ // maybe i shoild take input name from .attribut (or somethign like that)
    
    var checker_temp = false;
    
    elem.className = "general_saver loading";
    
    if(inputName == "footer_visibility"){
        var temp_input_select = document.querySelector("select[name=" + inputName + "]");
        var input = temp_input_select.options[temp_input_select.selectedIndex].value;
        data = inputName + "=" + input;
    } else {
        input = document.querySelector("input[name=" + inputName + "]");
        data = inputName + "=" + input.value;
    }

    if(input.value == "") {
        checker_temp = confirm("Stai salvanto un campo vuoto. Sicuro di voler continuare?");
    } else {
        checker_temp = true;
    }
    
    if(checker_temp){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
                if(xhttp.responseText != "OK"){
                    alert(xhttp.responseText);
                    elem.className = "general_saver active";
                } else {
                    elem.className = "general_saver";
                }    
            }
        };
        xhttp.open("POST", "website_data_saver.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(data); 
    } else {
        elem.className = "general_saver";
    }  
    
}

function prepare_saver(elem){

    parent_ndList = elem.parentNode.childNodes;
    for(var k=0;k<parent_ndList.length;k++){
        if(parent_ndList[k].className == "saver"){
            var ndList = parent_ndList[k].childNodes;
            for(var i=0;i<ndList.length;i++){
                if(ndList[i].className == "general_saver"){
                    ndList[i].className = "general_saver active";
                }
            }    
        }
    }
    
    STATE_CHANGED = true;
    
}

var isCtrl = false;
document.onkeyup=function(e){
    if(e.keyCode == 17) isCtrl=false;
}

document.onkeydown=function(e){
    if(e.keyCode == 17) isCtrl=true;
    if(e.keyCode == 83 && isCtrl == true) {
        
        // still to implement the code ... force_save(elem,inputName)
        
        return false;
    }
}

function editor(elem){
    elem.value = elem.placeholder;
}


















