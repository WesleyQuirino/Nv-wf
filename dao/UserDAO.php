<?php 
    require_once('models/User.php');
    require_once('models/Company.php');
    require_once('models/Message.php');

    class UserDAO implements UserDAOInterface{
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }
        
        public function buildUser($data){
            $user = new User();
            
            $user->id = $data["id"];
            $user->company_id = $data["company_id"];
            $user->name = $data['name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->image = $data['image'];
            $user->token = $data['token'];
            $user->authorizations = $data['authorizations'];

            return $user;
        }

        public function buildCompany($data){
            $company = new Company();
            
            $company->id = $data["id"];
            $company->company_id = $data["company_id"];
            $company->name = $data['name'];
            $company->last_name = $data['last_name'];
            $company->email = $data['email'];
            $company->password = $data['password'];
            $company->image = $data['image'];
            $company->token = $data['token'];
            $company->authorizations = $data['authorizations'];

            return $company;
        }

        public function createUser(User $data, $authUser = false){
            $stmt = $this->conn->prepare("INSERT INTO users(name, last_name, email, password, token) VALUES(:name, :last_name, :email, :password, :token)");
            $stmt->bindParam(":name", $data->name);
            $stmt->bindParam(":last_name", $data->last_name);
            $stmt->bindParam(":email", $data->email);
            $stmt->bindParam(":password", $data->password);
            $stmt->bindParam(":token", $data->token);

            $stmt->execute();

            if($authUser){
                $this->setTokenToSession($data->token);
            }
        }

        public function updateUser(User $data, $redirect = true){
            $stmt = $this->conn->prepare("UPDATE users SET name = :name, last_name = :last_name, email = :email, image = :image, token = :token WHERE id = :id");
            $stmt->bindParam(":id", $data->id);
            $stmt->bindParam(":name", $data->name);
            $stmt->bindParam(":last_name", $data->last_name);
            $stmt->bindParam(":email", $data->email);
            $stmt->bindParam(":image", $data->image);
            $stmt->bindParam(":token", $data->token);

            $stmt->execute();

            if($redirect){
                $this->message->setMessage("Dados atualizados com sucesso!", "success", "edit_Profile.php");
            }
        }

        public function verifyToken($protected = false){
            if(!empty($_SESSION["token"])){
                $token = $_SESSION["token"];

                $user = $this->findByToken($token);

                if($user){
                    return $user;
                } else if($protected){
                    $this->message->setMessage("Usuário não encontrado!", "erro", "index.php");
                }
            } else if($protected){
                $this->message->setMessage("Faça autenticação para continuar!", "erro", "index.php");
            }
        }

        public function setTokenToSession($token, $redirect = true){
            $_SESSION["token"] = $token;

            if($redirect){
                $this->message->setMessage("Usuario logado!", "success", "edit_Profile.php");
            }
        }
        
        public function destroyToken(){
            $_SESSION["token"] = "";
            
            $this->message->setMessage("Usuário deslogado!", "success", "index.php");
        }

        public function authenticateUser($email, $password){
            $user = $this->findByEmail($email);

            if($user){
                if(password_verify($password, $user->password)){
                    $token = $user->generateToken();

                    $this->setTokenToSession($token, false);

                    $user->token = $token;
                    
                    $this->updateUser($user, false);

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function findCompany($company_id){
            if($company_id != ""){
                
                $stmt = $this->conn->prepare("SELECT * FROM company WHERE id = :id");

                $stmt->bindParam(":id", $company_id);

                $stmt->execute();
                if($stmt->rowCount() > 0){
                    $data = $stmt->fetch();

                    $company = $this->buildCompany($data);

                    return $company;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function findById($id){
            if($id != ""){
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");

                $stmt->bindParam(":id", $id);

                $stmt->execute();

                if($stmt->rowCount() > 0){
                    $user = $this->buildUser($stmt->fetch());

                    return $user;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        public function findByEmail($email){
            if($email != ""){
                
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");

                $stmt->bindParam(":email", $email);

                $stmt->execute();
                if($stmt->rowCount() > 0){
                    $data = $stmt->fetch();

                    $user = $this->buildUser($data);

                    return $user;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function findByToken($token){
            if($token != ""){
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");

                $stmt->bindParam(":token", $token);

                $stmt->execute();

                if($stmt->rowCount() > 0){
                    $data = $stmt->fetch();

                    $user = $this->buildUser($data);

                    return $user;
                }else{
                    return false;
                }
            } else{
                return false;
            }
        }

        public function userAuthorizations($email){
            if($email != ""){
                
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");

                $stmt->bindParam(":email", $email);

                $stmt->execute();

                if($stmt->rowCount() > 0){
                    $data = $stmt->fetch();

                    $user = $this->buildUser($data);

                    if($user->authorizations === "Admin"){
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function changePassword(User $user){
            $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->bindParam(":id", $data->id);
            $stmt->bindParam(":password", $data->password);

            $stmt->execute();

            if($redirect){
                $this->message->setMessage("Senha atualizada com sucesso!", "success", "edit_Profile.php");
            }
        }
    }
?>