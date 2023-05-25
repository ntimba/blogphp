<?php

declare(strict_types=1);

namespace App\Models;

use App\Lib\Database;
use PDO;


class UserManager
{    
    // Get User Id

    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get user ID
    public function getUserId( string $email ): int
    {
        $query = 'SELECT id FROM user WHERE email = :email';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->bindParam(":email", $email);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['id'] ?? 0;
    }

    public function getUser( int $id ): mixed
    {
        // echo $id;
        $query = 'SELECT id, firstname, lastname, email, password, registrationDate, role, token, profilePicture, statut, auditedAccount FROM user WHERE id = :id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'id' => $id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ( $result === false ) {
            return false;
        }
        
        $user = new User();
        $user->hydrate( $result );
        return $user;

    }

    public function getAllUsers(): array
    {
        // code
    }

    public function createUser($newuser) : void
    {
        // code
        $query = 'INSERT INTO user(firstname, lastname, email, password, registrationDate, role, token, profilePicture, biography, statut, auditedAccount) 
                  VALUES(:firstname, :lastname, :email, :password, NOW(), :role, :token, :profilePicture, :biography, :statut, :auditedAccount)';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'firstname' => $newuser->getFirstname(),
            'lastname' => $newuser->getLastname(),
            'email' => $newuser->getEmail(),
            'password' => $newuser->getPassword(),
            'role' => $newuser->getRole(), 
            'token' => $newuser->getToken(),
            'profilePicture' => $newuser->getProfilePicture(),
            'biography' => NULL,
            'statut' => $newuser->getStatut(),
            'auditedAccount' => 0
        ]);
    }

    public function updateUser(User $user)
    {
        $query = 'UPDATE user SET firstname = :firstname, lastname = :lastname, email = :email, password = :password, registrationDate = :registrationDate, role = :role, token = :token, profilePicture = :profilePicture, statut = :statut, auditedAccount = :auditedAccount WHERE id = :id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'id' => $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'registrationDate' => $user->getRegistrationDate(),
            'role' => $user->getRole(),
            'token' => $user->getToken(),
            'profilePicture' => $user->getProfilePicture(),
            'statut' => $user->getStatut(),
            'auditedAccount' => $user->getAuditedAccount(),
        ]);
    }

    public function deleteUser( int $id )
    {
        $query = 'DELETE FROM article WHERE id = :id';
        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
    }
}
