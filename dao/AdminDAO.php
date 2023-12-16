<?php 
    require('models/Admin.php');

    class AdminDAO implements AdminDAOInterface{
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->message = $message;
        }
        
        public function buildAdmin($data){
            $admin = new Admin();
            
            $admin->id = $data['id'];
            $admin->name = $data['name'];
            $admin->last_name = $data['last_name'];
            $admin->email = $data['email'];
            $admin->image = $data['image'];

            return $user;
        }

        public function createAdmin(Admin $data){

        }

        public function updateAdmin(Admin $data){

        }

        public function findById($adminId){

        }

        public function findByName($name){

        }

        public function changePassword(Admin $admin){

        }

    }