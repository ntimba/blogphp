<?php

declare(strict_types=1);

namespace App\Models;

class User
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private string $registrationDate;
    private string $role;
    private ?string $token;
    private ?string $profilePicture;
    private string $biography;
    private bool $statut;
    private bool $auditedAccount;
    private array $errors = [];
    
    // errors
    const INVALID_FIRSTNAME = 'invalide firstname';
    const INVALID_LASTNAME = 2;
    const INVALID_EMAIL = 3;
    const INVALID_PASSWORD = 4;
    const INVALID_REGISTRATION_DATE = 5;
    const INVALID_ROLE = 6;
    const INVALID_PROFILE_PICTURE = 7;
    const INVALID_BIOGRAPHY = 8;
    const INVALID_USER_STATUT = 9;    
    
    
    public function __construct( array $userdata = [])
    {
        // var_dump($userdata);
        $this->hydrate($userdata);
    }

    // hydrater
    public function hydrate(array $data) : void
    {
        foreach ($data as $attribut => $value) {
            $setters = 'set'. ucfirst($attribut);
            $this->$setters($value);
        }
    }
    

    /*****************************
     *          SETTERS          *
     *****************************/

    public function setId(int $id) : void
    {
        if(is_numeric($id) && !empty($id))
        {
            $this->id = $id;
        }
    }

    public function setFirstname(string $firstName) : void
    {
        if( is_string( $firstName ) && !empty($firstName) )
        {
            $this->firstName = $firstName;
        } else {
            $this->errors[] = self::INVALID_FIRSTNAME;
        } 
    }


    public function setLastname(string $lastName) : void
    {
        if( is_string( $lastName ) && !empty($lastName) )
        {
            $this->lastName = $lastName;
        } else {
            $this->errors[] = self::INVALID_LASTNAME;
        } 
    }
    

    public function setEmail(string $email) : void
    {
        if( is_string( $email ) && !empty($email) )
        {
            $this->email = $email;
        } else {
            $this->errors[] = self::INVALID_EMAIL;
        } 
    }




    public function setPassword(string $pass) : void
    {
        
        if( is_string( $pass ) && !empty($pass) )
        {
            // hasher le mot de passe
            $this->password = $pass;
            
        } else {
            // Les champ de mot de passe ne doit pas être vide
            $this->errors[] = self::INVALID_PASSWORD;
        }
    }


    public function setRegistrationdate(string $registrationDate) : void
    {
        if( is_string( $registrationDate ) && !empty($registrationDate) )
        {
            $this->registrationDate = $registrationDate;
        } else {
            $this->errors[] = self::INVALID_REGISTRATION_DATE;
        } 
    }
   

    public function setRole(string $role) : void
    {
        if( is_string( $role ) && !empty($role) )
        {
            $this->role = $role;
        } else {
            $this->errors[] = self::INVALID_ROLE;
        } 
    }


    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    public function setProfilePicture(?string $profilePicture) : void
    {
        if($profilePicture === null) {
            $this->getProfilePicture = $profilePicture;
            return;
        }

        if( is_string( $profilePicture ) && !empty($profilePicture) )
        {
            $this->profilePicture = $profilePicture;
        } else {
            $this->errors[] = self::INVALID_PROFILE_PICTURE;
        } 
    }

    // public function setToken(?string $token): void
    // {
    //     $this->token = $token;
    // }



    public function setBiography(string $biography) : void
    {
        if( is_string( $biography ) && !empty($biography) )
        {
            $this->biography = $biography;
        } else {
            $this->errors[] = self::INVALID_BIOGRAPHY;
        } 
    }
    

    public function setStatut($statut) : void
    {
        if( is_bool( $statut ) )
        {
            $this->statut = $statut;
        } elseif (is_int( $statut )) 
        {
            $this->statut = ($statut === 1);
        } 
        else {
            $this->errors[] = self::INVALID_USER_STATUT;
        } 
    }


    public function setAuditedaccount($audited): void
    {
        if(is_bool($audited)){
            $this->auditedAccount = $audited;
        }elseif( is_int( $audited ) ){
            $this->auditedAccount = ( $audited === 1 );
        }
    }
    

    /*****************************
     *          GETTERS          *
     *****************************/

    public function getId() : int
    {
        return $this->id;
    }

    public function getFirstname() : string 
    {
        return $this->firstName;
    }

    public function getLastname() : string
    {
        return $this->lastName;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function getRegistrationdate() : string
    {
        return $this->registrationDate;
    }

    public function getRole() : string
    {
        return $this->role;
    }

    public function getToken() : ?string
    {
        return $this->token;
    }

    public function getProfilePicture() : ?string
    {
        return $this->profilePicture;
    }

    public function getBiography() : string
    {
        return $this->biography;
    }

    public function getStatut() : bool
    {
        return $this->statut;
    }

    public function getAuditedaccount() : bool
    {
        return $this->auditedAccount;
    }

    public function isEmailValid($email) : bool
    {
        if( filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            return true;
        } else {
            return false;
        }
    }

    
    // vérifier l'utilisateur
    public function verifyUser($email)
    {
        // 1. récupérer le token généré
        // 2. envoyer un mail pour que l'utilisateur puisse valider son compte

        // Créer une class Mailer
    }


    public function connectUser() : void
    {
        // Connecter l'utilisateur
        // La fonction va créer une session
        // La fonction a besoin de comparer les mots de passe

        // 1. récupérer le mot de passe de la base de données à partir d'un mot de passe
        // 2. comparer les deux mot de passe
        // 3. connecter l'utilisateur
    }

    public function logoutUser()
    {
        // La fonction va deconnecter l'utilisateur
    }




    public function isUserConnected()
    {
        // Vérifier si l'utilisateur est connecté
    }

    
    
}