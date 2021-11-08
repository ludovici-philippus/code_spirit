<?php 
    if(isset($_POST['acao'])){
        $user = $_POST["user"];
        $password = md5($_POST["password"]);
        $sql = MySql::connect()->prepare("SELECT nome, id FROM `tb_admin.membros` WHERE user=? AND password=?");
        $sql->execute(array($user, $password));
        $info = $sql->fetch();
        $id_chat = $info['id'];
        $nome = $info['nome'];
        if($sql->rowCount() == 1){
            $_SESSION["login-chat"] = true;
            $_SESSION['id-chat'] = $id_chat;
            $_SESSION["user-chat"] = $user;
            $_SESSION['nome-chat'] = $nome;
            $_SESSION["password-chat"] = $password;
            Painel::redirect_to(INCLUDE_PATH."chat");
        }else{
            Painel::alert("erro", "Algo deu errado");
            Painel::redirect_to(INCLUDE_PATH."chat");
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