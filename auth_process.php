<?php
    require_once("db.php");
    require_once("globals.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $userDao = new UserDao($conn, $BASE_URL);

    //Filter POST input
    $type = filter_input(INPUT_POST, "type");

    if($type === "sign_in"){
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");

        if($userDao->authenticateUser($email, $password)){
            if($userDao->userAuthorizations($email)){
                $message->setMessage("Usuário logado com sucesso", "success", "companies.php");
            } else{
                $message->setMessage("Usuário logado com sucesso", "success", "dashboard.php");
            }
        } else{
            $message->setMessage("Usuário ou senha incorretos!", "error", "back");
        }
    } else if($type === "registering"){
        $company_id = filter_input(INPUT_POST, "company_id");
        $name = filter_input(INPUT_POST, "name");
        $last_name = filter_input(INPUT_POST, "last_name");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirm_password = filter_input(INPUT_POST, "confirm_password");

        if($name && $last_name && $email && $password && $confirm_password){
            if($password == $confirm_password){
                if(!$userDao->findByEmail($email)){
                    $user = new User();
                    
                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);
    
                    $user->company_id = $company_id;
                    $user->name = $name;
                    $user->last_name = $last_name;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;
    
                    $auth = true;
    
                    $userDao->createUser($user, $auth);

                    $message->setMessage("Usuário cadastrado com sucesso!", "success", "dashboard.php?id=" . $company_id);
                } else{
                    $message->setMessage("Email já cadastrado!", "error", "back");
                }
            } else{
                $message->setMessage("As senhas devem ser iguais!", "error", "back");
            }
        } else{
            $message->setMessage("Preencha todos os campos para continuar!", "error", "back");
        }
    } else{
        $message->setMessage("Infomações invalidas!", "error", "index.php");
    }