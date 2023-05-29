<?php

namespace Ntimbablog\Portfolio\Models;

use Ntimbablog\Portfolio\Lib\Database;
use Ntimbablog\Portfolio\Models\Comment;

use PDO;

use \App\Models;

class CommentManager
{    
    // Get User Id

    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get user ID
    public function getCommentId( string $content ): int
    {
        $query = 'SELECT id FROM comment WHERE content = :content';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->bindParam(":content", $content);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['id'] ?? 0;
    }

    public function getComment( int $id ): mixed
    {

        $query = 'SELECT id, content, commentedDate, idArticle, userId, validateComment WHERE id = :id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'id' => $id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ( $result === false ) {
            return false;
        }
        
        $comment = new Comment();
        $comment->hydrate( $result );
        return $comment;

    }



    public function getComments( int $idArticle ): mixed
    {

        $query = 'SELECT id, content, commentedDate, userId, validateComment FROM comment WHERE idArticle = :idArticle';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'idArticle' => $idArticle
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ( $result === false ) {
            return false;
        }
        
        $comments = new Comment();
        $comments->hydrate( $result );
        return $comments;

    }
    

    public function addComment(Comment $newComment) : void
    {
        $query = 'INSERT INTO comment(content, commentedDate, idArticle, userId, validateComment) 
                  VALUES(:content, NOW(), :idArticle, :userId, :validateComment)';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'content' => $newComment->getContent(), 
            'idArticle' => $newComment->getIdArticle(),
            'userId' => $newComment->getUserId(),
            'validateComment' => $newComment->getValidateComment() ? 1 : 0 // convert to boolean
        ]);
    }

    public function deleteComment( int $id ) : void
    {
        $query = 'DELETE FROM comment WHERE id = :id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
    }    
}
