/* GLOBAL VARIABLES */ 

var STATE_CHANGED = false;
var IS_RICH_CONTENTS = false;

/* render onload functions */

function render_cover_upload_form() {
    
    var wrapper = document.getElementById('thumb_section');
    
    // define form wrapper
    var elem = document.createElement("div");
    setAttributes(elem,{"class":"form_thub_wrapper"});
    
    // define a new form for picture upload
    var form = document.createElement("form");
    setAttributes(form,{"class":"input_thumb_form","action":"../lib/php/thumb_uploader.php","method":"post","enctype":"multipart/form-data"});
    
    // define submit button
    var submit_button = document.createElement("input");
    setAttributes(submit_button,{"type":"button","class":"input_submit_thumb_upload","value":"Carica","name":"upload_image","onclick":"async_upload_redirect(this);"})
    
    // define a new input image Object
    var attributes = {"type":"file","accept":"image/*","value":"","name":"thumb","class":"thumb_content_input"};
    var image_input = document.createElement("input");
    setAttributes(image_input,attributes);
    
    // attach elements to form
    form.appendChild(image_input);
    form.appendChild(submit_button);
    elem.appendChild(form);
    
    wrapper.appendChild(elem);
}

/* FUNCTIONS */

function setAttributes(element, attrs) {
    for(var key in attrs) {
        element.setAttribute(key, attrs[key]);
    }
}

function attachNewContent(data_type){
    
    var elem, container, extra_input, label;
    
    switch (data_type){
        
        case 'text':
            
            elem = newTextContentInput();
            label = 'Contenuto di testo';
            var richTextSwitch = true;
            var richTextElem = newRichTextElem(elem.id);
            
            break;
        case 'image':
            
            elem = newImageContentInput();
            label = 'Immagine';
            
            break;
        case 'video':
            
            elem = newVideoContentInput();
            label = 'Video';
            
            break;
    } // end switch
    
    // attach new element to the document
    if (elem != null){
        // define label
        var labelNode = document.createElement("label");
        labelNode.innerHTML = label;
        
        // define the general container
        container = document.createElement("DIV");
        setAttributes(container,{"class":"t3 container_content"})
        
        // define the node to close container
        closer = document.createElement("DIV");
        setAttributes(closer,{"class":"closer_content","onclick":"close_content(this);"})
        closer.innerHTML = '<svg viewbox="0 0 40 40"><path class="close-x" d="M 10,10 L 30,30 M 30,10 L 10,30" /></svg>';
        
        // attach elements to container
        container.appendChild(labelNode);
        if(richTextSwitch === true){ 
            container.appendChild(richTextElem);
            setAttributes(closer,{"onclick":"secure_close(this,'')"});
        }
        container.appendChild(elem);
        container.appendChild(closer);
        
        // append container to document
        document.getElementById("section_content").appendChild(container);
    }
    
}

function getCurrentContentsNumber(){
    return document.getElementsByClassName("container_content").length;
}

function newVideoContentInput(){
    
    var n = getCurrentContentsNumber();
    
    // define a new video Object
    var attributes = {"type":"url","required":"","name":"content["+n+"][video]","class":"video_content_input","placeholder":"Inserisci l'url del video...","onchange":"addSecureCloser(this)"};
    var elem = document.createElement("input");
    setAttributes(elem,attributes);

    // areturn the element
    return elem;
}

function newTextContentInput(){
    
    var n = getCurrentContentsNumber();
    
    // get total nuber of text input
    var n_text = document.getElementsByClassName("text_content_input").length;
    var id_input = "textarea_" + n_text;
    // define a new text Object
    var attributes = {"name":"text_content[]","class":"text_content_input","id":id_input,"name":"content["+n+"][text]","style":"display:none","onchange":"addSecureCloser(this)"};
    var elem = document.createElement("textarea");
    setAttributes(elem,attributes);
    
    
    // return the element
    return elem;
}

