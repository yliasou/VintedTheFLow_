<?php 
   
    require_once 'BackendConfigurations/DB_Configurations/dbConfig.php'; 
	$user_id = $_SESSION['unique_id'];
	// Get image data from database 
	$UserResult = $db->query("SELECT * FROM users WHERE unique_id = {$user_id} "); 
        
    if($UserResult->num_rows > 0){
	 
        while($userinfo = $UserResult->fetch_assoc()){
            $mailUser =  $userinfo['email'];
            $mailUser =  $userinfo['email'];
            $_SESSION["usermail"] =  $mailUser;
            $_SESSION["Username"] =  $userinfo['fname'];
            // echo($mailUser);
            //$_SESSION["commandID"] =  $userinfo['id'];
        }
    }
    else{
        echo("Cant get user info");
    }
?>