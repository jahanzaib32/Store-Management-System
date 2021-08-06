<?php 

        $servername = "localhost";
        $username = "breket7_live_cmnt";
        $password = "zai327@";
        $dbname = "breket7_fb2";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        if ( $_POST["stream_name"] != ""){
            
            /* Getting file name */
            $filename = $_FILES['file']['name'];
            
            /* Location */
            $location = "stream_images/".$filename;
            $uploadOk = 1;
            $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
            
            /* Valid Extensions */
            $valid_extensions = array("jpg","jpeg","png");
            /* Check file extension */
            if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
               $uploadOk = 0;
            }
            
            if($uploadOk == 0){
               echo 0;
            }else{
               /* Upload file */
               if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                  echo $location;
               }else{
                  echo 0;
               }
            }
            
            
            
            $conn -> query("INSERT INTO live_streams (name, pic, link) VALUES ('" . $_POST['name'] . "', '$filename', '" . $_POST['link'] ."' )");
            
            
            $conn -> close();
            
        }

    

?>