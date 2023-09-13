<!-- <link rel="stylesheet" href="../Bootstrap/css/bootstrap-fileupload.min.css"> -->

<!-- <link rel="stylesheet" href="../Bootstrap/css/bootstrap-social.css"> -->

<link rel="stylesheet" href="../Bootstrap/css/custom.css">

<link rel="stylesheet" href="../Bootstrap/css/bootstrap.css">

<link rel="stylesheet" href="../Bootstrap/css/font-awesome.css">

<!-- <link rel="stylesheet" href="../Bootstrap/css/error.css"> -->

<!-- <link rel="stylesheet" href="../Bootstrap/css/invoice.css"> -->

<!-- <link rel="stylesheet" href="../Bootstrap/css/prettyPhoto.css"> -->

<!-- <link rel="stylesheet" href="../Bootstrap/css/pricing.css"> -->

<!-- <link rel="stylesheet" href="../Bootstrap/css/wizard/jquery.steps.css"> -->

<!-- <link rel="stylesheet" href="../Bootstrap/css/wizard/normalize.css"> -->

<!-- <link rel="stylesheet" href="../Bootstrap/css/wizard/wizardMain.css"> -->

<!-- <script src="../Bootstrap/js/bootstrap-fileupload.js"></script> -->

<script src="../Bootstrap/js/bootstrap.js"></script>

<script src="../Bootstrap/js/custom.js"></script>

<!-- <script src="../Bootstrap/js/galleryCustom.js"></script> -->

<!-- <script src="../Bootstrap/js/jquery-1.10.2.js"></script> -->

<!-- <script src="../Bootstrap/js/jquery.metisMenu.js"></script> -->

<!-- <script src="../Bootstrap/js/jquery.mixitup.min.js"></script> -->

<!-- <script src="../Bootstrap/js/jquery.prettyPhoto.js"></script> -->

<!-- <script src="../Bootstrap/js/wizard/jquery.cookie-1.3.1.js"></script> -->

<!-- <script src="../Bootstrap/js/wizard/"></script> -->

<!-- <script src="../Bootstrap/js/wizard/modernizr-2.6.2.min.js"></script> -->

<script>
    const eye_password = document.querySelectorAll(".btn_eye_password");
    $('.btn_eye_password').css('color','#ccc');
    eye_password.forEach(function(button,index){
        button.addEventListener("click", function(e){
            var btnItem = e.target;
            var box_password = btnItem.parentElement;
            var id_input = box_password.querySelector("input").id;
            var id_button = button.id;
            var class_listbutn = button.classList;
            class_listbutn.forEach(function(element){
                if(element == 'fa-eye-slash'){
                    $('#'+id_button).removeClass('fa-eye-slash'); 
                    $('#'+id_button).addClass('fa-eye');
                    $('#'+id_button).css('color','#555'); 
                    $('#'+id_input).attr('type', 'text');
                }
                if(element == 'fa-eye'){
                    $('#'+id_button).removeClass('fa-eye'); 
                    $('#'+id_button).addClass('fa-eye-slash');
                    $('#'+id_button).css('color','#ccc'); 
                    $('#'+id_input).attr('type', 'password');
                }
            });
        });
    });

    $('#zoom_img_all').hide();
    const image_link = document.querySelectorAll("img");
    image_link.forEach(function(button,index){
        button.addEventListener("click", function(e){
            var id_img = button.id;
            var img_src = $('#'+id_img).attr('src');
            $('#zoom_img_all').show();
            $('body').css('overflow-y', 'hidden');
            setTimeout(()=>{
                $('#zoom_img_all img').css({ 'max-width': '100%','max-height': '100%',});
                $('#zoom_img_all img').attr('src', img_src);
            },1000);
        });
    });
    
    $('#zoom_img_all').click(function (e) { 
        $('#zoom_img_all').hide();
        $('body').css('overflow-y', 'auto');
        $('#zoom_img_all img').attr('src', '../images/images_display/loader.gif');
    });
</script>
<style>
 /* nền trình duyệt */
*{
    margin: 0;
    padding: 0;
    outline: none;
}

*::-webkit-scrollbar {
    width: 5px;
    background-color: #F5F5F5;
}

*::-webkit-scrollbar-thumb {
    background-color: #929090;
}

*::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(148, 146, 146, 0.3);
    background-color: #F5F5F5;
}

