<?php
    require_once("db.php");
    require_once("globals.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $userDao = new UserDao($conn, $BASE_URL);

    //Filter POST input
    $type = filter_input(INPUT_POST, "type");

    if($type === "login"){
        echo '<p> Login </p>';
    } else if($type === "sign_in"){
        echo '<p> Sing in </p>';
    } else{
        $message->setMessage("Infomações invalidas", "error", "index.php");
    }