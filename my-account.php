<?php
include('classes/DB.php');
include('classes/Login.php');
if(Login::isLoggedIn()){
    $userid = Login::isLoggedIn();
}else{
    die('Not Logged In');
}
    if(isset($_POST['uploadprofileimg'])){
        Image::uploadImage('profileimg','UPDATE users SET profileimg=:profileimg WHERE id=:userid',array(':userid'=>$userid));
    }
?>

    <h1>My Account</h1>
    <form action="my-account.php" method="post" enctype="multipart/form-data">
        Upload a profile picture
        <input type="file" name="profileimg">
        <input type="submit" name="uploadprofileimg" value="Upload Image">
    </form>