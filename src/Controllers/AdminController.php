<?php 

declare(strict_types=1);

// Utiliser les namespaces
namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\Models\User;
use Ntimbablog\Portfolio\Models\UserManager;


class AdminController
{
    public function dashboard(): void
    {
        if( isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin' ) {

            // données de connexion

            require('./views/backend/admin.php');
        }
    }

    public function handleBlog(): void
    {
        require('./views/backend/blog.php');
    }

    public function handlePost(): void
    {
        require('./views/backend/post.php');
    }

    public function handlePages(): void
    {
        require('./views/backend/pages.php');
    }

    public function handlePage(): void
    {
        require('./views/backend/page.php');
    }

    public function handleUsers(): void
    {
        require('./views/backend/users.php');
    }

    public function handleUser(): void
    {
        require('./views/backend/user.php');
    }

    public function handleLogout(): void
    {
        require('./views/backend/logout.php');
    }
    public function logout() : void
    {
        // Suppression de toute les variables
        session_unset();

        // Destruction de la session
        session_destroy();

        // Rediriger vers la page d'accueil 
        header("Location: index.php");
    }
    
}

