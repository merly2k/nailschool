<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of comment
 *
 * @author merly
 */
class comment extends \db{
    // Комментарии
    function getPostComments($pdo, $post_id){
        
        $sql = "SELECT mc_comment.id, mc_profile.user_id, comment_time, text, first_name, last_name FROM mc_comment INNER JOIN mc_profile ON mc_comment.user_id = mc_profile.user_id WHERE post_id=$post_id AND mc_comment.status != 0 ORDER BY comment_time DESC";
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function addPostCommentData($pdo, $user_id, $post_id, $comment_text){
        $post_id = $pdo->quote($post_id);
        $user_id = $pdo->quote($user_id);
        $comment_text = $pdo->quote($comment_text);
        
        $sql_insert = "INSERT INTO mc_comment (post_id, user_id, text) VALUES ($post_id, $user_id, $comment_text)";
        //print $sql_insert;
        if($pdo->exec($sql_insert)){
            return true;
        }else{
            return false;
        }
    }
    
    function delPostCommentData($pdo, $user_id, $comment_id){
        $user_id = $pdo->quote($user_id);
        $comment_id = $pdo->quote($comment_id);
        
        $sql_update = "UPDATE mc_comment SET status=0 WHERE id=$comment_id AND user_id=$user_id";
        //print $sql_update;
        if($pdo->exec($sql_update)){
            return true;
        }else{
            return false;
        }
    }
}
