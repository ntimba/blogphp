<?php

namespace Ntimbablog\Portfolio\Models;

use mysqli_sql_exception;
use Ntimbablog\Portfolio\lib\Database;
use \PDO;


class PostManager
{    
    // Get User Id

    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get user ID
    public function getPostId( string $title ): int
    {
        $query = 'SELECT post_id FROM post WHERE post_title = :post_title';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->bindParam(":post_title", $title);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['post_id'] ?? 0;
    }

    public function getPost( int $post_id ): mixed
    {
        $query = 'SELECT post_id, post_title, post_content, post_creation_date, post_update_date, post_slug, post_category_id, post_user_id, post_featured_image_path FROM post WHERE post_id = :post_id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'post_id' => $post_id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ( $result === false ) {
            return false;
        }
        
        $post = new Post();
        $post->hydrate( $result );
        return $post;
    }

    public function getAllPosts() : mixed
    {
        $query = 'SELECT post_id, post_title, post_content, post_creation_date, post_update_date, post_slug, post_category_id, post_user_id, post_featured_image_path FROM post';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute();

        $postsData = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ( $postsData === false ) {
            return false;
        }

        $posts = [];

        foreach( $postsData as $postData ){
            $post = new Post($postData);
            $posts[] = $post;
        }
        return $posts;   
    }
    

    public function createPost(Post $post) : void
    {
        // code
        $query = 'INSERT INTO post(post_title, post_content, post_creation_date, post_update_date, post_slug, post_category_id, post_user_id, post_featured_image_path) 
                  VALUES(:post_title, :post_content, NOW(), :post_update_date, :post_slug, :post_category_id, :post_user_id, :post_featured_image_path)';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'post_title' => $post->getTitle(),
            'post_content' => $post->getContent(),
            'post_update_date' => NULL,
            'post_slug' => $post->getSlug(), 
            'post_category_id' => $post->getCategoryId(),
            'post_user_id' => $post->getUserId(),
            'post_featured_image_path' => $post->getFeaturedImagePath()
        ]);
    }

    public function updatePost(Post $post)
    {
        $query = 'UPDATE  SET post_title = :post_title, post_content = :post_content, post_creation_date = :post_creation_date, post_update_date = :post_update_date, post_slug = :post_slug, post_category_id = :post_category_id, post_user_id = :post_user_id, post_featured_image = :post_featured_image WHERE post_id = :post_id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'creationDate' => $post->getCreationDate(),
            'updateDate' => $post->getUpdateDate(),
            'slug' => $post->getSlug(), 
            'categoryId' => $post->getCategoryId(),
            'userId' => $post->getUserId(),
            'image' => $post->getFeaturedImagePath()
        ]);
    }

    public function deletePost( int $postId )
    {
        $query = 'DELETE FROM post WHERE post_id = :post_id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'post_id' => $postId
        ]);
    }

    public function importImage(array $file, string $destination)
    {
        if( isset($file['name']) && $file['error'] == 0 ) {
            if( $file['size'] <= 2000000 )
            {
                $fileInfo = pathinfo($file['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'ico'];

                if( in_array( $extension, $allowedExtensions ))
                {
                    $newFileName = str_replace(' ', '_', basename($file['name']) );
                    $filePath = $destination . $newFileName;
                    // move_uploaded_file($file['tmp_name'], $destination . basename($file['name']));
                    // move_uploaded_file($file['tmp_name'], $destination . $newFileName );

                    if( move_uploaded_file($file['tmp_name'], $filePath) )
                    {
                        return $filePath;
                    }
                }
            }
        }
        return NULL;
    }  
}
