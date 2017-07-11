<?php
include('./classes/DB.php');
include('./classes/Login.php');
if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
} else {
        die('Not logged in');
}
if(DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$userid))){
    $notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$userid));
    foreach($notifications as $n){
        echo $n['type'];
    } 
}
?>