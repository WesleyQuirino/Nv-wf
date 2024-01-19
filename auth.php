<?php
    require_once("templates/header.php");
?>
<div id="app">
    <section>
        <form action="<?php echo $BASE_URL; ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="sign_in">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Digite seu email">
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" placeholder="Digite sua senha">
            <input type="submit" value="Entrar">
        </form>
    </section>
    <aside>
        <form action="<?php echo $BASE_URL; ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="registering">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" require placeholder="Digite seu nome">
            <label for="last_name">Sobre nome:</label>
            <input type="text" name="last_name" id="last_name" require placeholder="Digite seu sobre nome">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" require placeholder="Digite seu email">
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" require placeholder="Digite sua senha">
            <label for="confirm_password">Confirmar:</label>
            <input type="password" name="confirm_password" id="confirm_password" require placeholder="Confirme sua senha">
            <input type="submit" value="Criar">
        </form>
    </aside>
</div>