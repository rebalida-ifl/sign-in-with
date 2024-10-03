<?php

namespace App;

use PDO;
use PDOException;

class User{
    private $conn;
    private $table = 'usertable';

    public $id;
    public $email;
    public $username;
    public $password;

    public function __construct($db){
        $this->conn = $db;
    }

    public function register(){
        $query = 'INSERT INTO ' . $this->table . ' (email, username, password) VALUES (:email, :username, :password)';
        $stmt = $this->conn->prepare($query);

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);

        if($stmt->execute()){   
            return true;
        }   

        return false;

    }

    public function login(){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email); 
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(password_verify($this->password, $row['password'])){
                $this->id = $row['id'];
                $this->username = $row['username'];
                return true;
            }
        }
        return false;
    }

    public function emailExist(){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute(); 

        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

}