function newRichTextElem(id_input){
    
    IS_RICH_CONTENTS = true;
    
    var id_richField = "richField_" + id_input;
    
    var container = document.createElement("div");
    setAttributes(container,{"class":"richText_container"});
    
    // define new ifram -> my richtextarea
    var attributes = {"name":id_richField,"id":id_richField,"class":"richTextField","onload":"enableTextEditor('"+id_richField+"');"};
    var elem = document.createElement("iframe");
    setAttributes(elem,attributes);
    
    // define a command line with buttons
    var commands = {"B":"iBold('"+id_richField+"')","i":"iItalic('"+id_richField+"')","U":"iUnderline('"+id_richField+"')","Title":"iFontSizeSubtitle('"+id_richField+"')","HR":"iHorizontalRule('"+id_richField+"')","UL":"iOrderedList('"+id_richField+"')","Link":"iLink('"+id_richField+"')","Unlink":"iUnLink('"+id_richField+"')"};
    var commandLineWrapper = document.createElement("div");
    setAttributes(commandLineWrapper,{"class":"commandLineWrapper"});
    for(var key in commands){
        var command = document.createElement("input");
        setAttributes(command,{"type":"button","onclick":commands[key],"value":key});
        commandLineWrapper.appendChild(command);
    }
    
    // append everyhing to the container
    container.appendChild(commandLineWrapper);
    container.appendChild(elem);
    
    return container;
}

function newImageContentInput(){
    
    // define form wrapper
    var elem = document.createElement("div");
    setAttributes(elem,{"class":"form_image_wrapper"});
    
    // define a new form for picture upload
    var form = document.createElement("form");
    setAttributes(form,{"class":"input_image_form","action":"../lib/php/image_uploader.php","method":"post","enctype":"multipart/form-data"});
    
    // define submit button
    var submit_button = document.createElement("input");
    setAttributes(submit_button,{"type":"button","class":"input_submit_image_upload","value":"Carica","name":"upload_image","onclick":"async_upload_redirect(this);"})
    
    // define hidden input for content index
    var n_contents = getCurrentContentsNumber();
    var hidden_input = document.createElement("input");
    setAttributes(hidden_input,{"type":"hidden","name":"picture_index","value":n_contents});
    
    // define a new input image Object
    var attributes = {"type":"file","accept":"image/*","value":"","name":"image_content","class":"image_content_input"};
    var image_input = document.createElement("input");
    setAttributes(image_input,attributes);
    
    // attach elements to form
    form.appendChild(hidden_input);
    form.appendChild(image_input);
    form.appendChild(submit_button);
    elem.appendChild(form);
    
    // return the element
    return elem;
}


// remove a general container
function close_content(target){
    var element = target.parentNode;
    element.parentNode.removeChild(element);
}

function addSecureCloser(elem,extra_type){
    // add function secure_close to close button
    setAttributes(elem.nextSibling,{"onclick":"secure_close(this,'" + extra_type + "')"});
}

// secure close -> double step to close content
function secure_close(target_x,extra){
    
    var action = confirm("Vuoi veramente eliminare questo contenuto?");
    
    if (action == true){
        
        // TODO: check if extra --> image than show_loader and delete file after asking confirm
        close_content(target_x);
        
    }
    
}


function async_upload_redirect(elem) {
    // change target of form
    var form = elem.parentNode;
    form.target = 'my_iframe_notification';
    
    // add id to container uploader
    setAttributes(form.parentNode,{"id":"current_uploader_wrapper"});
    
    // submit form
    form.submit();

    // show loader
    document.getElementById("loader_wrapper").className = "visible";
    
}

