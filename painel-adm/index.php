<?php require("../config.php");?>
<?php if(isset($_GET['loggout'])) Painel::loggout();?>
<?php 
Painel::remove_online("tb_admin.online", 1, $_SESSION['token']);
Painel::remove_online("tb_admin.visitas", 2, $_SESSION['token']);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Code Spirit</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL;?>css/style.css">
</head>
<body>
    <?php 
        if(isset($_SESSION['login']) and $_SESSION["login"] == true){
            include("./main.php");
        }else{
            include("./login.php");
        }
    ?>
</body>
</html>