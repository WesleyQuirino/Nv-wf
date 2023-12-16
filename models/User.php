<?php 
    class User {
        public $id;
        public $company_id;
        public $name;
        public $lastName;
        public $email;
        public $password;
        public $token;
        public $image;
        public $authorizations;

        public function getFullName($name, $lastName){
            return $name . ' ' . $lastName;
        }
        
        public function generateToken(){
            return bin2hex(random_bytes(50));
        }

        public function generatePassword($password){
            return password_hash($password, PASSWORD_DEFAULT);
        }
        
        public function imageGenerateName(){
            return bin2hex(random_bytes(50)) . "jpg";
        }
    }

    interface UserDAOInterface{
        public function buildUser($data);
        public function createUser(User $data);
        public function updateUser(User $data);
        public function verifyToken($protected = false);
        public function setTokenToSession($token, $redirect = true);
        public function destroyToken();
        public function authenticateUser($email, $password);
        public function findById($id);
        public function findByEmail($email);
        public function findByToken($token);
        public function changePassword(User $data);
    }