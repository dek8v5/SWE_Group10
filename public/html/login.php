<?php
    
	$inputUsername = $_POST['username'];
    $pass = $_POST['password'];
        
    $m = new MongoClient();
   
    $db = $m->SWE;
    $c = $db->user;

    $query = array('username' => $inputUsername);
    $cursor = $c->find($query);  

    foreach ($cursor as $doc){        
        extract($doc);        
    }

    if(password_verify($salt.$pass, $hashed_password)){          //session start
        
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["permission"] = $permission_level;
        $_SESSION["name"] = $fname;
        header("Location: /html/index.php");   
            
	}else{
        echo 'Invalid login.';
        echo '<a href = "/html/login.html">Back to Login</a> <a href = "/html/index.php">Back to Home</a>';
    }       
    	
?>	