<?php 
    require_once("db.php");
    require_once("globals.php");
    require_once("models/Company.php");
    require_once("models/Message.php");
    require_once("dao/CompanyDAO.php");
    
    $message = new Message($BASE_URL);
    
    $companyDao = new CompanyDao($conn, $BASE_URL);

    $name = filter_input(INPUT_POST, "name");
    $fantasy_name = filter_input(INPUT_POST, "fantasy_name");
    $prefix = filter_input(INPUT_POST, "prefix");
    $cnpj = filter_input(INPUT_POST, "cnpj");
    $image = filter_input(INPUT_POST, "image");

    if($name != "" && $fantasy_name != "" && $prefix != "" && $cnpj != ""){
        if(!$companyDao->findByName($name) || !$companyDao->findByCnpj($cnpj)){
            $company = new Company();

            $company->name = $name;
            $company->fantasy_name = $fantasy_name;
            $company->prefix = $prefix;
            $company->cnpj = $cnpj;

            if($image != ""){
                $company->image = $image;
            }

            $companyDao->create($company);

            $message->setMessage("Empresa cadastrada com sucesso!", "success", "companies.php");
        }
    }