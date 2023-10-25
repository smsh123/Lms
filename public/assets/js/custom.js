var CustomFunctions = {
    uploadImage: function(id = '') {
        var imageInput = document.getElementById(id);
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
                alert(data.message);
            },
            error: function(msg) {
                console.log(msg);
                var errors = msg.responseJSON;
            }
        });
    }
};
