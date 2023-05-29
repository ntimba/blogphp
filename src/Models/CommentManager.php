<?php

namespace App\Models;
use App\Lib\Database;
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
        // echo $id;
        $query = 'SELECT id, content, commentedDate, idArticle, userId, validateComment WHERE id = :id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'id' => $id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ( $result === false ) {
            return false;
        }
        
        $post = new Comment();
        $user->hydrate( $result );
        return $user;

    }



    public function getComments( int $idArticle ): mixed
    {
        // echo $id;
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
    

    public function addComment($newComment) : void
    {
        // code
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

    public function deleteComment( int $id )
    {
        $query = 'DELETE FROM comment WHERE id = :id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
    }    
}