<?php
    Class Admin{
        public $id;
        public $name;
        public $lastName;
        public $email;
        public $password;
        public $token;

        public function getFullName($name, $lastName){
            return $name . ' ' . $lastName;
        }
    }

    interface AdminDAOInterface{
        public function buildAdmin($data);
        public function createAdmin(Admin $data);
        public function updateAdmin(Admin $data);
        public function findById($adminId);
        public function findByName($name);
        public function changePassword(Admin $admin);
    }