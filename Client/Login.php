<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('../Control.php');
        include('../model_loading.php');
        $getdata = new data();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body style="background-color: #f0f2f5;">
    <div class="logo_form">
        <div class="main_logo_form">
            <div class="left_logo_form">
                <a href="#" onclick="load_Display('home_page.php',1000,1)">
                    <img src="https://vnibooks.com/wp-content/uploads/2022/01/logo-vnibooks-trang.svg" id="abc" alt="<trống>">
                </a>
                <span>
                    Hãy cùng chúng tôi đến với kho tàng kiến thức.
                </span>
            </div>
            <form id="form_login" method="post" class="right_logo_form">
                <div class="form-group input-group">
                    <span class="input-group-addon fa fa-user"></span>
                    <input type="text" name="txtusername" id="txtusername" class="form-control" placeholder="Tên tài khoản" />
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon fa fa-lock"></span>
                    <input type="password" name="txtpassword" id="txtpassword" class="form-control" placeholder="Mật khẩu" />
                    <button type="button" class="btn_eye_password fa fa-eye-slash" id="btn_eyepasslogin"></button>
                </div>
                <div class="form-group input-group">
                    <button type="button" id="button_login" class="form-control" formaction="data_pro_intermediary.php?form=login">Đăng nhập</button>
                </div>
                <div class="form-group input-group">
                    <a class="forget_password">Quên mật khẩu?</a>
                </div>
                <hr>
                <button type="button" id="open_form_register" class="button_register">Tạo tài khoản mới</button>
            </form>
        </div>
    </div>
    <div class="back_ground_register">
        <form id="form_register" method="post" class="register_form">
            <h1>Đăng ký</h1>
            <button type="button" id="close_form_register" class="button_close_form"><ion-icon name="close-outline"></ion-icon></button>
            <h4>Nhanh chóng và dễ dàng</h4>
            <hr>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" name="txtusername" id="txt_username" class="form-control" placeholder="Tên tài khoản" />
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="txtpassword" id="txt_password" class="form-control" placeholder="Mật khẩu" />
                <button type="button" class="btn_eye_password fa fa-eye-slash" id="btn_eyepassregister"></button>
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="txtre_password" id="txt_re_password" class="form-control" placeholder="Nhập lại mật khẩu" />
                <button type="button" class="btn_eye_password fa fa-eye-slash" id="btn_eyere_passregister"></button>
            </div>
            <div class="form-group input-group">
                <button type="button" id="button_register" formaction="data_pro_intermediary.php?form=register" class="button_register">Đăng ký</button>
            </div>
        </form>
        
        <script>
            $(document).ready(function () {
                $('#btn_back').click(function (e) { 
                    load_giaodien('thongtincanhan.php',1000,1);
                });

                $('#upset_password').click(function (e) { 
                    load_form('#next_form',1000,this);
                });
                $('.back_ground_register').hide();
                $('#open_form_register').click(function (event) { 
                    $('body').css('overflow', 'hidden');
                    $('.back_ground_register').show();
                });
                $('#close_form_register').click(function (e) { 
                    $('body').css('overflow-y', 'auto');
                    $('.back_ground_register').hide();
                });
                $('#txtusername').keyup(function(e){
                    if(e.keyCode===13){
                        $('#button_login').click();
                    }
                });
                $('#txt_password').keyup(function(e){
                    if(e.keyCode===13){
                        $('#button_login').click();
                    }
                });
                $('#button_login').click(function (e) { 
                    var username = $('#txtusername').val(), password =  $('#txtpassword').val();
                    if(username=="" || password==""){
                        messageBox('Chú ý','Tài khoản và mật khẩu không được bỏ trống.','warning',0,1000);
                    }else{
                        load_Form('#form_login',1000,this);
                    }
                });
                $('#txt_username').keyup(function(e){
                    if(e.keyCode===13){
                        $('#button_register').click();
                    }
                });
                $('#txt_password').keyup(function(e){
                    if(e.keyCode===13){
                        $('#button_register').click();
                    }
                });
                $('#txt_re_password').keyup(function(e){
                    if(e.keyCode===13){
                        $('#button_register').click();
                    }
                });
                $('#button_register').click(function (e) { 
                    var username = $('#txt_username').val(), password =  $('#txt_password').val(), re_password =  $('#txt_re_password').val();
                    if(username=="" || password=="" || re_password==""){
                        messageBox('Chú ý','Thông tin không được bỏ trống.','warning',0,1000);
                    }else if( password!=re_password ){
                        messageBox('Chú ý','Nhập lại mật khẩu không trùng khớp.','warning',0,1000);
                    }else{
                        load_Form('#form_register',1000,this);
                    }
                });
            });
        </script>
    </div>
</body>
<footer>
    <?php include('../bootstrap.php'); ?>
    <!-- <link rel="stylesheet" href="basic.css"> -->
</footer>
</html>