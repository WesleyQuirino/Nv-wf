<?php
    require_once("templates/header.php");
    require_once("dao/UserDAO.php");
    require_once("models/Message.php");

    $message = new Message($BASE_URL);

    $userDao = new UserDao($conn, $BASE_URL);

    $userDao->destroyToken();