//globals 
var gallery = $('#gallery div.image_container');
var gallery_image = gallery.children('.image');

function previewPic(input) {
    if (input.files && input.files[0]) {
        var image = input.files[0];
        var imageType = image["type"];
        var name = image["name"];
        var ValidImageTypes = ["image/gif", "image/jpg", "image/jpeg", "image/png"];
        if ($.inArray(imageType, ValidImageTypes) < 0) {
            $('#error_file').text('Slika ni primernega formata.');

        } else {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
                $('#previewImage').attr('style', 'display:block');

                $('#previewImageSmall').attr('style', 'background-image:url(' + e.target.result + '); display:block; width:100%;');
                //$('#previewImageSmall').attr('style', 'display:block');
                imageHeight($('#previewImageSmall'));

                $('#uploadImg').next('label').text(name);
                $('#error_file').text('');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
}

function imageHeight(element) {
    element.css('height', function() { return $(this).width() });
}

$(window).on('resize', function() {
    imageHeight(gallery_image);
    imageHeight($('#previewImageSmall'));
});

$(function() {
    imageHeight(gallery_image);
    imageHeight($('#previewImageSmall'));

    $('input[type=file]').on('click', function() {
        $('#en-error').remove();
    });
});