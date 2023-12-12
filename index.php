<?php
  require("templates/header.php");
  $user = new User();

  $userDao = new UserDAO($conn, $BASE_URL);

  $userData = $userDao->findById(1);
?>
<div id="app">
  <h1><?php echo $userData->name;?></h1>
</div>
<?php
  require("templates/footer.php");
?>