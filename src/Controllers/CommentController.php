<?php

declare(strict_types=1);

namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\Controllers\PostController;

use Ntimbablog\Portfolio\Models\PostManager;
use Ntimbablog\Portfolio\Models\Comment;
use Ntimbablog\Portfolio\Models\CommentManager;

class CommentController
{
    public function addComment($commentData)
    {
        if( 
            isset( $commentData['post_comment'] ) && !empty( $commentData['post_comment'] ) &&
            isset( $commentData['post_id'] ) && !empty( $commentData['post_id'] ) 
            )
        {
            $postManager = new PostManager;
            $commentManager = new CommentManager();

            $postId = (int) $commentData['post_id'];
            $comment = htmlspecialchars($commentData['post_comment']);
            $userId = $_SESSION['user_id'];
            
            $postComment = new Comment([
                'content' => $comment,
                'postId' => $postId,
                'userId' => $userId
            ]);
                        
            // debug( $postComment );
            
            // Si le post exist, on ajoute le commentaire
            if( $postManager->getPost($postId) ){
                if( ! $commentManager->getCommentId( $postComment->getContent() ) ){
                    $commentManager->addComment( $postComment );
                    header('Location index.php');
                }
            }
        }
    }

    
    
}


