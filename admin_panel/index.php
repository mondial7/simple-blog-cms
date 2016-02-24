<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<link href="../lib/style/admin_panel_general.css" rel="stylesheet" media="all" type="text/css">
	<link href="../lib/style/admin_panel_login.css" rel="stylesheet" media="all" type="text/css">
	<title>ADMIN PANEL | TourismPo</title>
</head>
<body>
<?php
	
	$signin_form = '<form action="" method="post">
				<input type="text" name="user" placeholder="Username" autofocus="" required>
				<input type="password" name="pass" placeholder="Password" required>
				<input type="submit" value="Accedi" name="submit">
				</form>';

	// check if user is already logged
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
	    include 'land.php';
	} else {

        if (isset($_POST['submit'])){
    		
    		$user = $_POST['user'];
    		$pass = $_POST['pass'];
    
    		if(!isset($user) || !isset($pass)){
    			
    			echo "<div class='alert'>Username o password errati</div>";			
    			echo $signin_form;
    		
    		} else {
                
                include 'my_credits.php';
                
    			if ($user != $secret_user){
    				echo "<div class='alert'>Username errato</div>";			
    				echo $signin_form;
    			} else if (md5($pass) != $secret_pass){
    				echo "<div class='alert'>Password errata</div>";			
    				echo $signin_form;
    			} else {
    				$_SESSION['username'] = $user;
    				$_SESSION['password'] = md5($pass);
    				//include 'land.php';
        			// redirect to land.php
        			echo '<a id="link_to_land" href="land.php" title="land">Accedi al pannello</a>';
        			echo '<script>window.location="land.php"</script>';
    			}
    
    		}
    
    	} else {
    
    		echo $signin_form;
    
    	}

	}
	
?>

</body>
</html>