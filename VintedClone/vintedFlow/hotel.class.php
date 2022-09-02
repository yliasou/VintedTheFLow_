<?php

require_once('src/core/bd/db.conect.php');

$DB = new DB();
function reArrayFiles(&$file_post)  
{
        $file_ary = array();
        //Get the number of element in the table
        $file_count = count($file_post['name']);
        //Get the keys of each element in the table
        $file_keys = array_keys($file_post);

        for ($i=0; $i < $file_count ; $i++) { 
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
}

//Condition d'ajout d'un nouvel hotel
if (isset($_POST["submit"])) {
    $status = 'error'; 
    
    if (!empty($_POST['nomH']) && !empty($_POST['emailH']) && !empty($_POST['telH']) && !empty($_POST['locaH']) && !empty($_POST['descripH'])) {
        $hotelname = htmlspecialchars($_POST['nomH']);
        $emailH = htmlspecialchars($_POST['emailH']);
        $telH = htmlspecialchars($_POST['telH']);
        $locaH = htmlspecialchars($_POST['locaH']);
        $descripH = htmlspecialchars($_POST['descripH']);

       
    }
    else {
        die("Tout les champs doivent etre complèté");
    }

    $hotelExsist = $DB->query('SELECT id FROM hotel WHERE telHotel=:telH', array('telH'=>$telH));

    if(count($hotelExsist)==0){
        $insert = $DB->insert("INSERT INTO hotel (hotelname, localisation, email, telHotel, date_enregistre, descriptionHotel) VALUES(:hotelname, :localisation, :email, :telHotel, NOW(), :descriptionHotel )", array(
            'hotelname'=>$hotelname, 
            'localisation'=>$locaH,
            'email'=>$emailH,
            'telHotel'=>$telH,
            'descriptionHotel'=> $descripH
        ));
    }
    else{
        die($erreur="Article déja dans la base de donnée");
    }
    $hotelExsist = $DB->query('SELECT id FROM hotel WHERE telHotel=:telH', array('telH'=>$telH));

    if(count($hotelExsist)==1){
        $phpFileUploadErrors = array(
            0 => 'there is no error, the file upload with success',
            1 => 'The uploaded file exceeds the upload_max_fileSize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_size directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            5 => 'Missing a temporary folder',
            6 => 'Failed to write file to disk',
            7 => 'A PHP extension stopped the file upload',
        );
        var_dump($_FILES['image']);
        if (isset($_FILES['image'])) {
            
            $idH=0;
            $file_array = reArrayFiles($_FILES['image']); 
            
            for ($i=0; $i <count($file_array) ; $i++) { 
                if ($file_array[$i]['error']) {
                                    
                    $erreur = $file_array[$i]['name']." - ".$phpFileUploadErrors[$file_array[$i]['error']];
                    
                }
                else {
                    $extensions = array('jpg','png','gif','jpeg');
                    //extension the file
                    $file_ext = explode('.',$file_array[$i]['name']);
                    $file_ext = end($file_ext);
                    $name = $file_ext[0];
                    if (!in_array($file_ext,$extensions)) {
                                            
                        $erreur = $file_array[$i]['name']." - ".$phpFileUploadErrors[$file_array[$i]['error']];
                    } 
                    else{
                        $ids = $i+1;
                        
                        foreach($hotelExsist as $hotel)
                        {
                            $path = "src/core/images/".$ids."_hotel_".$hotel->id.".".$file_ext;
                            $idH = $hotel->id;
                        }
                        
                        $imageExist = $DB->query('SELECT id FROM image_hotel WHERE localisation=:localisation', array('localisation'=>$ids."_hotel_".$hotel->id.".".$file_ext));
                        if(count($imageExist)==0){

                            $insertImage = $DB->insert('INSERT INTO image_hotel (hotel, localisation) VALUES(:hotel, :localisation)',array(
                                'hotel'=>$idH,
                                'localisation'=>$ids."_hotel_".$hotel->id.".".$file_ext
                            ));
                            move_uploaded_file($file_array[$i]['tmp_name'], $path);
                            $succed = $file_array[$i]['name']." - ".$phpFileUploadErrors[$file_array[$i]['error']];
                        }
                        else 
                        {
                            $erreur ="L'image existe déja".$phpFileUploadErrors[$file_array[$i]['error']];
                        }
                    }
                }
            }
            header('Location: index.php?id='.$idH);
        }
    }
}

if(isset($_POST['update'])){
    $status = 'error'; 
    if (!empty($_POST['nomH']) && !empty($_POST['emailH']) && !empty($_POST['telH']) && !empty($_POST['locaH'])) {
        $hotelname = htmlspecialchars($_POST['nomH']);
        $emailH = htmlspecialchars($_POST['emailH']);
        $telH = htmlspecialchars($_POST['telH']);
        $locaH = htmlspecialchars($_POST['locaH']);

        $hotelExsist = $DB->query('SELECT id FROM hotel WHERE telHotel=:telH', array('telH'=>$telH));
        if(count($hotelExsist)==1){
            $update = $DB->update('UPDATE hotel SET hotelname=:hotel, localisation=:localisation, email=:email, telHotel=:tel', array(
                'hotel'=>$hotelname,
                'localisation'=>$locaH,
                'email'=>$emailH,
                'tel'=>$telH
            ));
        }else{
            die($erreur="Aucun hotel correspondant");
        }
        $hotelExsist = $DB->query('SELECT id FROM hotel WHERE telHotel=:telH', array('telH'=>$telH));
        
        if(count($hotelExsist)==1){
            $phpFileUploadErrors = array(
                0 => 'there is no error, the file upload with success',
                1 => 'The uploaded file exceeds the upload_max_fileSize directive in php.ini',
                2 => 'The uploaded file exceeds the MAX_FILE_size directive that was specified in the HTML form',
                3 => 'The uploaded file was only partially uploaded',
                4 => 'No file was uploaded',
                5 => 'Missing a temporary folder',
                6 => 'Failed to write file to disk',
                7 => 'A PHP extension stopped the file upload',
            );
    
            if (isset($_FILES['image'])) {
                var_dump($_FILES['image']);
                $idH=0;
                $file_array = reArrayFiles($_FILES['image']); 
                
                for ($i=0; $i <count($file_array) ; $i++) { 
                    if ($file_array[$i]['error']) {
                                        
                        $erreur = $file_array[$i]['name']." - ".$phpFileUploadErrors[$file_array[$i]['error']];
                        
                    }
                    else {
                        $extensions = array('jpg','png','gif','jpeg');
                        //extension the file
                        $file_ext = explode('.',$file_array[$i]['name']);
                        $file_ext = end($file_ext);
                        $name = $file_ext[0];
                        if (!in_array($file_ext,$extensions)) {
                                                
                            $erreur = $file_array[$i]['name']." - ".$phpFileUploadErrors[$file_array[$i]['error']];
                        } 
                        else{
                            $ids = $i+1;
                            
                            foreach($hotelExsist as $hotel)
                            {
                                $path = "src/core/images/".$ids."_hotel_".$hotel->id.".".$file_ext;
                                $idH = $hotel->id;
                            }
                            
                            $imageExist = $DB->query('SELECT id FROM image_hotel WHERE localiastion=:localiastion', array('localiastion'=>$ids."_hotel_".$hotel->id.".".$file_ext));
                            if(count($imageExist)==0){
    
                                $insertImage = $DB->insert('INSERT INTO image_hotel (hotel, localiastion) VALUES(:hotel, :localisation)',array(
                                    'hotel'=>$idH,
                                    'localisation'=>$ids."_hotel_".$hotel->id.".".$file_ext
                                ));
                                move_uploaded_file($file_array[$i]['tmp_name'], $path);
                                $succed = $file_array[$i]['name']." - ".$phpFileUploadErrors[$file_array[$i]['error']];
                            }
                            else 
                            {
                                $erreur ="L'image existe déja".$phpFileUploadErrors[$file_array[$i]['error']];
                            }
                        }
                    }
                }
                header('Location: index.php?id='.$idH);
            }
        }
    }
}
