<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('../control.php');
        include('../model_loading.php');
        $cookie_username = !empty($_COOKIE['username'])?$_COOKIE['username']:"";
        $username = !empty($_SESSION['username'])?$_SESSION['username']:$cookie_username;

        if($username!=""){
            $account = new account();
            $account->setAccount($username);
        }

        $category = new category();
        $all_category = $category->loadAllcategory();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vnibooks-Kho tàng tri thức</title>
</head>
<body>
    <div id="top" class="header">
        <div class="header_main" style="background-color: red;">
            <a href="#" onclick="load_Display('home_page.php',1000,1)" class="header_logo" >
                <img src="../images/images_display/logo-vnibooks-trang.svg"  alt="">
            </a>

            <form method="post" id="next_form" class="header_main_box_search" action="library.php">
                <input type="text" id="txtsearch_product" name="txtsearch_product" value="<?php echo(!empty($_POST['txtsearch_product']))?$_POST['txtsearch_product']:"" ?>"
                    title="Chuỗi tìm kiếm không bao gồm kí tự đặc biệt" placeholder="Tìm kiếm...."></input>
                <button type="button" id="header_main_box_search_button" class="fa fa-search"></button>
            </form>
            <?php
                if($username==""){
            ?>
                <div class="header_main_box_user_none">
                    <a href="#" onclick="load_Display('Login.php',1000,1)"><span class="fa fa-sign-in"></span> đăng nhập </a>
                </div>
            <?php
                }else{
            ?>
                <div class="header_main_box_user">    
                    <button type="button" class="header_main_box_user_menu fa fa-bell"></button>
                    <button type="button" class="header_main_box_user_menu" id="open_user_menu">
                        <img src="../images/images_client/avt_incognito.gif" alt="">
                    </button>
                    <div class="header_main_box_user_listfunction" id="user_menu">
                        <ul>
                            <li><a href="#"><span class="fa fa-user"> Thông tin cá nhân</span></a></li>
                            <li><a href="#"><span class="fa fa-dollar"> Ví tiền: </span>100000VNĐ</a></li>
                            <li><a href="#"><span class="fa fa-shopping-cart"> Giỏ hàng</span></a></li>
                            <li><a href="#"><span class="fa fa-history"> Lịch sử mua hàng</span></a></li>
                            <li><a href="#" onclick="load_Display('data_pro_intermediary.php?form=logout',1000,1)"><span class="fa fa-sign-out"> Đăng xuất</span></a></li>
                        </ul>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
        <nav class="header_bottom">
            <button type="button" id="open_model_menu" class="button_model_menu fa fa-bars fa-2x"></button>
            
            <button id="button_prev_listcategory" class="fa fa-angle-left fa-2x" type="button" title="các danh mục trước đó"></button>
            <div class="menu_show">
                <?php
                    for( $i=0; $i < ceil($all_category->num_rows/5); $i++ ){
                        $index_category = 1;
                ?>
                    <ul class="menu_item" id="menu<?php echo$i ?>">
                        <?php
                            foreach($all_category as $category_item){
                                if($index_category>($i*5) && $index_category<=(($i+1)*5)){
                                    $category->setCategory($category_item);
                        ?>
                                <li><a href="#" onclick="load_Display('library.php?category=<?php echo$category->getID() ?>',1000,1)"><?php echo$category->getNamecategory() ?></a></li>
                        <?php
                                }
                                $index_category++;
                            }
                        ?>
                    </ul>
                <?php
                    }
                ?>
            </div>
            <button id="button_next_listcategory" class="fa fa-angle-right fa-2x" type="button" title="các danh mục kế tiếp"></button>
        </nav>
        <script>
            $('#menu0').addClass('show_menu');
            const all_menu_show = document.querySelectorAll('.menu_item').length;
            load_button('#button_prev_listcategory','hide');
            if(all_menu_show<=1){
                load_button('#button_next_listcategory','hide');
            }
            function load_button(id_button,load){
                if (load=='show') {
                    $(id_button).prop('disabled',false);
                    $(id_button).css('color','black');
                }else if (load=='hide'){
                    $(id_button).prop('disabled',true);
                    $(id_button).css('color','gray');
                }
            }
            function click_button(id_button,local_id_button,compare){
                load_button(local_id_button,'show');
                const menu_show = document.querySelector('.show_menu');
                var arrar_str_menu = menu_show.id.split("");
                var length_arr = arrar_str_menu.length;
                if (compare=='increase') {
                    var id_menu = parseInt(arrar_str_menu[length_arr-1])+1;
                    if(id_menu==all_menu_show-1){
                        load_button(id_button,'hide');
                    }
                } else if (compare=='reduce'){
                    var id_menu = parseInt(arrar_str_menu[length_arr-1])-1;
                    if(id_menu==0){
                        load_button(id_button,'hide');
                    }
                }
                console.log(id_menu);
                $('#menu'+id_menu).addClass('show_menu');
                $('#'+menu_show.id).removeClass('show_menu');
            }

            $('#button_next_listcategory').click(function (e) { 
                click_button(this,'#button_prev_listcategory','increase');
            });
            $('#button_prev_listcategory').click(function (e) { 
                click_button(this,'#button_next_listcategory','reduce');
            });
            
            
            $(document).ready(function () {
                $('#user_menu').hide();
                $('#open_user_menu').click(function (e) { 
                    $('#user_menu').toggle();
                });
                height_header = $('.header').height();
                $('#').keyup(function (e) { 
                    if(e.keyCode === 13){
                        $('#header_main_box_search_button').click();
                    }
                });
            });

            
        </script>
    </div>
    <div class="wrapper">
        <div class="wrapper_inner">
            sdzdfdfgdsgDF
        </div>
    </div>
    <style>
        .wrapper{
            width: 100%;
            height: 1000px;
            display: flex;
            justify-content: center;
        }
        .wrapper .wrapper_inner{
            width: 1350px;
            height: 1000px;
            background-color: aqua;
        }
    </style>
    <script>
        $('.wrapper_inner').css('margin-top', '110px');
    </script>
</body>
<footer>
    <?php include('../bootstrap.php'); ?>
    <!-- <link rel="stylesheet" href="basic.css"> -->
</footer>
</html>