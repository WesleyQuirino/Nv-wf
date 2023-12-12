<?php 
    require('models/User.php');

    class UserDAO implements UserDAOInterface{
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;

        }
        
        public function buildUser($data){
            $user = new User();
            
            $user->id = $data['id'];
            $user->name = $data['name'];
            $user->password = $data['password'];

            return $user;
        }

        public function createUser(User $data){

        }

        public function updateUser(User $data){

        }

        public function findById($id){
            if($id != ""){
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");

                $stmt->bindParam(":id", $id);

                $stmt->execute();

                if($stmt->rowCount() > 0){
                    $user = $this->buildUser($stmt->fetch());

                    return $user;
                }
            } else {
                return false;
            }
        }

        public function findByName($name){

        }

        public function changePassword(User $user){

        }



    }
?>