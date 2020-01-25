var frame,gframe;
;(function ($) {
    $(document).ready(function () {

        // show image for media
        var image_url = $('#upload_image_url').val();
        if(image_url){
            $('#upload_image_container').html(`<img src='${image_url}'/>`);
        }

        // show images for gallery
        var images_url = $('#upload_images_url').val();
        images_url = images_url ? images_url.split(";") : [];
        for (i in images_url){
            var _image_url = images_url[i];
            $('#upload_images_container').append(`<img src='${_image_url}'/>`);
        }


        $('#upload_image').on('click', function () {

            if(frame){
                frame.open();
                return false;
            }

            frame = wp.media({
                title: "Select Image",
                button: {
                    text: "Insert Image"
                },
                multiple: false
            });

            frame.on('select', function(){
               var attachment = frame.state().get('selection').first().toJSON();

               console.log(attachment);

               $('#upload_image_id').val(attachment.id);
               $('#upload_image_url').val(attachment.sizes.thumbnail.url);
               $('#upload_image_container').html(`<img alt="${attachment.title}" src='${attachment.sizes.thumbnail.url}'/>`);
            });

            frame.open();
            return false;
        });



        $('#upload_gallery').on('click', function () {

            if(gframe){
                gframe.open();
                return false;
            }

            gframe = wp.media({
                title: "Select Image",
                button: {
                    text: "Insert Image"
                },
                multiple: true
            });

            gframe.on('select', function(){
                var image_ids = [];
                var image_urls = [];
                var attachments = gframe.state().get('selection').toJSON();
                $("#upload_images_container").html('');
                for(i in attachments){
                    var attachment = attachments[i];
                    image_ids.push(attachment.id);
                    image_urls.push(attachment.sizes.thumbnail.url);
                    $("#upload_images_container").append(`<img class="gallery-image" src='${attachment.sizes.thumbnail.url}' />`);
                }
               console.log(image_ids,image_urls);

                $('#upload_images_id').val(image_ids.join(";"));
                $('#upload_images_url').val(image_urls.join(";"));
                // $('#upload_image_container').html(`<img alt="${attachments.title}" src='${attachments.sizes.thumbnail.url}'/>`);
            });

            gframe.open();
            return false;
        });

    });
})(jQuery);