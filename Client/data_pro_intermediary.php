<?php 
    include('../control.php');
    include('../model_loading.php'); 
    global $con;
    $time_now = date('Y-m-d H:i:s', time());
    $account = new account();
    $user_name = !empty($_SESSION['username'])?$_SESSION['username']:"";
    if($user_name!="") $account->setAccount($user_name);

    $form = !empty($_GET['form'])?$_GET['form']:"";
        if ($form=='login') {
            $username = !empty($_POST['txtusername'])?$_POST['txtusername']:"";
            $password = !empty($_POST['txtpassword'])?$_POST['txtpassword']:"";
            $login = $account->Login($username,$password);
            if($login!=false){  
                messageBox("","",'','home_page.php',0);
            }else    messageBox("Thông báo","Thông tin tài khoản mật khẩu không chính xác.",'error','Login.php',2000);
        }elseif($form=='logout'){
            $account->Logout();
            messageBox("","",'','Login.php',0);
        }elseif($form=='register'){
            $username = !empty($_POST['txtusername'])?$_POST['txtusername']:"";
            $password = !empty($_POST['txtpassword'])?$_POST['txtpassword']:"";
            $register = $account->Register( $username,$password );
            if($register==false){
                messageBox('Thông báo','Tài khoản đã tồn tại.','error','Login.php',2000);
            }else{
                $login = $account->Login($username,$password);
                messageBox("","",'','home_page.php',0);
            }
        }else{
            messageBox('Thông báo','Không tồn tại chức năng này.','error','home_page.php',2000);
        }

        
        
       
    include('../bootstrap.php');
?>
<link rel="stylesheet" href="basic.css">