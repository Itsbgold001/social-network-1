<?php
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
        print_r($_FILES);
        $response = file_get_contents($imgurURL, false, $context);
    }
?>

    <h1>My Account</h1>
    <form action="my-account.php" method="post" enctype="multipart/form-data">
        Upload a profile picture
        <input type="file" name="profileimg">
        <input type="submit" name="uploadprofileimg" value="Upload Image">
    </form>