/* model loading back-ground */
.image_zoom_all{
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    margin: 0;
    background-color: rgba(43, 38, 38, 0.795);
    z-index: 1000;
}

.image_zoom_all img{
    min-width: 50px;
    min-height: 50px;
    max-width: 100%;
    max-height: 100%;
    padding: 0 !important;
    margin: 0 !important;
}

/* login form */
.logo_form{
    width: 100%;
    height: auto;
    text-align: center;
}

.logo_form .main_logo_form{
    margin: auto;
    padding-top: 20px;
}

.main_logo_form .left_logo_form{
    max-width: 600px;
    height: auto;
    margin: auto;
}

.main_logo_form .left_logo_form img{
    width: 600px;
    height: auto;
    background-color: red;
    border-radius: 25px;
    float: left;
}

.main_logo_form .left_logo_form span{
    max-width: 600px;
    height: auto;
    font-size: 24px;
}

.main_logo_form .right_logo_form{
    width: 600px;
    height: auto;
    border: 1px solid;
    border-radius: 15px;
    background-color: #fff;
    margin: auto;
}

.main_logo_form .right_logo_form .form-group{
    width: 100%;
    height: 50px;
    padding: 0 5%;
    margin-top: 25px;
    display: flex !important; 
    justify-content: space-between;
    align-items: center;
}

