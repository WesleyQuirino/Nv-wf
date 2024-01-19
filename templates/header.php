<?php 
    require_once('globals.php');
    require_once('db.php');
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $flassMessage = $message->getMessage();

    if(!empty($flassMessage["msg"])) {
      $message->clearMessage();
    }
      
    $user = new User();
    $userDao = new UserDAO($conn, $BASE_URL);
    $userData = $userDao->verifyToken(false);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nv-WF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo $BASE_URL; ?>styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  </head>
  <body>
    <header>
      <nav id="main-navbar">
        <button class="nav-btn"><a href="<?php echo $BASE_URL . "configurations.php?id=" . $id; ?>"><i class="fa-solid fa-gear"></i></a></button>
        <a href="<?php if(!empty($userData)){ echo $BASE_URL . "dashboard.php?id=" . $id; } else { echo $BASE_URL . "index.php"; } ?>">Nv-workflow</a>
        <button class="nav-btn"><i class="fas fa-bars"></i></button>
        <ul class="nav-links">
          <?php if(!empty($userData)){?>
            <li><a href="<?php echo $BASE_URL; ?>logout.php" class="nav-link">Sair</a></li>
          <?php }else{?>
            <li><a href="<?php echo $BASE_URL; ?>auth.php" class="nav-link">Entrar/Cadastrar</a></li>
          <?php }?>
        </ul>
      </nav>
    </header>
    <?php if($flassMessage){?>
      <p><?php echo $flassMessage["msg"];?></p>
    <?php }?>