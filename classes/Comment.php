<?php
    class Comment{
        public static function createComment($commentBody, $postId, $userId) {
            if (strlen($commentBody) > 160 || strlen($commentBody) < 1) {
                die('Incorrect length!');
            }
            if(!DB::query('SELECT id FROM posts WHERE id=:post_id',array(':post_id'=>$postId))){
                echo "Invalid Post ID";    
            }else{
                DB::query('INSERT INTO comments VALUES (\'\', :comment, :userid, NOW(), :postid)',array(':comment'=>$commentBody,':userid'=>$userId, ':postid'=>$postId));
            }
        }
    }
?>