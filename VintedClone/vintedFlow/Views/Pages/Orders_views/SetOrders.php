<?php 
// Include the database configuration file
session_start();  
include_once "config.php";

// If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["submit"])){ 
    echo $statusMsg;    
    
    $OrderID  =  mysqli_real_escape_string($conn, $_POST['OrderID']);
    $newusermail =  $_POST['newusermail'];
    $ownerID =   mysqli_real_escape_string($conn, $_POST['ownerID']);
    echo($ownerID);
    $Username =  mysqli_real_escape_string($conn, $_POST['Username']);   
    // echo($Username);
    echo($newusermail);
    // echo($OrderID);
    $sql = mysqli_query($conn,"INSERT INTO `Orders` (`usermail`, `Username`, `OrderID`, `ownerID`) VALUES ('$newusermail', '$Username', '$OrderID', '$ownerID')");
    // $sql = mysqli_query($conn, "INSERT INTO Orders (usermail, Username, OrderID)
    //         VALUES ({$usermail}, {$Username}, '{$OrderID}')") or die();

    $to = $newusermail;
    $subject = "New order for you";
    $txt = "You have a new order for your articles ".$OrderID." Open the app for more details";
    $headers = "zokoupol5@gmail.com" . "\r\n";

    mail($to,$subject,$txt,$headers);

} 
 
// Display status message 
    
?>