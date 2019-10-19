<?php
namespace Src\TableGateways;

class UserGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findUser($username)
    {
        $statement = "
            SELECT 
                id, name, username, password
            FROM
                users
            WHERE
                username = :username;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'username' => $username
            ));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $input)
    {
        $statement = "
            INSERT INTO users 
                (name, username, password, email)
            VALUES
                (:name, :username, :password, :email);
        ";

        try {
            $statement = $this->db->prepare($statement);
            $password = password_hash($input['password'], PASSWORD_DEFAULT);
            $statement->execute(array(
                'name' => $input['name'],
                'username'  => $input['username'],
                'password' => $password,
                'email' => $input['email'],
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

}