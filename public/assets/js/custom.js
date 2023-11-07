var CustomFunctions = {
    uploadImage: function(id = '',target_input = '', target_image = '') {
        var imageInput = document.getElementById(id);
        var target_input = document.getElementById(target_input);
        var target_image = document.getElementById(target_image);
        if (imageInput.files.length === 0) {
            alert('Please select an image to upload.');
            return;
        }

        var form = new FormData();
        form.append("image", imageInput.files[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/image-upload-post', 
            type: 'POST',
            processData: false,
            contentType: false,
            data: form,
            success: function(data) {
                console.log(data);
                if (target_input != 0) {
                    target_input.value=data.image;
                }
                if (target_image != 0) {
                    target_image.src=data.image;
                }
                alert(data.message);
            },
            error: function(msg) {
                console.log(msg);
                var errors = msg.responseJSON;
            }
        });
    }
};
