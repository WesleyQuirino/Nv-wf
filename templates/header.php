<?php 
    require_once('globals.php');
    require_once('db.php');
    require_once("dao/UserDAO.php");

    
  $user = new User();
  $userDao = new UserDAO($conn, $BASE_URL);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nv-WF</title>
    <link rel="stylesheet" href="styles/style.css">
  </head>
  <body>
    <header>
      <nav>
        
      </nav>
    </header>