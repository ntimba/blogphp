<?php

declare(strict_types=1);

namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\Models\CategoryManager;
use Ntimbablog\Portfolio\Models\Post;
use Ntimbablog\Portfolio\Models\PostManager;
use Ntimbablog\Portfolio\Helpers\StringUtil;

use Ntimbablog\Portfolio\Controllers\CategoryController;


class PostController
{

    private array $errors = [];

    protected const EMPTY_VALUES = "Remplissez tous les champs";


    public function addPost(array $postData) : void
    {
        $stringUtil = new StringUtil();

        // Créer la catégorie defaut s'il n'existe pas
        $categoryController = new CategoryController();
        $categoryController->insertDefaultCategory();
        
        if(
            isset( $postData['post_title'] ) && !empty($postData['post_title'] ) &&
            isset( $postData['post_content'] ) && !empty($postData['post_content'] ) &&
            isset( $postData['post_category_id'] ) && isset( $postData['featured_image'] )
            )
        {
            $postManager = new PostManager();
            
            $postTitle = htmlspecialchars($postData['post_title']);
            $postContent = htmlspecialchars($postData['post_content']);
            $postSlug = $stringUtil->removeStringsSpaces($postTitle);
            $postCategoryId = (int) htmlspecialchars($postData['post_category_id']);
            $postUserId = $_SESSION['user_id'];

            $postFeaturedImagePath = NULL;            

            // Si le fichier à importer existe
            if( isset( $postData['featured_image'] ) && $postData['featured_image']['size'] > 0 ) 
            {
                $postFeaturedImagePath = $postManager->importImage($postData['featured_image'], './assets/uploads/');
            }
    
            // Créer un objet post
            $post = new Post([
                'title' => $postTitle,
                'content' => $postContent,
                'slug' => $postSlug,
                'categoryId' => $postCategoryId,
                'userId' => $postUserId,
                'featuredImagePath' => $postFeaturedImagePath
            ]);
            
            // Enregistrer l'image dans la base de données
            if( !$postManager->getPostId( $post->getTitle()) )
            {
                $postManager->createPost($post);
            }
    
        }else{

            $this->errors[] = self::EMPTY_VALUES;
        }

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->getCategories();
        
        require('./views/backend/addpost.php');
    }    
}