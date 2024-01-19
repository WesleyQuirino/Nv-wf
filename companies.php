<?php
    require_once("templates/header.php");
    require_once("dao/UserDAO.php");
    require_once("dao/CompanyDAO.php");
    require_once("models/User.php");
    require_once("models/Message.php");

    $message = new Message($BASE_URL);

    $user = new User();

    $userDao = new UserDao($conn,  $BASE_URL);
    
    $companyDao = new CompanyDao($conn,  $BASE_URL);

    $userData = $userDao->verifyToken(true);

    $searchcompanies = [];

    if(!$userData || $userData->authorizations !== "Admin"){
        $message->setMessage("Você não tem autorização para acessar esta página", "error", "index.php");
    }

    if($userData->image == ""){
        $userData->image = "user.png";
    }

    $companies = $companyDao->findAll();

?>
<div id="app">
    <h1>Nv-WorkFlow</h1>
    <form action="<?php echo $BASE_URL?>create_company.php" method="POST" enctype="multipart/form-data" id="create-company">
        <input type="hidden" name="type" value="create">
        <label for="name">Nome da Empresa</label>
        <input type="text" name="name" id="name" placeholder="Digite o nome da empresa">
        <label for="fantasy_name">Nome fantasia</label>
        <input type="text" name="fantasy_name" id="fantasy_name" placeholder="Digite o nome fantasia da empresa">
        <label for="prefix">Prefixo</label>
        <input type="text" name="prefix" id="prefix" placeholder="Digite o prefixo da empresa">
        <label for="cnpj">Cnpj</label>
        <input type="text" name="cnpj" id="cnpj" placeholder="Digite o Cnpj da empresa">
        <label for="image">Logo da empresa</label>
        <input type="file" name="image" id="image">
        <input type="submit" value="Enviar">
    </form>
    <div class="search">
        <form action="<?php echo  $BASE_URL; ?>dashboard.php" method="GET">
            <label for="search">Selecione uma empresa:</label>
            <select id="search" name="id" type="search">
                <?php foreach($companies as $company){?>
                <option value="<?php echo $company->id;?>"><?php echo $company->name;?></option>
                <?php }?>
            </select>
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <?php
        foreach($companies as $company){ 
            if(empty($company->image)){
                $company->image = "images/companies/company_logo.png";
            } ?>
            <div class="card-company">
                <a href="<?php echo  $BASE_URL; ?>dashboard.php?id=<?php echo  $company->id; ?>" class="company-link">
                    <img src="<?php echo  $BASE_URL . $company->image;?>" alt="Logo da empresa" class="company-image" height="50px" width="50px">
                    <h2 class="company-name"><?php echo $company->name; ?></h2>
                </a>
            </div>
    <?php }?>
</div>

<?php
  require("templates/footer.php");
?>