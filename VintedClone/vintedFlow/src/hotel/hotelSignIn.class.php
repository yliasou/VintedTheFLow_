<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "chatapp";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if(!$conn){
    echo "Database connection error".mysqli_connect_error();
}
$mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $mot_de_passe = mysqli_real_escape_string($conn, $_POST['mot_de_passe']);
    if(!empty($mail) && !empty($mot_de_passe)){
        $sql = mysqli_query($conn, "SELECT * FROM users_hotel WHERE mail = '{$mail}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($mot_de_passe);
            $enc_pass = $row['mot_de_passe'];
            if($user_pass === $enc_pass){
                $status = "Active now";
                echo "Connexion Reussie";
            }else{
                echo "Le mail ou le mot de passe est incorrect";
            }
        }else{
            echo "$mail - Ce mail n'existe pas";
        }
    }else{
        echo "Tout les champs sont requis !";
    }

