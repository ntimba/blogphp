<?php

declare(strict_types=1);

namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\Controllers\PostController;

use Ntimbablog\Portfolio\Models\PostManager;
use Ntimbablog\Portfolio\Models\Comment;
use Ntimbablog\Portfolio\Models\CommentManager;

class CommentController
{
    public function addComment(array $commentData) : void
    {
        if( 
            isset( $commentData['post_comment'] ) && !empty( $commentData['post_comment'] ) &&
            isset( $commentData['post_id'] ) && !empty( $commentData['post_id'] ) 
            )
        {
            $postManager = new PostManager();
            $commentManager = new CommentManager();

            $postId = (int) $commentData['post_id'];
            $comment = htmlspecialchars($commentData['post_comment']);
            $userId = $_SESSION['user_id'];
            
            $postComment = new Comment([
                'content' => $comment,
                'postId' => $postId,
                'userId' => $userId
            ]);
            
            // Si le post exist, on ajoute le commentaire
            if( $postManager->getPost($postId) ){
                if( ! $commentManager->getCommentId( $postComment->getContent() ) ){
                    $commentManager->addComment( $postComment );
                }
            }
        }
    }

    public function displayAdminPostComments() : void
    {
        // recupérer tout les posts
        $commentManager = new CommentManager();
        $comments = $commentManager->getAllComments();
        
        // les affichers
        require('./views/backend/comments.php');
    }


    public function verifyComment(int $identifier) : void
    {
        // recupérer le commentaire
        $commentManager = new CommentManager();
        $comment = $commentManager->getComment($identifier);

        if( !$comment->getCommentVerify() ){
            $comment->setCommentVerify(true);
        }

        // Mettre à jour le commentaire : 
        $commentManager->updateComment($comment); 
    }

    public function deleteComment(int $identifier) : void
    {
        $commentManager = new CommentManager();
        $commentManager->deleteComment($identifier);

        $comments = $commentManager->getAllComments();
        $this->displayAdminPostComments();
    }
}


