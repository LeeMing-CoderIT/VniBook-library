
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<?php
    include('connect.php');
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    session_start();
    class data{
        function checkAccout($username,$password){
            global $con;
            $sql = "SELECT* FROM account WHERE UserName = '$username' AND Password = '$password'";
            return mysqli_query($con,$sql)->num_rows;
        }

        function load_Accout($username){
            global $con;
            $sql = "SELECT* FROM account WHERE UserName = '$username'";
            return mysqli_query($con,$sql)->fetch_array();
        }

        function checkUsername_existAcccount($username){
            global $con;
            $sql = "SELECT* FROM account WHERE UserName = '$username'";
            $check = mysqli_query($con,$sql)->num_rows;
            return $check;
        }

        function Load_all_User(){
            global $con;
            $sql = "SELECT* FROM account";
            return mysqli_query($con,$sql);
        }

        function Load_shopping_cart($username){
            global $con;
            $sql = "SELECT* FROM shopping_cart WHERE UserName = '$username'";
            return mysqli_query($con,$sql);
        }

        function Load_shopping_cart_Item($username,$idProduct){
            global $con;
            $sql = "SELECT* FROM shopping_cart WHERE UserName = '$username' AND ID_Product = $idProduct";
            return mysqli_query($con,$sql)->fetch_array();
        }
        function Load_Product($idProduct){
            global $con;
            $sql = "SELECT* FROM product WHERE ID_Product = $idProduct";
            return mysqli_query($con,$sql)->fetch_array();
        }
        function loadAllproduct(){
            global $con;
            $sql = "SELECT* FROM product WHERE Total > 0";
            return mysqli_query($con,$sql)->fetch_array();
        }
        function Load_Receipt($username){
            global $con;
            $sql = "SELECT* FROM receipt WHERE UserName = '$username'";
            return mysqli_query($con,$sql);
        }
        function Load_wallet_history($username){
            global $con;
            $sql = "SELECT* FROM wallet_history WHERE UserName = '$username'";
            return mysqli_query($con,$sql);
        }
        function Load_wallet_history_Item($username,$id_wallet_history){
            global $con;
            $sql = "SELECT* FROM wallet_history WHERE ID = $id_wallet_history";
            return mysqli_query($con,$sql)->fetch_array();
        }
        function Load_Receipt_Item($username,$receipt_code){
            global $con;
            $sql = "SELECT* FROM receipt WHERE UserName = '$username' AND Receipt_code = '$receipt_code'";
            return mysqli_query($con,$sql)->fetch_array();
        }
        function Load_User_Information($username){
            global $con;
            $sql = "SELECT* FROM user_information WHERE UserName = '$username'";
            return mysqli_query($con,$sql)->fetch_array();
        }
        function Update_Wallet($username,$money){
            global $con;
            $sql = "UPDATE user_information SET wallet = $money WHERE UserName = '$username'";
            return mysqli_query($con,$sql);
        }

        function chang_Password($username,$newpassword){
            global $con;
            $sql = "UPDATE account SET Password = '$newpassword' WHERE UserName = '$username'";
            return mysqli_query($con,$sql);
        }
        function chang_User_information($name, $phoneNumber, $email, $address, $avatar, $username){
            global $con;
            $sql = "UPDATE user_information 
                    SET Name = '$name', PhoneNumber = '$phoneNumber', Email = '$email', Address = '$address', Avatar = '$avatar' 
                    WHERE UserName = '$username'";
            return mysqli_query($con,$sql);
        }

        function Register($username, $password){
            global $con;
            $sql = "INSERT INTO account(UserName,Password)
                    VALUES('$username','$password')";
            return mysqli_query($con,$sql);
        }
        function checkCategorywithID($id_category){
            global $con;
            $sql = "SELECT* FROM category WHERE ID = $id_category";
            return mysqli_query($con,$sql)->fetch_array();
        }
        function checkCategorywithClassify($id_classify){
            global $con;
            $sql = "SELECT* FROM classify WHERE ID = $id_classify";
            $id_category = mysqli_query($con,$sql)->fetch_array()['ID_category'];
            $sql = "SELECT* FROM category WHERE ID = $id_category";
            return mysqli_query($con,$sql)->fetch_array();
        }
        function loadClassifyofCategory($id_category){
            global $con;
            $sql = "SELECT* FROM classify WHERE ID_category = $id_category";
            return mysqli_query($con,$sql);
        }
        function loadAllcategory(){
            global $con;
            $sql = "SELECT* FROM category";
            return mysqli_query($con,$sql);
        }
        function loadAllclassify(){
            global $con;
            $sql = "SELECT* FROM classify";
            return mysqli_query($con,$sql);
        }
    }
    class account{
        private string $username, $password;

        public function getUsername(){
            return $this->username;
        }
        public function getPassword(){
            return $this->password;
        }
        
        public function setAccount($username){
            $getdata = new data();
            $load_account = $getdata->load_Accout($username);
            $this->username = $load_account['UserName'];
            $this->password = $load_account['Password'];
        }
        public function Login($username,$password){
            $getdata = new data();
            $checkAccount = $getdata->checkAccout($username,$password);
            if($checkAccount==1){
                setcookie("username", $username, time()+3600*24*30);
                $_SESSION['username'] = $username;
                return true;
            }else{
                return false;
            }
        }

        public function Logout(){
            setcookie("username", "", time()-60);
            session_destroy();
        }

        public function Register($username,$password){
            $getdata = new data();
            $check = $getdata->checkUsername_existAcccount($username);
            if($check==0)   return $getdata->Register($username,$password);
            else return false;
        } 

        public function chang_Password($newpassword){
            $getdata = new data();
            return $getdata->chang_Password($this->username,$newpassword);
        }

        public function shopping_cart(){
            $getdata = new data();
            return $getdata->Load_shopping_cart($this->username);
        }

        public function receipt(){
            $getdata = new data();
            return $getdata->Load_shopping_cart($this->username);
        }

        public function wallet_history(){
            $getdata = new data();
            return $getdata->Load_wallet_history($this->username);
        }
    }

    class wallet_history{
        private string $gift, $content, $time_up;		
        private int $price;

        public function getPrice(){
            return $this->price;
        }
        public function getGift(){
            return $this->gift;
        }
        public function getContent(){
            return $this->content;
        }
        public function getTime_up(){
            return $this->time_up;
        }
        public function setWallet_history($username,$id_wallet_history){
            $getdata = new data();
            $load_wallet_history = $getdata->Load_wallet_history_Item($username,$id_wallet_history);
            $this->price = $load_wallet_history['Price'];
            $this->gift = $load_wallet_history['Gift'];
            $this->content = $load_wallet_history['Content'];
            $this->time_up = $load_wallet_history['Time_up'];
        }
    }

    class user_information{
        private string $name, $phoneNumber, $email, $address, $avatar, $username;		
        private int $wallet;

        public function getName(){
            return $this->name;
        }
        public function getPhoneNumber(){
            return $this->phoneNumber;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getAddress(){
            return $this->address;
        }
        public function getAvatar(){
            return $this->avatar;
        }
        public function getWallet(){
            return $this->wallet;
        }
        public function setUser_information($username){
            $getdata = new data();
            $load_User_Information = $getdata->Load_User_Information($username);
            $this->name = $load_User_Information['Name'];
            $this->phoneNumber = $load_User_Information['PhoneNumber'];
            $this->email = $load_User_Information['Email'];
            $this->address = $load_User_Information['Address'];
            $this->avatar = $load_User_Information['Avatar'];
            $this->wallet = $load_User_Information['wallet'];
            $this->username = $username;

        }

        public function Update_Wallet($money){
            $getdata = new data();
            return $getdata->Update_Wallet($this->username,$this->wallet+$money);
        }

        function chang_User_information($name, $phoneNumber, $email, $address, $avatar){
            $getdata = new data();
            return $getdata->chang_User_information($name,$phoneNumber,$email,$address,$avatar,$this->username);
        }
    }

    class shopping_cart_Item{
        private string $image, $nameProduct;
        private int $priceProduct, $quantityProduct;

        public function getImage(){
            return $this->image;
        }
        public function getNameProduct(){
            return $this->nameProduct;
        }
        public function getPriceProduct(){
            return $this->priceProduct;
        }
        public function getQuantityProduct(){
            return $this->quantityProduct;
        }
        public function totalPrice(){
            return $this->priceProduct*$this->quantityProduct;
        }
        public function setshopping_cart_Item($username,$idProduct){
            $getdata = new data();
            $load_shopping_cart_Item = $getdata->Load_shopping_cart_Item($username,$idProduct);
            $product = new Product();
            $product->setProduct($load_shopping_cart_Item['ID_Product']);
            $this->image = $product->getImage();
            $this->nameProduct = $product->getName();
            $this->priceProduct = $product->getPrice();
            $this->quantityProduct = $load_shopping_cart_Item['quantity'];
        }
    }

    class category{
        private int $id;
        private string $name_category;
        public function getID(){
            return $this->id;
        }
        public function getNamecategory(){
            return $this->name_category;
        }
        public function setCategory($category){
            $this->id = $category['ID'];
            $this->name_category = $category['Name'];
        }
        public function loadAllcategory(){
            $getdata = new data();
            return $getdata->loadAllcategory();
        }
        public function loadClassifyofCategory($id_category){
            $getdata = new data();
            return $getdata->loadClassifyofCategory($id_category);
        }
    }
    class classify{
        private int $id, $id_category;
        private string $name_classify;
        public function getID(){
            return $this->id;
        }
        public function getIDcategory(){
            return $this->id_category;
        }
        public function getNameclassify(){
            return $this->name_classify;
        }
        public function setClassify($classify){
            $this->id = $classify['ID'];
            $this->id_category = $classify['ID_category'];
            $this->name_classify = $classify['Name'];
        }
        public function loadAllclassify(){
            $getdata = new data();
            return $getdata->loadAllclassify();
        }
        public function checkCategorywithClassify($id_classify){
            $getdata = new data();
            return $getdata->checkCategorywithClassify($id_classify);
        }
    }

    class Product{
        private string $nameProduct, $image, $back_side_image, $textdescribe;
        private int $category, $classify, $price, $total;

        public function getName(){
            return $this->nameProduct;
        }
        public function getCategory(){
            return $this->category;
        }
        public function getClassify(){
            return $this->classify;
        }
        public function getPrice(){
            return $this->price;
        }
        public function getTotal(){
            return $this->total;
        }
        public function getImage(){
            return $this->image;
        }
        public function getBack_side_image(){
            return $this->back_side_image;
        }
        public function getTextdescribe(){
            return $this->textdescribe;
        }
        public function setProduct($idProduct){
            $getdata = new data();
            $load_Product = $getdata->Load_Product($idProduct);
            $this->nameProduct = $load_Product['Name'];
            $this->category = $load_Product['category'];
            $this->classify = $load_Product['classify'];
            $this->image = $load_Product['image'];
            $this->back_side_image = $load_Product['back_side_image'];
            $this->total = $load_Product['Total'];
            $this->price = $load_Product['Price'];
            $this->textdescribe = $load_Product['textdescribe'];
        }
        public function loadAllproduct(){
            $getdata = new data();
            return $getdata->loadAllproduct();
        }
    }

    class Receipt{
        private string $receipt_code, $consignee_information, $list_of_products, $Time_receipt, $Note, $payment_methods, $status, $Time_complete;
        private int $preferential_value, $total_value;

        public function getReceipt_code(){ // mã đơn hàng
            return $this->receipt_code;
        }
        public function getConsignee_information(){ //thông tin người nhận: họ tên, sđt, email, địa chỉ
            return $this->consignee_information;
        }
        public function getList_of_products(){ //các sản phẩm, số lượng và giảm giá của sản phẩm khi sale
            return $this->list_of_products;
        }
        public function getTime_receipt(){ // thời gian đặt đơn hàng
            return $this->Time_receipt;
        }
        public function getNote(){ // ghi chú đơn hàng
            return $this->Note;
        }
        public function getPayment_methods(){ // phương thức thanh toán
            return $this->payment_methods;
        }
        public function getStatus(){ // trạng thái thể hiện tiến trình của đơn hàng
            return $this->status;
        }
        public function getTime_complete(){ // thời gian kết thức đơn
            return $this->Time_complete;
        }
        public function getPreferential_value(){ // giá trị giảm giá (<=100 tính theo phần trăm)(>100 tính theo đơn vị tiền) 
            return $this->preferential_value;
        }
        public function getTotal_value(){ // Tổng giá thanh toán của đơn hàng
            return $this->total_value;
        }
        public function setDonhang($username,$receipt_code){
            $getdata = new data();
            $Load_Receipt = $getdata->Load_Receipt_Item($username,$receipt_code);
            $this->receipt_code = $Load_Receipt['Receipt_code'];
            $this->consignee_information = $Load_Receipt['consignee_information'];
            $this->list_of_products = $Load_Receipt['list_of_products'];
            $this->Time_receipt = $Load_Receipt['Time_receipt'];
            $this->Note = $Load_Receipt['Note'];
            $this->payment_methods = $Load_Receipt['payment_methods'];
            $this->status = $Load_Receipt['status'];
            $this->Time_complete = $Load_Receipt['Time_complete'];
            $this->preferential_value = $Load_Receipt['Preferential_value'];
            $this->total_value = $Load_Receipt['Total_value'];
        }
    }

    function get_an_element($min, $max){
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }
    function ramdom_Code($length){
        $code = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited
        for ($i=0; $i < $length; $i++) {
            $code .= $codeAlphabet[get_an_element(0, $max-1)];
        }
        return $code;
    }
    function price_Fomat($price){
        return number_format($price,0,'.',',')."<sup style=\"font-size: 12px; text-decoration: underline;\">đ<sup>";
    }
    function percent_Format($number){
        return "$number<sup style=\"font-size: 12px\"> %<sup>";
    }
    function messageBox($title, $content, $icon, $link, $time_setup){
        if($time_setup==0){
            echo"<script>
                    $(document).ready(function (e) { 
                        $('#zoom_img_all').show();
                        $('body').css('overflow-y', 'hidden');
                        load_Display('$link',$time_setup,1);
                    });
                </script>";
        }else{
            echo"<script>
                    $(document).ready(function (e) { 
                        $('#zoom_img_all').show();
                        $('body').css('overflow-y', 'hidden');
                        setTimeout(()=>{
                            $('#zoom_img_all').hide();
                            $('body').css('overflow-y', 'auto');
                            Swal.fire({
                                title: '<span style=\"font-size: 30px;\">$title</span>',
                                width: '600px',
                                html: '<span style=\"font-size: 18px;\">$content</span>',
                                icon: '$icon',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: '<span style=\"font-size: 18px\">OK</span>',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    load_Display('$link',$time_setup,1);
                                }
                            });
                            load_Display('$link',$time_setup,1);
                        },$time_setup);
                    });
                </script>";
        }
    }
