<?php 
    class User {
        public $id;
        public $name;
        public $password;

        public function generatePassword($password){
            return password_hash($password, PASSWORD_DEFAULT);
        }
    }

    interface UserDAOInterface{
        public function buildUser($data);
        public function createUser(User $data);
        public function updateUser(User $data);
        public function findById($userId);
        public function findByName($name);
        public function changePassword(User $user);
    }