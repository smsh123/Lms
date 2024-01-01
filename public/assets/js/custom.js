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

    addToCart: function() {
        var user_full_name = $("#user_full_name");
        var user_mobile = $("#user_mobile");
        var user_email = $("#user_email");
        var state = $("#state");
        var city = $("#city");
        var product_type = $("#product_type");
        var product_name = $("#product_name");
        var product_id= $("#product_id");
        var price = $("#price");
        var amount = $("#amount");
        var status = $("#status");
        var referrer = $("#referrer");

        function validateForm(){
            if(user_full_name.val() === null || user_full_name.val() === ''){
                alert("Enter Full Name First");
                return false;
            }else if(user_mobile.val() === null || user_mobile.val() === ''){
                alert("Enter Mobile First");
                return false;
            }else if(user_email.val() === null || user_email.val() === ''){
                alert("Enter Email First");
                return false;
            }else if(state.val() === null || state.val() === ''){
                alert("Enter State First");
                return false;
            }else if(city.val() === null || city.val()=== ''){
                alert("Enter City First");
                return false;
            }else if(product_type.val() === null || product_type.val() === ''){
                alert("Something went wrong with product type");
                return false;
            }else if(product_name.val() === null || product_name.val() === ''){
                alert("Something went wrong with product name");
                return false;
            }else if(product_id.val() === null || product_id.val() === ''){
                alert("Something went wrong with product id");
                return false;
            }else if(price.val() === null || price.val() === ''){
                alert("Something went wrong with Price");
                return false;
            }else if(amount.val() === null || amount.val() === ''){
                alert("Something went wrong with Total Amount");
                return false;
            }else if(status.val() === null || status.val() === ''){
                alert("Something went wrong with status");
                return false;
            }else if(referrer.val() === null || referrer.val() === ''){
                alert("Something went wrong with referer");
                return false;
            }else{
                return true;
            }
        }

        var validateForm = validateForm();

    
    
    if(validateForm){

        var form = new FormData();
        form.append("user_full_name", user_full_name.val());
        form.append("user_mobile", user_mobile.val());
        form.append("user_email", user_email.val());
        form.append("state", state.val());
        form.append("city", city.val());
        form.append("product_type", product_type.val());
        form.append("product_name", product_name.val());
        form.append("product_id", product_id.val());
        form.append("price", price.val());
        form.append("amount", amount.val());
        form.append("status", status.val());
        form.append("referrer", referrer.val());

        var leads = new FormData();
        leads.append("name", user_full_name.val());
        leads.append("email", user_email.val());
        leads.append("mobile", user_mobile.val());
        leads.append("course_interested", product_name.val());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/orders/store', 
            type: 'POST',
            processData: false,
            contentType: false,
            data: form,
            success: function(data) {
                console.log(data);
                $("#saved_order_id").val(data.saved_order._id);
                $("#cart_step_1").slideUp();
                $("#cart_step_2").slideDown();
                $('input[name="payment_method"]').val('razorPay');
                $('input[name="orderId"]').val(data.saved_order._id);
                $(".btn_checkout").show();
            },
            error: function(msg) {
                console.log(msg);
                var errors = msg.responseJSON;
            }
        });

        $.ajax({
            url: '/leads/store', 
            type: 'POST',
            processData: false,
            contentType: false,
            data: leads,
            success: function(data) {
                console.log(data);
            },
            error: function(msg) {
                console.log(msg);
                var errors = msg.responseJSON;
            }
        });

    }

    },

    applyCoupon: function(){
        var coupon_code = $("#coupon_input").val();
        var order_id = $("#saved_order_id").val();
       
        if (coupon_code =='' || coupon_code=='undefined') {
            alert('Please enter coupon code.');
            return;
        }
        if (order_id =='' || order_id=='undefined') {
            alert('Create order first.');
            return;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var form = new FormData();
        form.append("orderId", order_id);

        $.ajax({
            url: '/apply-coupon/'+coupon_code, 
            type: 'POST',
            processData: false,
            contentType: false,
            data: form,
            success: function(data) {
                console.log(data);
                $("#coupon_btn").text(data.status);
                $("#coupon_input").prop('readonly',true);
                $("#coupon_input").prop('disabled','disabled');
                $("#coupon_msg").text(data.display_msg);
                $("#coupon_msg").addClass("text-success font-weight-bold");
                $("#coupon_msg").removeClass("text-danger");
                $(".btn_checkout").show();
            },
            error: function(msg) {
                console.log(msg);
                var errors = msg.responseJSON;
                $("#coupon_msg").text("Something went wrong");
                $("#coupon_msg").addClass("text-danger font-weight-bold");
                $("#coupon_msg").addClass("text-success");
            }
        });

    },


    getCourseModule: function(selectId = '',target_input_id = '',target_id_val=''){
        var courseId = $("#"+selectId).find('option:selected').attr('data-id');
        $("#"+target_id_val).val(courseId);
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

    getCourseSubModule: function(selectId = '',target_input_id = '',target_id_val=''){
        var moduleId = $("#"+selectId).find('option:selected').attr('data-id');
        $("#"+target_id_val).val(moduleId);
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

function selectTeacher(selectId = '',target_id_val=''){
    var teacherId = $("#"+selectId).find('option:selected').attr('data-id');
    $("#"+target_id_val).val(teacherId);
}