function async_upload_callback(message,filename,errors,content_index){
    // check error
    if (errors == null){
        
        alert(message);
        
        var container = document.getElementById("current_uploader_wrapper");
        
        // show uploader picture
        var pic_shower = document.createElement("img");
        setAttributes(pic_shower,{"src":"../pub_data/pics/general/" + filename,"class":"pic_shower","height":"80px"});
        var pic_hidden_input = document.createElement("input");
        setAttributes(pic_hidden_input,{"type":"hidden","name":"content["+content_index+"][image]","value":filename,"required":""});
        
        container.innerHTML = "";
        container.appendChild(pic_shower);
        container.appendChild(pic_hidden_input);
        
        // add secure closer
        addSecureCloser(container);
        
        // reset attributes uploader
        container.removeAttribute("id");
        
    } else {
        
        alert(errors);
        
    }
    
    // hide loader
    document.getElementById("loader_wrapper").className = "hidden";
}

function async_upload_thub_callback(message,filename,errors){
    // check error
    if (errors == null){
        
        alert(message);
        
        var container = document.getElementById("current_uploader_wrapper");
        
        // show uploader picture
        var pic_shower = document.createElement("img");
        setAttributes(pic_shower,{"src":"../pub_data/pics/thumb/" + filename,"class":"pic_shower","height":"80px"});
        var pic_hidden_input = document.createElement("input");
        setAttributes(pic_hidden_input,{"type":"hidden","name":"thumb","value":filename,"required":""});
        
        container.innerHTML = "";
        container.appendChild(pic_shower);
        container.appendChild(pic_hidden_input);
        
        // reset attributes uploader
        container.removeAttribute("id");
        
    } else {
        
        alert(errors);
        
    }
    
    // hide loader
    document.getElementById("loader_wrapper").className = "hidden";
}


/* RICH TEXT EDITOR METHODS */

function enableTextEditor(name){
    window.frames[name].document.designMode = 'On';
}
function iBold(name){
	window.frames[name].document.execCommand('bold',false,null); 
}
function iUnderline(name){
	window.frames[name].document.execCommand('underline',false,null);
}
function iItalic(name){
	window.frames[name].document.execCommand('italic',false,null); 
}
function iFontSize(name){ // NOT USED
	var size = prompt('Enter a size 1 - 7', '');
	window.frames[name].document.execCommand('FontSize',false,size);
}
function iFontSizeSubtitle(name){
	window.frames[name].document.execCommand('FontSize',false,6);
}
function iFontSizeNormalize(name){
	window.frames[name].document.execCommand('FontSize',false,3);
}
function iForeColor(name){ // NOT USED
	var color = prompt('Define a basic color or apply a hexadecimal color code for advanced colors:', '');
	window.frames[name].document.execCommand('ForeColor',false,color);
}
function iHorizontalRule(name){
	window.frames[name].document.execCommand('inserthorizontalrule',false,null);
}
function iUnorderedList(name){
    window.frames[name].document.execCommand("InsertOrderedList", false,"newOL");
}
function iOrderedList(name){ // NOT USED
    window.frames[name].document.execCommand("InsertUnorderedList", false,"newUL");
}
function iLink(name){
	var linkURL = prompt("Enter the URL for this link:", "http://"); 
	window.frames[name].document.execCommand("CreateLink", false, linkURL);
}
function iUnLink(name){
	window.frames[name].document.execCommand("Unlink", false, null);
}


function sync_richtext(name){
    var textarea_id = name.split("_")[1] + "_" + name.split("_")[2];
    var textarea = document.getElementById(textarea_id);
	textarea.innerHTML = window.frames[name].document.body.innerHTML;
}



/* Submit funcions */ 

function checkContentsNumber(){
    var conts_n = getCurrentContentsNumber();
    if(conts_n < 1){
        return confirm("Stai per salvare un articolo senza contenuti. Sicuro di voler procedere?");
    }
    
    if(IS_RICH_CONTENTS){
        // sync all rich contents textareas values
        var richTextFields = document.getElementsByClassName("richTextField");
        for(var i=0;i<richTextFields.length;i++){
            sync_richtext(richTextFields[i].name);
        }
        
    }
    
    return true;
    
}








