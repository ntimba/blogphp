<?php

require __DIR__ . '/vendor/autoload.php';


// User controller
use Ntimbablog\Portfolio\Controllers\UserController;
use Ntimbablog\Portfolio\Controllers\AdminController;

$userController = new UserController();



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
            $pageController->handleLogin();
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

if( isset( $_GET['action'] ) && $_GET['action'] !== '') {
    switch( $_GET['action'] ) {
        case 'admin' :
            $adminController->handleAdmin();
            break;
        case 'blog' : 
            $adminController->handleBlog();
            break;
        case 'post' : 
            $identifier = 0;
            if( isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = (int) $_GET['id'];
                $adminController->handlePost($identifier);
            }else{
                $adminController->handleBlog();
            }
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
            $adminController->handleLogout();
            break;
    }
}else{
    // Sera visible uniquement pour les personnes connecté
    $adminController->handleAdmin();
}

