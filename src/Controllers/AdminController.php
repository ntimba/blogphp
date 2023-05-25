<?php 

declare(strict_types=1);

// Utiliser les namespaces
namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\User;
use Ntimbablog\Portfolio\UserManager;


class AdminController
{
    public function handleAdmin() {
        require('./views/backend/admin.php');
    }

    public function handleBlog() {
        require('./views/backend/blog.php');
    }

    public function handlePost() {
        require('./views/backend/post.php');
    }

    public function handlePages() {
        require('./views/backend/pages.php');
    }

    public function handlePage() {
        require('./views/backend/page.php');
    }

    public function handleUsers() {
        require('./views/backend/users.php');
    }

    public function handleUser() {
        require('./views/backend/user.php');
    }

    public function handleLogout() {
        require('./views/backend/logout.php');
    }
    
}