.main_logo_form .right_logo_form .form-group span{
    width: 10% !important;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main_logo_form .right_logo_form .form-group input{
    width: 90% !important;
    height: 50px;
    border: 1px solid #ccc;
    padding: 10px;
    color: #555;
    border-radius: 0 5px 5px 0 !important;
}

.main_logo_form .right_logo_form .form-group button{
    width: 100% ;
    height: 100%;
    background-color: #1877f2;
    border-radius: 5px;
    font-size: 24px;
    color: #fff;
}

.btn_eye_password{
    position: absolute !important;
    width: 10% !important;
    height: 50px;
    border: none;
    padding: 10px;
    right: 5%;
    background-color: unset !important;
    z-index: 5;
}

.input-group-addon:not(:first-child):not(:last-child), .input-group-btn:not(:first-child):not(:last-child), .input-group .form-control:not(:first-child):not(:last-child) {
    border-radius: 0 5px 5px 0 !important;
}

.main_logo_form .right_logo_form .form-group a{
    width: 100%;
    height: 100%;
    font-size: 24px;
}

.main_logo_form .right_logo_form hr{
    width: 90%;
    height: 1px;
    background-color: rgb(179, 165, 165);
    margin: -15px auto;
    margin-bottom: 10px;
}

.forget_password{
    font-size: 18px;
    margin: 0 30%;
}

.main_logo_form .right_logo_form  .button_register{
    min-width: 100px;
    width: 60%;
    min-height: 50px;
    background-color: #42b72a;
    border-radius: 5px;
    font-size: 24px;
    color: #fff;
    border: none;
    margin-bottom: 10px;
}

/* register_form */
.back_ground_register{
    width: 100%;
    height: 100%;
    position: fixed;
    padding-top: 50px;
    overflow-y: auto;
    z-index: 5;
    background-color: #e2e2e2ec;
    overflow-y: auto !important;
    top: 0;
}

.register_form{
    width: 500px;
    height: auto;
    background-color: #fff;
    margin: auto;
    border: 1px solid;
    border-radius: 15px;
}

.register_form h1{
    width: 85%;
    margin-left: 5%;
    font-weight: bold;
    float: left;
}

.register_form h4{
    width: 95%;
    margin-left: 5%;
    float: left;
}

.register_form hr{
    width: 100%;
}

.button_close_form{
    max-width: 10%;
    height: auto;
    position: relative;
    border: none;
    background-color: unset;
    font-size: 30px;
    top: 0;
    right: 0;
}

.register_form .form-group{
    width: 100%;
    height: 50px;
    padding: 0 5%;
    margin-top: 25px;
}

.register_form .form-group input{
    width: 100%;
    height: 100%;
}

.register_form .form-group span{
    width: 40px;
}

.register_form  .button_register{
    width: 60%;
    min-height: 50px;
    background-color: #42b72a;
    border-radius: 5px;
    font-size: 24px;
    color: #fff;
    margin: -10px 20%;
    border: none;
}

@media (min-width: 1350px){
    .logo_form .main_logo_form{
        width: 1350px;
        display: flex;
        padding-top: 50px;
    }

    .main_logo_form .left_logo_form{
        max-width: 600px;
        height: auto;
        margin: 0 auto;
        float: left;
    }
    .main_logo_form .right_logo_form{
        width: 600px;
        height: auto;
        float: left;
    }
}

/* home_page */
.header{
    width: 100%;
    height: 110px;
    position: fixed;
    z-index: 2;
}
.header_main{
    width: 100%;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.header_main a{
    width: 200px;
    height: 100%;
}
.header_main a img{
    width: 100%;
    height: 100%;
    padding: 15px;
}
.header_main .header_main_box_search{
    width: 800px;
    height: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    color: #fff;
}
.header_main .header_main_box_search input{
    width: 80%;
    height: 100%;
    background-color: rgba(255,255,255,.2);
    padding: 5px 0 5px 15px;
    border: none;
    border-radius: 15px 0 0 15px;
}
.header_main .header_main_box_search input::placeholder { 
    color: #fff !important;
    opacity: 1; 
}

.header_main .header_main_box_search input:-ms-input-placeholder { 
    color: #fff !important;
}

.header_main .header_main_box_search input::-ms-input-placeholder { 
    color: #fff !important;
}

.header_main .header_main_box_search button{
    width: 10%;
    height: 100%;
    background-color: rgba(255,255,255,.2);
    border-radius: 0 15px 15px 0;
    border: none;
}

.header_main .header_main_box_user, .header_main .header_main_box_user_none{
    width: 200px;
    height: 100%;
    display: flex;
    justify-content: space-around;
    align-items: center;
    color: #fff;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold;
}
.header_main .header_main_box_user_none a{
    width: 150px;
    height: 60%;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    color: #fff;
    background-color: gold !important;
    border-radius: 15px;
}
.header_main .header_main_box_user_none a:hover{
    color: blue;
}
.header_main .header_main_box_user_none a span{
    font-size: 22px;
    margin-right: 5px;
}
.header_main .header_main_box_user{
    width: 300px;
    justify-content: flex-end !important;
    
}
.header_main .header_main_box_user .header_main_box_user_menu{
    width: 50px;
    height: 80%;
    margin: 0 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 50%;
    background-color: unset;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    background-color: grey;
    z-index: 2;
}
.header_main .header_main_box_user .header_main_box_user_listfunction{
    width: 300px;
    max-height: 300px;
    background-color: #fff;
    position: absolute;
    border-radius: 5px;
    box-shadow: 0 0 0 1px gainsboro;
    top: 55px;
}
.header_main .header_main_box_user .header_main_box_user_listfunction ul{
    width: 100%;
    max-height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    padding: 5px;
}
.header_main .header_main_box_user .header_main_box_user_listfunction ul li{
    width: 100%;
    min-height: 50px;
    padding: 10px;
    color: aqua;
}
.header_main .header_main_box_user .header_main_box_user_listfunction ul li a{
    text-decoration: none;
    text-transform: none;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    float: left;
}
.header_main .header_main_box_user .header_main_box_user_listfunction ul li a span{
    font-size: 24px;
}
.header_main .header_main_box_user .header_main_box_user_listfunction ul li:hover{
    background-color: aqua;
}
.header_main .header_main_box_user .header_main_box_user_listfunction ul li:hover >a{
    color: #929090;
}
.header_main .header_main_box_user .header_main_box_user_menu img{
    width: 100%;
    height: 100%;
    border-radius: 50%;
}
.header_bottom{
    width: 100%;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff;
}
.header_bottom .button_model_menu{
    margin-right: 200px;
}
.header_bottom button{
    border: none;
    background-color: unset;
}
.header_bottom .menu_show{
    width: 1000px;
    height: 50%;
}
.header_bottom .menu_show ul{
    width: 100%;
    height: 100%;
    display: none;
    align-items: center;
    justify-content: space-around;
}
.header_bottom .menu_show ul li{
    list-style: none;
}
.header_bottom .menu_show ul li a{
    text-decoration: none;
    /* text-transform: uppercase; */
    font-size: 18px;
    color: black;
}
.header_bottom .menu_show ul li:hover > a{
    color: aqua;
}
.show_menu{
    display: flex !important;
}
</style>