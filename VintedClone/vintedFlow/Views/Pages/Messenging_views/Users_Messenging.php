<?php 
  session_start();
  include_once "config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">  
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="orderspage.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <!-- Articles Informations  -->
      <?php 
			// Include the database configuration file  
			require_once 'dbConfig.php'; 
			
			// Get image data from database 
        $userId = $_SESSION['usersvalue'];
        $OrderValue = $_POST['OrderID']; 
        //echo($OrderValue." ".$user_id);
        
        $CommandID = $OrderValue;
        $result = $db->query("SELECT * FROM hotel WHERE usersvalue = {$userId} AND commandIDs = {$CommandID}"); 

			?>
            
			<?php if($result->num_rows > 0){ ?> 
				<div class="gallery" style="text-align: center"> 
					<?php while($row = $result->fetch_assoc()){ ?> 
                    
      <div class="details">

          <p><?php echo "CommandID: ". $CommandID;  ?></p>
          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width: 100px; border-radius: 0px;"> <br>
          <p><?php echo "Article Price: ". $row['Price'] . " FCFA"; ?></p>
        </div>
        <?php }
          ?> 
            <p class="status error" style="text-align: center;"></p> 
            <?php } 
            ?>                       
      <div class="chat-box">
          
      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" class="commandID" name="commandID" value="<?php echo $_SESSION["usersvalue"]; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off" value="
        <?php if(!isset($_SESSION['usersvalue'])){
          echo("Hey");
        }
        else{
          
          echo($OrderValue);
          echo('I wanna buy your articles '.$OrderValue);
        } ?>">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="chat.js"></script>

</body>
</html>
