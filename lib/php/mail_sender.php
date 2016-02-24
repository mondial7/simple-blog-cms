<?php
    
    
    if(isset($_POST['submit'])){
        
        $to = "info@tourismpo.com";
        $object = "New mail - website";
        $message = $_POST['content'];
        
        $header = 'From: ' . $_POST['mail'] . "\r\n" .
                  'Reply-To: ' . $_POST['name'] . "\r\n" .
                  'X-Mailer: PHP/' . phpversion();
        
        mail($to,$object,$message,$header);
        
        echo "<script>document.location = '../../contacts/?sent=1';</script>";
        
    } else {
        
        echo "no submit set!";
        
        echo "<script>document.location = '../../contacts/?sent=0';</script>";
        
    }



?>