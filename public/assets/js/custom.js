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
    },

    getCourseModule: function(selectId = '',target_input_id = ''){
        var courseSelected = document.getElementById(selectId);
        //var courseId = courseSelected.getAttribute("data-id");
        var courseId = $("#"+selectId).find('option:selected').attr('data-id');
        var target_input = document.getElementById(target_input_id);
        $("#"+target_input_id).empty();
        //alert(courseId);
        if (courseId =='' || courseId=='undefined') {
            alert('Please select a course first.');
            return;
        }
      //  var form = new FormData();
       // form.append("courseId", courseId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/get-course-module?courseId='+courseId, 
            type: 'GET',
            processData: false,
            contentType: false,
           // data: form,
            success: function(data) {
                console.log(data);
                if(data != ''){
                    console.log(data[0].modules);
                    option ='<option>Select Module</option>';
                    for(let i = 0; i < data[0].modules.length; i++){
                       option += '<option data-id='+data[0].modules[i].moduleId+'>'+data[0].modules[i].moduleName+'</option>';
                    }
                   // console.log(option);
                    $("#"+target_input_id).append(option);
                }
            },
            error: function(msg) {
                console.log(msg);
                var errors = msg.responseJSON;
            }
        });

    },

    getCourseSubModule: function(selectId = '',target_input_id = ''){
        var moduleId = $("#"+selectId).find('option:selected').attr('data-id');
        var target_input = document.getElementById(target_input_id);
        $("#"+target_input_id).empty();
        //alert(moduleId);
        if (moduleId =='' || moduleId=='undefined') {
            alert('Please select a course first.');
            return;
        }
      //  var form = new FormData();
       // form.append("moduleId", moduleId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/get-course-submodule?moduleId='+moduleId, 
            type: 'GET',
            processData: false,
            contentType: false,
           // data: form,
            success: function(data) {
                console.log(data);
                if(data != ''){
                    console.log(data[0].items);
                    option ='<option>Select SubModule</option>';
                    for(let i = 0; i < data[0].items.length; i++){
                       option += '<option>'+data[0].items[i].title+'</option>';
                    }
                   // console.log(option);
                    $("#"+target_input_id).append(option);
                }
            },
            error: function(msg) {
                console.log(msg);
                var errors = msg.responseJSON;
            }
        });

    }

};
