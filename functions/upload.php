<?php
    require('server/connect.php');
    //Directory where the image will be uploaded
  
    $target_dir = "images/";
    
    //if there are no errors 1 else 0
	$success = 1;

    //Error messages
	$upload_error = "";
    
    //Getting form request data
	if (isset($_FILES["image"], $_POST["title"]) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        //Form inputes must not be empty
		if(empty($_FILES["image"]["name"]) || empty($_POST['title'])){
			$upload_error = "<p class='error' id='en-error'>No form input should be empty!</p>";
		} else {
            //Saving data to a variable 
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $lastId = 0;
            $image_name = $_FILES["image"]["name"];
            $target_file   = $target_dir . basename($image_name);
            //File extension
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if ($check !== false) {
				$success = 1;
			} else {
				$upload_error ="<p class='error' id='en-error'>The file you are trying to upload is not a image!</p>";
				$success = 0;
            }
            /* 
            Getting the id of the last uploaded image 
            reason why we do this is to add the id to the new hashed image name
            */
			if($last = $myserver->prepare('SELECT id FROM images ORDER BY id DESC LIMIT 1')){
				$last->execute();
				$last->store_result();
				$last->bind_result($dbLastId);
				if($last->num_rows == 0){
					$lastId = 1;
				} else {
					$last->fetch();
					$lastId = $dbLastId + 1;
				}
				$last->close();
			} else {
				$upload_error ="<p class='error' id='en-error'>Server error!</p>";
				$success = 0;
			}
            //Checking if the image already exists by name
			if (file_exists($target_file)) {
				
				$upload_error ="<p class='error' id='en-error'>image already exists!</p>";
				$success = 0;
            }
            
            //Setting images size limit in bytes 
			if ($_FILES["image"]["size"] > 5000000) {
				
				$upload_error ="<p class='error' id='en-error'>File size to large!</p>";
				$success = 0;
			}
            //Checking if image format is jps, png, jpeg or gif
			if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif") {
				$upload_error ="<p class='error' id='en-error'>File type must be JPG, JPEG, PNG ali GIF.</p>";
				$success = 0;
			}
			
			//Limit of how many images can be uploaded

			if($nubofimg = $myserver->prepare('SELECT COUNT(*) FROM images')){
				$nubofimg->execute();
				$nubofimg->store_result();
				$nubofimg->bind_result($numOfImages);
				$nubofimg->fetch();
				if($numOfImages >= 9){
					$success = 0;
					$upload_error ="<p class='error' id='en-error'>Upload limit reached!</p>";
				}
				$nubofimg->close();

			} else {
				$upload_error ="<p class='error' id='en-error'>Server error!</p>";
				$success = 0;
			}
            
			if ($success == 0) {
				//do something
			} else {
                //Create new hashed name based on it's id
                $new_img_name = md5($lastId).".".$imageFileType;
                //Prepared statment inserting file data to database table images
				if($stmt = $myserver->prepare("INSERT INTO images (title, image_name, size) VALUES(?,?,?)")){
					$stmt->bind_param("ssd", $title, $new_img_name, $_FILES["image"]["size"]);
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$new_img_name)) {
						echo "<p style='color:green;'>image was successfully added.</p>";
						$stmt->execute();
                    	$stmt->close();
                        header('Location: '.url_route);
                    } else {
                        echo "Sorry, there was an error uploading your image.";
					}
					
				} else {
					$upload_error ="<p class='error' id='en-error'>Error uplaoding</p>";
				}
			}
		}
		unset($_FILES["image"]);
		unset($_POST["title"]);
	}
?>