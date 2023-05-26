<?php 

declare(strict_types=1);

// Utiliser les namespaces
namespace Ntimbablog\Portfolio\Controllers;

class PageController
{
    public function handleAbout() {
        require('./views/frontend/about.php');
    }

    public function handleSkills() {
        require('./views/frontend/skills.php');
    }

    public function handlePortfolio() {
        require('./views/frontend/work.php');
    }

    public function handlePosts() {
        require('./views/frontend/blog.php');
    }

    public function handlePost() {
        require('./views/frontend/article.php');
    }

    public function handleContact() {
        require('./views/frontend/contact.php');
    }

    public function handleSignup($userData) {

        $userController = new UserController();
        $userController->signupUser($userData);

        require('./views/frontend/signup.php');
    }

    public function handleLogin() {
        require('./views/frontend/login.php');
    }
    
}

