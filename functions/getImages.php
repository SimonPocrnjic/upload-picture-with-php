<?php 
    

    $images = [];
    $image_folder_url = url_route.'images/';

    if($stmt = $myserver->prepare("SELECT * FROM images ORDER BY id DESC"))
    {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $title, $image_name, $size);

        if($stmt->num_rows > 0){
            while($stmt->fetch()){
                array_push($images, array(
                    'id' => $id, 
                    'title' => $title, 
                    'image' => $image_name, 
                    'size' => $size, 
                ));
            }
        }
        $stmt->close();
    }