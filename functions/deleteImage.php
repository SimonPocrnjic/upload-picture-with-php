<?php
    require('../server/connect.php');
    //delete image 
    if(isset($_POST['imageid'])){
        $imageid = $_POST['imageid'];

        $sqlname = "SELECT image_name
        FROM images
        WHERE id = ? LIMIT 1";

        //fetching the image full name by it's id 
        if($getimage = $myserver->prepare($sqlname)){  
            $getimage->bind_param('i', $imageid);
            $getimage->execute();
            $getimage->store_result();
            $getimage->bind_result($image);   
            $getimage->fetch();                     
        } else {
            die("does not work");
        }

        //preparing sql statement to delete image from database
        $sql = 'DELETE FROM images WHERE id = ?';
        if($stmt = $myserver->prepare($sql)){
            $stmt->bind_param('i', $imageid);

            //deleting image from images folder
            if(unlink("../images/$image")){
                $stmt->execute();
                $stmt->close();
                //redirect to main route 
                header('Location: '.url_route);
            } else {
                echo "something is wrong!";
                
            }
        } else {
            die("does not work");
        }
    }
?>