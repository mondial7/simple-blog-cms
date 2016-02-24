<?php

    $type = $_GET['t'];

    $file = "../media/files/".$_GET['file'];
    $file_download_name = "PDNTRI_".$_GET['file'];

if(file_exists($file)){

if($type == "img"){
    header('Content-type: image/jpg');
}

if($type == "png"){
    header('Content-type: image/png');
}

if($type == "txt"){
    header('Content-type: text/plain');
}

if($type == "doc"){
    header('Content-type: application/msword');
}

if($type == "docx"){
    header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
}

if($type == "exe"){
    header('Content-type: application/octet-stream');
}

if($type == "pdf"){
    header('Content-type: application/pdf');
}

if($type == "xls"){
    header('Content-type: application/vnd.ms-excel');
}

if($type == "xlsx"){
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
}

    header('Content-Disposition: attachment; filename="'.$file_download_name.'"',false);

    readfile($file);

} else {

    echo 'Error while dowloading your file...please try again. File seems to not exists anymore on the server.';

}
    
?>