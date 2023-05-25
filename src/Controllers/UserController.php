<?php 

declare(strict_types=1);

// Utiliser les namespaces
namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\User;
use Ntimbablog\Portfolio\UserManager;


class UserController
{
    // Add a user
    public function signUpUser(array $userData ) : void
    {
        // permet d'inscrire un nouveau utilisateur 
        debug( $userData );

        require('./views/frontend/singup.php');
    }
    
    // Login user
    public function loginUser(array $userData) : void
    {
        debug( $userData );
        require('./views/frontend/login.php');
    }

    // Delete a user
    public function deleteUser() : void
    {

        // Permet de supprimer un utilisateur

    }

    // Modify a user
    public function modifyUser() : void
    {
        // permet de modifier un utilisateur
    }

    // Show a user
    public function showUser() :void 
    {
        // Permet d'afficher un utilisateur avec tout ses détails
    }

    // Show all users
    public function showAllUsers() : void
    {
        // Permet d'afficher la liste des utilisateur
    }

}

