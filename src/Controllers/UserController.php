<?php 

declare(strict_types=1);

// Utiliser les namespaces
namespace Ntimbablog\Portfolio\Controllers;


use Ntimbablog\Portfolio\Models\User;
use Ntimbablog\Portfolio\Models\UserManager;


class UserController
{
    private array $errors = []; 

    protected const PASSWORD_NOT_IDENTICAL = "Les mots de passes ne sont pas identique";
    protected const FORM_NOT_COMPLETED = "Le formulaire n'est pas rempli complètement";
    protected const WRONG_PASSWORD_FORMAT = "Votre mot de passe doit comporter au minimum 8charactères 1majuscule, 1 minuscule et un caractère spécial";
    protected const WRONG_EMAIL_FORMAT = "Mauvais format d'email";
    protected const USER_EXIST = "Cet utilisateur existe déjà";
    protected const INVALID_CONNECTION_DATA = "Données de connexion invalide";
    

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function createUser( array $userData): void
    {
        // Si les variables sont rempli
        if( 
            !empty( $userData['firstname'] ) &&
            !empty( $userData['lastname'] ) &&
            !empty( $userData['email'] ) &&
            !empty( $userData['password'] ) &&
            !empty( $userData['repeat_password'] )
            ){

            // Définir les variables
            $firstname = $userData['firstname'];
            $lastname = $userData['lastname'];
            $email = $userData['email'];
            $password = $userData['password'];
            $repeatPassword = $userData['repeat_password'];
            $role = 'subscriber';
            $token = bin2hex(random_bytes(32));
            $profilePicture = '../../assets/img/avatar.png';
            $biography = NULL;
            $statut = true;
            $AuditedAccount = false;


            // on crée un objet user'
            $user = new User();

            $user->setFirstname( $firstname );
            $user->setLastname( $lastname );

            // vérifier le formation de mail
            if( $this->checkEmail($email)) {
                $user->setEmail( $email );
            }

            $user->setRole( $role );
            $user->setToken( $token );
            $user->setProfilePicture( $profilePicture );
            $user->setBiography( $biography );
            $user->setStatut( $statut );
            $user->setAuditedAccount( $AuditedAccount );
            
            // les deux mot de passe sont identique
            if( $this->checkPassword($password, $repeatPassword) ){
                // hasher le mot de passe
                $userManager = new UserManager();

                $hashPassword = password_hash($password, PASSWORD_BCRYPT);
                $user->setPassword( $hashPassword );
                
                if( !$userManager->getUserId($user->getEmail()) ) {
                    $userManager->createUser($user);
                } else {
                    $this->errors[] = self::USER_EXIST;
                }             
            }
            
        }else{
            if( isset($userData['submit']) ) {
                $this->errors[] = self::FORM_NOT_COMPLETED;
            }
        }
        
        require('./views/frontend/signup.php');
    }

    public function getUser(int $id): void
    {
        // retourne un utilisateur grace à son id
    }

    public function getAllUsers(): void
    {
        // Retourne la liste des utilisateurs
    }

    public function editUser(array $userData): void
    {
        // modifie l'utilisateur 
    }

    public function deleteUser(int $id): void
    {
        // supprime untilisateur 
    }

    public function checkPermission(): void
    {
        // vérifier les permission des utilisateurs 
    }

    public function checkPassword(string $password, string $repeatPassword): bool
    {
        // Vérifie l'égalité du mot de passe
        if( $password === $repeatPassword) {
            // on vérifie le format
            if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W)(?!.*\s).{8,}$/', $password)) {
                return true;
            } else {
                $this->errors[] = self::WRONG_PASSWORD_FORMAT;
                return false;
            }
            
        }else {
            $this->errors[] = self::PASSWORD_NOT_IDENTICAL;
            return false;
        }
    }

    public function checkEmail( string $email ): bool
    {
        if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            return true;
        } else {
            $this->errors[] = self::WRONG_EMAIL_FORMAT;
            return false;
        }   
    }
    
    public function loginUser(array $userData) : void
    {
        // Login user
        if( !empty( $userData['email'] ) && !empty( $userData['password'] ) )
        {
            $email = $userData['email'];
            $password = $userData['password'];

            debug($userData);
            // recupérer l'utilisateur 
            $userManager = new UserManager();
            $getUserId = $userManager->getUserId( $email );

            if( $getUserId ){
                // recupérer les coordonées de l'utilisateur dont le son mot de passe
                $databaseData = $userManager->getUser( $getUserId );

                if( $databaseData->getRole() === 'admin' ){
                    $this->loginAdmin( $databaseData, $password );
                }else{
                    $this->loginUserNormal( $databaseData, $password );
                }
            
            }else{
                $this->errors[] = self::INVALID_CONNECTION_DATA;
            }
        }

        require('./views/frontend/login.php');
    }

    public function loginAdmin(User $user, string $password) : void
    {
        if( password_verify($password, $user->getPassword()) )
        {
            echo "vous ête connecé en tant qu'admin";
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_role'] = $user->getRole();

        }else{
            $this->errors[] = self::INVALID_CONNECTION_DATA;
        }
    }

    public function loginUserNormal(User $user, string $password) : void
    {
        if( password_verify($password, $user->getPassword()) )
        {
            echo "Utilisateur connecté";
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_role'] = $user->getRole();
        }else{
            $this->errors[] = self::INVALID_CONNECTION_DATA;
        }
    }

    public function userConnected() : void
    {
        if( !isset( $_SESSION['user_id'] ) ) {
            header('Location: login.php');
            exit();
        }
    }    
}

