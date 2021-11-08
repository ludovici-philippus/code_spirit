<?php require("../config.php");?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Super Secreto dos Guri</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL;?>css/style.css">
</head>
<body>
    <?php 
        if(isset($_SESSION['login-chat']) and $_SESSION["login-chat"] == true){
            include("./main.php");
        }else{
            include("./login.php");
        }
    ?>
</body>
</html>