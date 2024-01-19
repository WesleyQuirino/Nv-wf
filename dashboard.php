<?php
    require_once("templates/header.php");
    require_once("dao/UserDAO.php");
    require_once("models/User.php");
    require_once("dao/CompanyDAO.php");

    $user = new User();

    $userDao = new UserDao($conn,  $BASE_URL);

    $userData = $userDao->verifyToken(true);

    $message = new Message($BASE_URL);
    
    $companyDao = new CompanyDao($conn,  $BASE_URL);

    $fullName = $user->getFullName($userData->name, $userData->last_name);

    $id;

    if(isset($_GET["id"])){
        $id = $_GET["id"];
    } else {
        $id = $_POST["id"];
    }

    $company = $companyDao->findById($id);

    if($userData->company_id != $company->id && $userData->authorizations != "Admin"){
        $message->setMessage("Usuário não autorizado!", "error");
    }

?>

<h1><?php echo $company->name ;?></h1>