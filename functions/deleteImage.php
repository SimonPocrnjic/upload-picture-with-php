<?php
    require('../server/connect.php');
    
    if(isset($_POST['imageid'])){
        $imageid = $_POST['imageid'];
        $sqlname = "SELECT image_name
        FROM images
        WHERE id = ? LIMIT 1";

        if($getimage = $myserver->prepare($sqlname)){  
            $getimage->bind_param('i', $imageid);
            $getimage->execute();
            $getimage->store_result();
            $getimage->bind_result($image);   
            $getimage->fetch();                     
        } else {
            die("does not work");
        }

        $sql = 'DELETE FROM images WHERE id = ?';
        if($stmt = $myserver->prepare($sql)){
            $stmt->bind_param('i', $imageid);
            $folder = "../images";
            //chown($folder,465);
            if(unlink("../images/$image")){
                $stmt->execute();
                $stmt->close();
                header('Location: '.url_route);
            } else {
                echo "something is wrong!";
                
            }
        } else {
            die("does not work");
        }
    }
?>