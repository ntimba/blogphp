<?php

declare(strict_types=1);

namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\Controllers\PostController;

use Ntimbablog\Portfolio\Models\PostManager;
use Ntimbablog\Portfolio\Models\Comment;
use Ntimbablog\Portfolio\Models\CommentManager;
use Ntimbablog\Portfolio\Models\UserManager;

class PageController
{
    public function getHome() : void
    {
        $userManager = new UserManager();
        $pageTitle = "À propos de moi";
        // L'adresse e-mail de l'admin
        $adminEmail = 'ch.ntimba@bluewin.ch';
        $adminId = $userManager->getUserId( $adminEmail );

        // recupérer les données de l'administrateur
        $userData = $userManager->getUser( $adminId );

        // debug( $userData );


        require("./views/frontend/home.php");
    }
    
    public function getSkills()
    {
        $pageTitle = "Compétences";
        require("./views/frontend/skills.php");
    }

}