<?php

declare(strict_types=1);

namespace Ntimbablog\Portfolio\Models;

use Ntimbablog\Portfolio\lib\Database;
use \PDO;


class UserManager
{    
    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get user ID
    public function getUserId( string $email ): int
    {
        $query = 'SELECT user_id FROM user WHERE user_email = :user_email';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->bindParam(":user_email", $email);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['user_id'] ?? 0;

    }

    public function getUser( int $id ): mixed
    {
        $query = 'SELECT user_id, user_firstname, user_lastname, user_email, user_password, user_registration_date, user_role, user_token, user_profile_picture, user_biography, user_statut, user_audited_account FROM user WHERE user_id = :user_id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'user_id' => $id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ( $result === false ) {
            return false;
        }
        
        $user = new User();
        $user->hydrate( $result );
        return $user;

    }

    public function getAllUsers(): void
    {
        // code
    }

    public function createUser(object $newuser) : void
    {
        // code
        $query = 'INSERT INTO user(user_firstname, user_lastname, user_email, user_password, user_registration_date, user_role, user_token, user_profile_picture, user_biography, user_statut, user_audited_account) 
                  VALUES(:user_firstname, :user_lastname, :user_email, :user_password, NOW(), :user_role, :user_token, :user_profile_picture, :user_biography, :user_statut, :user_audited_account)';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'user_firstname' => $newuser->getFirstname(),
            'user_lastname' => $newuser->getLastname(),
            'user_email' => $newuser->getEmail(),
            'user_password' => $newuser->getPassword(),
            'user_role' => $newuser->getRole(), 
            'user_token' => $newuser->getToken(),
            'user_profile_picture' => $newuser->getProfilePicture(),
            'user_biography' => NULL,
            'user_statut' => $newuser->getStatut(),
            'user_audited_account' => 0
        ]);
    }

    public function updateUser(User $user): void
    {
        $query = 'UPDATE user SET firstname = :firstname, lastname = :lastname, email = :email, password = :password, registrationDate = :registrationDate, role = :role, token = :token, profilePicture = :profilePicture, statut = :statut, auditedAccount = :auditedAccount WHERE id = :id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'user_id' => $user->getId(),
            'user_firstname' => $user->getFirstname(),
            'user_lastname' => $user->getLastname(),
            'user_email' => $user->getEmail(),
            'user_password' => $user->getPassword(),
            'user_role' => $user->getRole(),
            'user_registration_date' => $user->getRegistrationDate(),
            'user_token' => $user->getRole(),
            'user_profile_picture' => $user->getToken(),
            'user_biography' => $user->getProfilePicture(),
            'user_statut' => $user->getStatut(),
            'user_audited_account' => $user->getAuditedAccount(),
        ]);
    }

    public function deleteUser( int $id ): void
    {
        $query = 'DELETE FROM article WHERE id = :id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
    }
}
