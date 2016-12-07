/**
 * Created by TP on 11/19/2016.
 */
var baseurl = window.location.origin+'/drugstore/frontend/web/';


$(window).load (function(){
    //$('#c_phone_call').hide();
    $('#c_phone_call_footer').hide();
    $('#c_phone_call_contact').hide();
    //$('#cc_phone_call').hide();
    $('#cc_phone_call_footer').hide();
    $('#cc_phone_call_contact').hide();
    $('#do_action_tp').hide();
    $('#c_name').hide();
    $('#c_address').hide();
    $('#c_number').hide();
    $('#c_phone').hide();
    $('#cc_phone').hide();
    $('#c_validate').hide();
    $('#cc_number').hide();
});

jQuery(document).ready(function(){
    $('#checked').bind('change',function(){
        if($(this).is(':checked')){
            $("#fullName").val($("#full_name").val());
            $("#userEmail").val($("#user_email").val());
            $("#userPhone").val($("#user_phone").val());
            $("#userAdress").val($("#user_adress").val());
        }
        else
        {
            $("#fullName").val("");
            $("#userEmail").val("");
            $("#userPhone").val("");
            $("#userAdress").val("");
        }
    });
});

$(document).ready(function(){
    $('#btn_tp').click(function(){
        if($('#phone_ddd').val().trim() == ""){
            alert('Không được để trống số điện thoại');
        }else if(validatePhone($('#phone_ddd').val())== false){
            alert('Số điện thoại không hợp lệ');
        }else {
            url = baseurl + 'product/save-sub';
            var phone = $('#phone_ddd').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    phone:phone,
                },
                success: function(data) {
                    var rs = JSON.parse(data);
                    if (rs['success']) {
                        alert(rs['message']);
                    }else {
                        alert(rs['message']);
                    }
                }
            });
        }
    });

    $('#phone_footer').focusout(function(){
        if(($(this).val().trim() == null || $(this).val().trim() == "")){
            $('#c_phone_call_footer').show();
            $(this).focus();
        }else{
            $('#c_phone_call_footer').hide();
            if(validatePhone($(this).val())== false){
                $('#cc_phone_call_footer').show();
            }else{
                $('#cc_phone_call_footer').hide();
            }
        }
    });

    $('#bt_footer').click(function(){
        if($('#phone_footer').val().trim() == ""){
            $('#c_phone_call_footer').show();
        }else {
            url = baseurl + 'product/save-sub';
            var phone = $('#phone_footer').val();
            var name = $('#name_footer').val();
            var message = $('#message_footer').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    phone:phone,
                    name:name,
                    message:message
                },
                success: function(data) {
                    var rs = JSON.parse(data);
                    if (rs['success']) {
                        alert(rs['message']);
                    }else {
                        alert(rs['message']);
                    }
                }
            });
        }
    });

    $('#phone_contact').focusout(function(){
        if(($(this).val().trim() == null || $(this).val().trim() == "")){
            $('#c_phone_call_contact').show();
            $(this).focus();
        }else{
            $('#c_phone_call_contact').hide();
            if(validatePhone($(this).val())== false){
                $('#cc_phone_call_contact').show();
            }else{
                $('#cc_phone_call_contact').hide();
            }
        }
    });

    $('#bt_contact').click(function(){
        if($('#phone_contact').val().trim() == ""){
            $('#c_phone_call_contact').show();
        }else {
            url = baseurl + 'product/save-sub';
            var phone = $('#phone_contact').val();
            var name = $('#name_contact').val();
            var message = $('#message_contact').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    phone:phone,
                    name:name,
                    message:message
                },
                success: function(data) {
                    var rs = JSON.parse(data);
                    if (rs['success']) {
                        alert(rs['message']);
                    }else {
                        alert(rs['message']);
                    }
                }
            });
        }
    });

    $('#name').focusout(function(){
        if(($(this).val().trim() == null || $(this).val().trim() == "")){
            $('#c_name').show();
            $(this).focus();
        }else{
            $('#c_name').hide();
        }
    });
    $('#phone').focusout(function(){
        if(($(this).val().trim() == null || $(this).val().trim() == "")){
            $('#c_phone').show();
            $('#cc_phone').hide();
            $(this).focus();
        }else{
            $('#c_phone').hide();
            if(validatePhone($(this).val())== false){
                $('#cc_phone').show();
            }else{
                $('#cc_phone').hide();
            }
        }
    });

    $('#address').focusout(function(){
        if(($(this).val().trim() == null || $(this).val().trim() == "")){
            $('#c_address').show();
            $(this).focus();
        }else{
            $('#c_address').hide();
        }
    });

    $('#btn').click(function(){
        if($('#name').val().trim() == "" || $('#phone').val().trim() == "" || $('#address').val().trim() == ""){
            $('#c_validate').show();
        }else{
            var name = $('#name').val();
            var phone = $('#phone').val();
            var id_product = $('#id_product').val();
            var number = $('#number').val();
            var address = $('#address').val();
            var state = $('#state').val();
            $.ajax({
                type: "POST",
                url: baseurl+'product/save-buy',
                data: {
                    name:name,
                    phone:phone,
                    id_product:id_product,
                    number:number,
                    address:address,
                    state:state
                },
                success: function(data) {
                    var rs = JSON.parse(data);
                    if (rs['success']) {
                        alert(rs['message']);
                        location.href= baseurl+'site/index';
                    }else {
                        alert(rs['message']);
                    }
                }
            });
        }
    });
});

