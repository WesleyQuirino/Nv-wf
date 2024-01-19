<?php 
    require_once('models/Company.php');
    require_once('models/Message.php');

    class CompanyDAO implements CompanyDAOInterface{
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }
        
        public function buildCompany($data){
            $company = new Company();

            $company->id = $data["id"];
            $company->name = $data["name"];
            $company->fantasy_name = $data["fantasy_name"];
            $company->prefix = $data["prefix"];
            $company->cnpj = $data["cnpj"];
            $company->image = $data["image"];

            return $company;
        }

        public function findAll(){
            $stmt = $this->conn->prepare("SELECT * FROM company");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $companies = [];

                $data = $stmt->fetchAll();

                foreach($data as $company){
                    $company = $this->buildCompany($company);

                    $companies[] = $company;
                }

                return $companies;
            } else {
                return false;
            }
        }

        public function findByName($name){
            $stmt = $this->conn->prepare("SELECT * FROM company WHERE name = :name");
            
            $stmt->bindParam(":name", $name);
            
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $data = $stmt->fetch();

                return $company = $this->buildCompany($data);
            }else {
                return false;
            }
        }
        
        public function findByCnpj($cnpj){
            $stmt = $this->conn->prepare("SELECT * FROM company WHERE cnpj = :cnpj");
            
            $stmt->bindParam(":cnpj", $cnpj);
            
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $data = $stmt->fetch();

                return $company = $this->buildCompany($data);
            }else {
                return false;
            }
        }

        public function findById($id){
            $stmt = $this->conn->prepare("SELECT * FROM company WHERE id = :id");
            
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $data = $stmt->fetch();

                return $company = $this->buildCompany($data);
            }else {
                return false;
            }
        }

        public function create(Company $company){

            $stmt = $this->conn->prepare("INSERT INTO company(name, fantasy_name, prefix, cnpj, image) VALUES(:name, :fantasy_name, :prefix, :cnpj, :image)");
            $stmt->bindParam(":name", $company->name);
            $stmt->bindParam(":fantasy_name", $company->fantasy_name);
            $stmt->bindParam(":prefix", $company->prefix);
            $stmt->bindParam(":cnpj", $company->cnpj);
            $stmt->bindParam(":image", $company->image);

            $stmt->execute();
        }

        public function update(Company $company, $redirect = false){
            $stmt = $this->conn->prepare("UPDATE company SET name = :name, fantasy_name = :fantasy_name, prefix = :prefix, cnpj = :cnpj, image = :image WHERE id = :id");
            $stmt->bindParam(":id", $company->id);
            $stmt->bindParam(":name", $company->name);
            $stmt->bindParam(":fantasy_name", $company->fantasy_name);
            $stmt->bindParam(":prefix", $company->prefix);
            $stmt->bindParam(":cnpj", $company->cnpj);
            $stmt->bindParam(":image", $company->image);

            $stmt->execute();

            if($redirect){
                $this->message->setMessage("Dados atualizados com sucesso!", "success", "back");
            }
        }

        public function destroy($id){

        }

    }