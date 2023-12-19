<?php
    require_once("templates/header.php");
?>
<div id="app">
    <section>
        <form action="<?php echo $BASE_URL; ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="login">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="Digite seu email">
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" placeholder="Digite sua senha">
            <input type="submit" value="Entrar">
        </form>
    </section>
    <aside>
        <form action="<?php echo $BASE_URL; ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="sign_in">
        </form>
    </aside>
</div>