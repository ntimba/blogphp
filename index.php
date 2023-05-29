<?php
session_start();

require __DIR__ . '/vendor/autoload.php';


// User controller
use Ntimbablog\Portfolio\Controllers\UserController;
use Ntimbablog\Portfolio\Controllers\AdminController;
use Ntimbablog\Portfolio\Controllers\PostController;
use Ntimbablog\Portfolio\Controllers\CategoryController;

$userController = new UserController();


function debug($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

// Models


// la fonction de debugage

/**
 *  Front 
 * 
*/

if( isset( $_GET['action'] ) && $_GET['action'] !== '') {
    switch( $_GET['action'] ) {
        case 'about' :
            $pageController->handleAbout();
            break;
        case 'skills' : 
            $pageController->handleSkills();
            break;
        case 'portfolio' : 
            $pageController->handlePortfolio();
            break;
        case 'posts' : 
            $pageController->handlePosts();
            break;
        case 'post' : 
            $identifier = 0;
            if( isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = (int) $_GET['id'];
                $pageController->handlePost($identifier);
            }else{
                $pageController->handlePosts();
            }
            break;
        case 'contact' : 
            $pageController->handleContact();
            break;
        case 'signup' : 
            $data = [];
            if( isset( $_POST ) && !empty( $_POST ) ) {
                $data = $_POST;
            }
            $userController->createUser($data);

            break;
        case 'login' : 
            $data = [];
            if( isset( $_POST ) && !empty( $_POST ) ) {
                $data = $_POST;
            }
            $userController->loginUser($data);
            break;
    }
}else{
    $pageController->handleAbout();
}


/**
 *  Backend 
 * 
*/
$adminController = new AdminController();
$postController = new PostController();
$categoryController = new CategoryController();

if( isset( $_GET['action'] ) && $_GET['action'] !== '') {
    switch( $_GET['action'] ) {
        case 'admin' :
            $adminController->dashboard();
            break;
        case 'blog' : 
            $adminController->handleBlog();
            break;
        case 'addpost' : 
            $data = [];
            if( isset( $_POST ) && !empty( $_POST ) || isset( $_FILES['featured_image'] ) ) {
                $data = $_POST;
                $data['featured_image'] = $_FILES['featured_image'];  
            }
            $postController->addPost($data);
            break;
        case 'addcategory' : 
            $data = [];
            if( isset( $_POST ) && !empty( $_POST ) ) {
                $data = $_POST;
            }
            $categoryController->insertCategory($data);
            break;
        case 'pages' : 
            $adminController->handlePages();
            break;
        case 'page' : 
            $adminController->handlePage();
            break;
        case 'users' : 
            $adminController->handleUsers();
            break;
        case 'user' : 
            $adminController->handleUser();
            break;
        case 'logout' : 
            $adminController->logout();
            break;
    }
}else{
    // Sera visible uniquement pour les personnes connecté
    $adminController->dashboard();
}

