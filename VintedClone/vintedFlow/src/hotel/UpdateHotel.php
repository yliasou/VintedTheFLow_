<?php 
  // if(isset($_SESSION['unique_id'])){
  //   header("location: users.php");
  // }
  require("../../header.php");

  $DB = new DB();

  if(isset($_GET['idHotel']))
  {
    $hotelToUpdate = $DB->query('SELECT * FROM hotel WHERE id=:id', array('id'=>$_GET['idHotel']));

    foreach ($hotelToUpdate as $hotel) {
      $imageHotel= $DB->query('SELECT localiastion FROM image_hotel WHERE hotel=:id', array('id'=>$hotel->id));
?>

<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Mise à jour d'un hotel</header>
        <form action="hotel.class.php" method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class="error-text"></div>
            <div class="form-control">
              <div class="field input">
                <label>Nom de l'hotel</label>
                <input type="text" name="nomH" placeholder="First name" src="<?= $hotel->hotelname ?>" required>
              </div>
            </div>
            <div class="field input">
              <label>Email de l'hotel</label>
              <input type="email" name="emailH" placeholder="Enter l'email" value="<?= $hotel->email?>" required>
            </div>
            <div class="field input">
              <label>Localisation de l'hotel</label>
              <input type="text" name="locaH" value="<?= $hotel->localisation?>" placeholder="Localisation" required>
            </div>
            <div class="field input">
              <label>Téléphone</label>
              <input type="text" name="telH" placeholder="Enter le téléphone de l'hotel" value="<?= $hotel->telHotel?>" inputmask="'mask': '+2259999999999'"required>
              <i class="fas fa-eye"></i>
            </div>
            
            <div class="field image">
              <label>Select Hotel Image</label>
              <?php
                foreach($imageHotel as $image){
              ?>
                <input type="file" class="form-control" name="image[]" value="<?= $image->localiastion?>" aria-label="Image" aria-describedby="Image-addon">
              <?php
                }
              ?>
            </div>
            
            <div class="field button">
              <input type="submit" name="update" value="Enregistrer les modifications">
            </div>
        </form>
    </section>
  </div>

  <script src="../javascript/pass-show-hide.js"></script>
  <script src="../javascript/signup.js"></script>
</body>
<?php  
    }
  }else{
    die("Aucun hotel n'a été selectionné");
  }
  
?>
</html>
