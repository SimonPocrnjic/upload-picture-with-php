<?php
    require('functions/upload.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <header>
        <div class="jumbotron bg-info text-white pt-3 pb-3">
           <div class="container p-0">
                <h4>Upload Image Example</h4>
           </div>
        </div>
    </header>
    <div class="container">
        <div class="row justify-content-between">
            <form class="col-md-5 p-0" method="POST" action="" enctype="multipart/form-data" id="upload_img">
                <div class="form-group">
                    <input type="file" class="custom-file-input" onchange="previewPic(this);" id="uploadImg" name="image">
                    <label class="custom-file-label text-left" for="uploadImg">Choose file</label>
                    <p class="error" id="error_file"></p>
                    <?php
                        echo $upload_error; 
                    ?>
                </div>
                <div class="form-group">
                    <label for="ime">Title</label>
                    <input class="form-control" type="text" name="title" id="">
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
                <div class="form-group">
                    <p class="mt-3">Preview</p>
                    <div class="row mt-2">
                        <div class="col-8">
                            <p>Big Image:</p>
                            <img id="previewImage" width="100%" style="background:#D3D3D3; height:300px;">
                        </div>
                        <div class="col-4">
                            <p>Small Image:</p>
                            <!--img id="previewImageSmall" src="#" width="100%" style="display:none;"-->
                            <div class="image" id="previewImageSmall" style="background:#D3D3D3; width:100%;"></div>
                        </div>
                        
                    </div>
                </div>
            </form>
           <div class="col-md-5 p-0">
                <?php
                    include('functions/getImages.php');
                ?>
                <p>Gallery</p>
                <div class="row" id="gallery">
                    <?php foreach($images as $image): ?>
                    <div class="col-6 col-sm-4 image_container">
                        <div class="image border" style="background-image: url(<?php echo 'images/'.$image['image'] ?>); width:100%; margin-bottom:30px;">
                            <form method="POST" action="functions/deleteImage.php">
                                <input type="hidden" name="imageid" value="<?php echo $image['id'] ?>">
                                <input type="submit" class="delete" title="Delete Image" style="cursor:pointer" value="X">
                            </form>
                            <a href="#" style="display:block; height:100%; width:100%; cursor: zoom-in;" title="<?php echo $image['title'] ?>" data-toggle='modal' data-target='<?php echo '#image'.$image['id'] ?>'></a>
                        </div>
                    </div>
                    <div class="modal fade" id="<?php echo 'image'.$image['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <button type="button" style="background-color:white; padding:.5rem; position:absolute; top:0; right:0; z-index:1000;" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <img src="<?php echo 'images/'.$image['image'] ?>" alt="<?php echo $image['title'] ?>" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
           </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
</body>
</html>