?>
<script>
    function load_Display(link,time_up,next){
        $('#zoom_img_all').show();
        $('body').css('overflow-y', 'hidden');
        setTimeout(()=>{
            $('#zoom_img_all').hide();
            $('body').css('overflow-y', 'auto');
            if(next!=0){
                if(link=='')    window.location = window.location;
                else window.location = link;
            }
        },time_up);
    }
    function load_Form(id_form,time_up,button_onclick){
        $('#zoom_img_all').show();
        $('body').css('overflow-y', 'hidden');
        setTimeout(()=>{
            $('#zoom_img_all').hide();
            $('body').css('overflow-y', 'auto');
            $(id_form).attr('action', $(button_onclick).attr('formaction'));
            $(id_form).submit();
        },time_up);
    }
    function messageBox(title,content,icon,link,time_setup){
        $('#zoom_img_all').show();
        $('body').css('overflow-y', 'hidden');
        setTimeout(()=>{
            $('#zoom_img_all').hide();
            $('body').css('overflow-y', 'auto');
            Swal.fire({
                title: `<span style=\"font-size: 30px;\">${title}</span>`,
                width: '600px',
                html: `<span style=\"font-size: 18px;\">${content}</span>`,
                icon: `${icon}`,
                confirmButtonColor: '#3085d6',
                confirmButtonText: '<span style=\"font-size: 18px\">OK</span>',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    load_Display(link,time_setup,next);
                }
            });
            load_Display(link,time_setup,next);
        },time_setup);
    }
    
    function questionBox(title,content,icon,link,time_setup){
        $('#zoom_img_all').show();
        $('body').css('overflow-y', 'hidden');
        setTimeout(()=>{
            $('#zoom_img_all').hide();
            $('body').css('overflow-y', 'auto');
            Swal.fire({
                title: `<span style=\"font-size: 30px;\">${title}</span>`,
                width: '600px',
                html: `<span style=\"font-size: 18px;\">${content}</span>`,
                icon: `${icon}`,
                confirmButtonColor: '#3085d6',
                confirmButtonText: '<span style=\"font-size: 18px\">OK</span>',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    load_Display(link,time_setup,next);
                }
            });
            load_Display(link,time_setup,next);
        },time_setup);
    }
</script>
