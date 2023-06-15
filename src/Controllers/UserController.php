<?php 

declare(strict_types=1);

// Utiliser les namespaces
namespace Ntimbablog\Portfolio\Controllers;

use Ntimbablog\Portfolio\Models\User;
use Ntimbablog\Portfolio\Models\UserManager;
use Ntimbablog\Portfolio\Helpers\StringUtil;
use Ntimbablog\Portfolio\Models\FilesManager;

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
        $userManager = new UserManager();
        $users = $userManager->getAllUsers();

        require('./views/backend/users.php');
    }

    public function activate(int $identifier) : void
    {
        // recupérer et créer l'objet utilisateur
        $userManager = new UserManager();
        $user = $userManager->getUser($identifier);
        
        // Si l'utilisateur existe on active l'utilisateur
        if( $userManager->getUser($identifier) )
        {
            // modifier le user_statut (si c'est false, sinon on affiche un message d'erreur)
            if( !$user->getStatut() ){
                $user->setStatut(true);
                
                // Mettre à jour la base de données
                $userManager->updateUser($user);
                // Afficher la liste des utilisateurs
                $this->getAllUsers();
            }else{
                // Enventuellement créer un message flash
                echo "Cet utilisateur est déjà activé";
                $this->getAllUsers();

            }
        }else{
            $this->getAllUsers();
        }

        // Si l'utilisateur n'existe pas, on renvoi à la page ou tous les utilisateurs seront afficher.
        
    }

    public function restrict(int $identifier) : void
    {   
        // recupérer et créer l'objet utilisateur
        $userManager = new UserManager();
        $user = $userManager->getUser($identifier);        
        
        // Si l'utilisateur existe on active l'utilisateur
        if( $userManager->getUser($identifier) )
        {
            // modifier le user_statut (si c'est false, sinon on affiche un message d'erreur)
            if( $user->getStatut() ){
                $user->setStatut(false);
                // Mettre àjour l'utilisateur
                $userManager->updateUser($user);

                $this->getAllUsers();
            }else{
                // Enventuellement créer un message flash
                echo "Cet utilisateur est déjà restreint";
                $this->getAllUsers();
            }
        }else{
            $this->getAllUsers();
        }
    }

    public function delete(int $identifier): void
    {
        // recupérer et créer l'objet utilisateur
        $userManager = new UserManager();
        $user = $userManager->getUser($identifier);
        
        // Si l'utilisateur existe on active l'utilisateur
        if( $userManager->getUser($identifier) )
        {
            // Demander de taper l' nom de l'utilisateur au complet avant de le supprimer
            // Supprimer l'utilisateur
            $userManager->deleteUser($identifier);
            $this->getAllUsers();
        }else{
            $this->getAllUsers();
        }
    }

    public function editUser(array $userData): void
    {
        // modifie l'utilisateur 
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

    public function manageProfile(int $identifier) : void
    {
        $stringUtil = new StringUtil();

        // recupéréer les données de la base de données
        $userManager = new UserManager();
        $userData = $userManager->getUser($identifier);


        // Préparer les données pour l'affichage        
        $userDetails['firstname'] = $userData->getFirstname();
        $userDetails['lastname'] = $userData->getLastname();
        $userDetails['email'] = $userData->getEmail();
        $userDetails['profile_picture'] = $userData->getFirstname();
        $userDetails['biography'] = $userData->getBiography();


        // inclure la page d'affichage
        require('./views/backend/profile.php');
    }

    public function updateProfile(array $data) : void
    {
        // recupérer les données de l'utilisateur
        $userManager = new UserManager();
        $user = $userManager->getUser($_SESSION['user_id']);

        if( 
            isset( $data['firstname'] ) && !empty( $data['firstname'] ) && 
            isset( $data['lastname'] ) && !empty( $data['lastname'] ) && 
            isset( $data['email'] ) && !empty( $data['email'] ) 
         )
        {
            // Si les champs suivant sont remplis on le met dans un objet 
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setEmail($data['email']);

            // Si les données de mot de passe sont remplis, on modifie l'objet
            if(
                isset($data['old_password']) && !empty( $data['old_password'] ) &&
                isset($data['new_password']) && !empty( $data['new_password'] ) &&
                isset($data['repeat_new_password']) && !empty( $data['repeat_new_password'] )
                )
            {
                // Si l'ancien mot de passe est identique avec le mot de passe de la base de données, on change le mot de passe
                if( password_verify($data['old_password'],$user->getPassword() ) )
                {
                    if( $this->checkPassword($data['new_password'], $data['repeat_new_password']) )
                    {
                        $user->setPassword( password_hash($data['new_password'], PASSWORD_DEFAULT) );
                    }
                    // Si les new_password et repeat_new_password est identique, on va hasher le mot de passe et la mettre dans l'objet
                    // Vérifier la valididé de mot de passe 
                }
            }

            if(isset( $data['biography'] ) && !empty( $data['biography'] ))
            {
                $user->setBiography( $data['biography'] );
            }

            // Vérifier le fichier a été envoyer
            $filesManager = new FilesManager();
            if( $data['profile_image']['error'] == UPLOAD_ERR_OK )
            {
                // importer le fichier 
                $profilePicture = $filesManager->importFile($data['profile_image'], './assets/uploads/');
                $user->setProfilePicture($profilePicture);
            }

            // Modifier l'utilisateur
            $userManager->updateUser($user);   
        }
    }

    public function userConnected() : void
    {
        if( !isset( $_SESSION['user_id'] ) ) {
            header('Location: login.php');
            return;
        }
    }    
}

