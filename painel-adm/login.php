<?php 
    if(isset($_POST['acao'])){
        $user = $_POST["user"];
        $password = md5($_POST["password"]);
        if(Painel::login("tb_admin.users", $user, $password)){
            $_SESSION["login"] = true;
            $_SESSION["user"] = $user;
            $_SESSION["password"] = $password;
            header("Location: ".INCLUDE_PATH_PAINEL);
            die();
        }else{
            Painel::alert("erro", "Algo deu errado");
        }
    }
?>

<div class="login-box">
    <h1 class="text-center">Formulário de Login</h1>
    <form method='post'>
        <input type="text" name="user">
        <input type="password" name="password">
        <input type="submit" value="Logar" name="acao">
    </form>
</div>