function getSearch(){
    key = $("#key_search" ).val();
    window.location.href=baseurl+'product/search?key='+key;
}

function validatePhone(txtPhone) {
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    if (!filter.test(txtPhone)) {
        return false;
    }else {
        return true;
    }
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
        return false;
    }else{
        return true;
    }
}

function addCart(id){
    //price = $("#product_price").text();
    //$("#price_product").text(price);
    //name = $("#product_name").text();
    //$("#name_product").text(name);
    //imgSource = $("#product_image").attr("src");
    //$("#image_product").attr({
    //    "src":imgSource
    //});
    $.get(baseurl +'product/add-cart',{'id' :id},function(data){
        val = data.split("<pre>");
        $("#amount").text(val[1]);
        alert('Đã thêm sản phẩm vào giỏ hàng thành công');
        //$('#modal_show').modal('show');
    });
}

function updateCart(id){
    //alert(id);
    amount = $("#amount_" + id).val();
    $.get(baseurl +'product/update-cart',{'id' :id,'amount' :amount},function(data){
        val = data.split("<pre>");
        if(val[1] == 0){
            if(confirm('Bạn chắc chắn muốn xóa sản phẩm này')==true){
                $.get(baseurl +'product/del-cart',{'id' :id},function(data){
                    val = data.split("<pre>");
                    $("#amount").text(val[1]);
                    window.location.href=baseurl+'product/list-my-cart';
                });
            }
        }else{
            $("#amount").text(val[1]);
            window.location.href=baseurl+'product/list-my-cart';
        }
    });
}


function subtraction(id){
    amount = $("#amount_" + id).val();
    amount_new = Number(amount)-Number(1);
    if(amount_new == 0){
        if(confirm('Bạn chắc chắn muốn xóa sản phẩm này')==true){
            $.get(baseurl +'product/del-cart',{'id' :id},function(data){
                val = data.split("<pre>");
                $("#amount").text(val[1]);
                window.location.href=baseurl+'product/list-my-cart';
            });
        }else{
            window.location.href=baseurl+'product/list-my-cart';
        }
    }else{
        $.get(baseurl +'product/update-cart',{'id' :id,'amount' :amount_new},function(data){
            val = data.split("<pre>");
            $("#amount").text(val[1]);
            window.location.href=baseurl+'product/list-my-cart';
        });
    }
}

function addition(id){
    amount = $("#amount_" + id).val();
    amount_new = Number(amount) + Number(1);
    $.get(baseurl +'product/update-cart',{'id' :id,'amount' :amount_new},function(data){
        val = data.split("<pre>");
        $("#amount").text(val[1]);
        window.location.href=baseurl+'product/list-my-cart';
    });
}

function delCart(id){
    if(confirm('Bạn chắc chắn muốn xóa sản phẩm này')==true){
        $.get(baseurl +'product/del-cart',{'id' :id},function(data){
            val = data.split("<pre>");
            $("#amount").text(val[1]);
            window.location.href=baseurl+'product/list-my-cart';
        });
    }
}

function inPutInfo(){
    $('#do_action_tp').show( "slow");
}

window.fbAsyncInit = function() {
    FB.init({
        appId      : '860437614060495',
        xfbml      : true,
        version    : 'v2.6'
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

