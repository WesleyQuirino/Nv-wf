<?php
    class Company {
        public $id;
        public $name;
        public $fantasy_name;
        public $prefix;
        public $cnpj;
        public $image;

        public function imageGenerateName(){
            return bin2hex(random_bytes(50)) . "jpg";
        }
    }

    interface CompanyDAOInterface{
        public function buildCompany($data);
        public function findAll();
        public function findByName($name);
        public function findByCnpj($cnpj);
        public function findById($id);
        public function create(Company $company);
        public function update(Company $company);
        public function destroy($id);
    }