<?php
// session_start();

// Database connecion
use Ntimbablog\Portfolio\Lib\Database;

// User controller
use Ntimbablog\Portfolio\Controllers\UserController;
use Ntimbablog\Portfolio\Controllers\PageController;
use Ntimbablog\Portfolio\Controllers\AdminController;

require __DIR__ . '/vendor/autoload.php';

// la fonction de debugage
function debug($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}


// $userController = new userController();



// les routes





// Les besoins que j'ai 

// 1. Avoir une liste des routes

// 2. chaque route fait appelle à un controller

// 3. recupéréer le url

// 4. Le lien correspond à quelle route ?


// class Router
// {

//     private array $routes = [];

//     // ajouter une route
//     public function addRoute(string $route, string $controller, string $method) {

//         $this->routes[$route] = ['controller' => $controller, 'method' => $method];
        
//     }

//     public function dispatch(string $route) {
//         // $routes = $this->routes;

//         if( array_key_exists( $route, $this->routes) ) {
            
//             $controllerName = $this->routes[$route]['controller'];
//             $methodName = $this->routes[$route]['method'];
//             $controller = new $controllerName;
//             $controller->$methodName();
//         }
        
//     }
// }



/**
 *  Front 
 * 
*/

$pageController = new PageController();
$userController = new UserController();

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
            if( isset( $_POST ) && !empty( $_POST ) ) {
                $data = $_POST;
            }
            $pageController->handleSignup($data);
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

