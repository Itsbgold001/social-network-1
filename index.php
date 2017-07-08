<?php
include('./classes/DB.php');
include('./classes/Login.php');
$showTimeline = False;
if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
        $showTimeline = True;
} else {
        echo 'Not logged in';
}
if (isset($_GET['postid'])) {
        Post::likePost($_GET['postid'], $userid);
}
$followingposts = DB::query('SELECT posts.id, posts.body, posts.likes, users.`username` FROM users, posts, followers
WHERE posts.user_id = followers.user_id
AND users.id = posts.user_id
AND follower_id = :userid
ORDER BY posts.likes DESC;',array(':userid'=>$userid));
foreach ($followingposts as $post) {
        echo $post['body']." ~ ".$post['username']."<hr />";
}
?>