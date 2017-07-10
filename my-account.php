<?php
include('classes/DB.php');
include('classes/Login.php');
if(Login::isLoggedIn()){
    $userid = Login::isLoggedIn();
}else{
    die('Not Logged In');
}
    if(isset($_POST['uploadprofileimg'])){
        $image = base64_encode(file_get_contents($_FILES['profileimg']['tmp_name']));
        $options = array('http'=>array(
            'method'=>"POST",
            'header'=>"Authorization: Bearer 9e0cd9c729a67e1b21ccd07f70ea7ad933f34aed\n".
            "Content-Type: application/x-www-form-urlencoded",
            'content'=>$image
        ));
        $context = stream_context_create($options);
        $imgurURL = 'https://api.imgur.com/3/image';
        if($_FILES['profileimg']['size'] > 10240000){
            die('Image too big, must be less than 10MB');
        }
        //print_r($_FILES);
        $response = file_get_contents($imgurURL, false, $context);
        $response = json_decode($response);
        DB::query('UPDATE users SET profileimg=:profileimg WHERE id=:userid',array(':profileimg'=>$response->data->link, ':userid'=>$userid));
    }
?>

    <h1>My Account</h1>
    <form action="my-account.php" method="post" enctype="multipart/form-data">
        Upload a profile picture
        <input type="file" name="profileimg">
        <input type="submit" name="uploadprofileimg" value="Upload Image">
    </form>