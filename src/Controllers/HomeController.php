<?php

declare(strict_types=1);

namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\Controllers\PostController;

use Ntimbablog\Portfolio\Models\PostManager;
use Ntimbablog\Portfolio\Models\Comment;
use Ntimbablog\Portfolio\Models\CommentManager;

class HomeController
{
    public function callToAction() : void
    {

        require("./views/frontend/home.php");
    }

    public function aboutMe() : void
    {

    }

}