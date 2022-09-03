<?php 
    // Include the database configuration file  
    require_once "BackendConfigurations/DB_Configurations/dbconfig.php";
    // Get image data from database 
    $result = $db->query("SELECT * FROM hotel ORDER BY id DESC"); 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ 
    }
    }
    else{ 
        echo("Aucun Article Disponible veuillez vous connectez...");
    }    
?>          
