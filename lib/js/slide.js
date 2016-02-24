function show_prev(elem){
    var slide = elem.parentNode.parentNode.childNodes[1];
    var pics = slide.getElementsByTagName("div");
//    alert(pics.length);
    
    var target_index = parseInt(elem.getAttribute('data'));
    
    if(target_index-1==0) var new_index = pics.length; 
    else var new_index = target_index-1;
    
    elem.setAttribute('data',new_index)
    
    var delta = (target_index-1)*slide.parentNode.offsetWidth;
    
    slide.style = "transform: translateX(-"+delta+"px)";
}

function show_next(elem){
    var slide = elem.parentNode.parentNode.childNodes[1];
    var pics = slide.getElementsByTagName("div");
//      alert(pics.length);
    
    var target_index = parseInt(elem.getAttribute('data'));
    
    if(target_index==pics.length) var new_index = 1; 
    else var new_index = target_index+1;
    
    elem.setAttribute('data',new_index);
    
    var delta = (target_index-1)*slide.parentNode.offsetWidth;
    
    slide.style = "transform: translateX(-"+delta+"px)";
}

// only for on slide

//var toggle_play = false;

function start_play(elem){
  //  toggle_play = true;
    
    elem.parentNode.parentNode.childNodes[1].classList.add("autoplay");
    // get right arrow element
    var elem = elem.parentNode.childNodes[3];
    play(elem);
    
    
    // toggle play/stop buttons
    var stop_button = elem.parentNode.getElementsByTagName("span")[3];
    var play_button = elem.parentNode.getElementsByTagName("span")[2];
    stop_button.style = "display:inline-block";
    play_button.style = "display:none";
    
    // hide controllers arrows
    elem.parentNode.getElementsByTagName("span")[0].style = "display:none";
    elem.parentNode.getElementsByTagName("span")[1].style = "display:none";
}

function stop_play(elem){
    elem.parentNode.parentNode.childNodes[1].classList.remove("autoplay");
    
    // toggle play/stop buttons
    var stop_button = elem.parentNode.getElementsByTagName("span")[3];
    var play_button = elem.parentNode.getElementsByTagName("span")[2];
    stop_button.style = "display:none";
    play_button.style = "display:inline-block";
    
    // show controllers arrows
    elem.parentNode.getElementsByTagName("span")[0].style = "display:inline-block";
    elem.parentNode.getElementsByTagName("span")[1].style = "display:inline-block";
}

function play(elem){
    show_next(elem);
    if(elem.parentNode.parentNode.childNodes[1].classList.contains("autoplay")){
        setTimeout(function(){
            play(elem);
        },1500);
    }
}