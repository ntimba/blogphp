<?php 

declare(strict_types=1);

// Utiliser les namespaces
namespace Ntimbablog\Portfolio\Controllers;

class AdminController
{
    public function handleAdmin(): void
    {
        require('./views/backend/admin.php');
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
    
}

