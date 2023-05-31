<?php

declare(strict_types=1);

namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\Models\CategoryManager;
use Ntimbablog\Portfolio\Models\Post;
use Ntimbablog\Portfolio\Models\PostManager;
use Ntimbablog\Portfolio\Models\UserManager;

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
    
    public function listBlogPosts() : void
    {
        // recupréer les posts
        $postManager = new PostManager();
        $posts = $postManager->getAllPosts();

        require('./views/frontend/blog.php');
    }

    public function displayBlogPost(int $identifier) : void
    {
        // recupérer un blog post
        $postManager = new PostManager();
        $post = $postManager->getPost($identifier);

        $categoryManager = new CategoryManager();

        $stringUtil = new StringUtil();
        
        
        // user
        $userManager = new UserManager();

        // formater la date
        $date = $post->getCreationDate();
        // Afficher la dernière date de mise à jour
        // Afficher le nom de la catégorie
        $category = $categoryManager->getCategory($post->getCategoryId());
        // Afficher la personne qui a écrit
        $user = $userManager->getUser($post->getUserId());

        
        require('./views/frontend/post.php');
    }

    public function displayAdminBlogPosts() : void
    {
        
        // recupérer tout les posts
        $postManager = new PostManager();
        $posts = $postManager->getAllPosts();

        // les affichers
        require('./views/backend/posts.php');
    }

    public function deletePost(int $identifier) : void
    {
        // Supprimer le blog post
        $postManager = new PostManager();
        $postManager->deletePost($identifier);

        // Afficher la liste des posts
        $this->displayAdminBlogPosts();

    }

    public function toupdate(int $identifier) : void
    {
        // recupérér les éléments de la base de données
        $stringUtil = new StringUtil();
        $postManager = new PostManager();
        $post = $postManager->getPost($identifier);

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->getCategories();

        require("./views/backend/toupdate.php");
    }

    public function updatePost(array $postData) : void
    {   
        $stringUtil = new StringUtil();
        $postManager = new PostManager();

        if( 
            isset($postData['post_id']) && !empty( $postData['post_id'] ) &&
            isset($postData[0]['post_title']) && !empty( $postData[0]['post_title'] ) &&
            isset($postData[0]['post_content']) && !empty( $postData[0]['post_content'] ) &&
            isset($postData[0]['post_category_id']) && !empty( $postData[0]['post_category_id'] ) 
         )
        {

            $postId = (int) htmlspecialchars( $postData['post_id'] );
            $postTitle = htmlspecialchars( $postData[0]['post_title'] );
            $postContent = htmlspecialchars($postData[0]['post_content']);
            $postSlug = $stringUtil->removeStringsSpaces($postTitle);
            $postCategoryId = (int) htmlspecialchars($postData[0]['post_category_id']);
            $postUserId = (int) $_SESSION['user_id'];
    
            $postFeaturedImagePath = NULL;            
            // Si le fichier à importer existe
            if( isset( $postData['featured_image'] ) && $postData['featured_image']['size'] > 0 ) 
            {
                $postFeaturedImagePath = $postManager->importImage($postData['featured_image'], './assets/uploads/');
            }
    
            // Créer un objet post
            $post = new Post([
                'id' => $postId,
                'title' => $postTitle,
                'content' => $postContent,
                'slug' => $postSlug,
                'categoryId' => $postCategoryId,
                'userId' => $postUserId,
                'featuredImagePath' => $postFeaturedImagePath
            ]);        
            
            // Mettre à jour l'article
            $postManager->updatePost($post);
        }

        
        // Afficher les posts 
        $this->displayAdminBlogPosts();
        
    }

}

