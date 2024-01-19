<?php 
    class User {
        public $id;
        public $company_id;
        public $name;
        public $last_name;
        public $email;
        public $password;
        public $token;
        public $image;
        public $authorizations;

        public function getFullName($name, $last_name){
            return $name . ' ' . $last_name;
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
        public function buildCompany($company_id);
        public function createUser(User $data);
        public function updateUser(User $data);
        public function verifyToken($protected = false);
        public function setTokenToSession($token, $redirect = true);
        public function destroyToken();
        public function authenticateUser($email, $password);
        public function findCompany($id);
        public function findById($id);
        public function findByEmail($email);
        public function findByToken($token);
        public function userAuthorizations($email);
        public function changePassword(User $data);
    }