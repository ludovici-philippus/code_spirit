<?php include("config.php");?>
<?php require("./vendor/autoload.php");?>
<?php 
    $url = isset($_GET['url']) ? $_GET["url"] : "home";
    if(!isset($_SESSION["token"])){
        $_SESSION['token'] = uniqid();
        Painel::add_online($_SESSION['token']);
    }else{
        Painel::update_online($_SESSION['token']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Spirit - Desenvolvimento de Web Sites</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/style.css">
    <meta name="description" content="Code spirit é uma agência de desenvolvimento de web sites e sistemas web de Curitiba para que atende o Brasil todo.">
    <meta name="keywords" content="code spirit, code spirit desenvolvimento de websites, desenvolvimento de websites, desenvolvimento de sites curitiba, desenvolvimento de sites, programação">
    <meta name="author" content="Code Spirit - Luis Felipe">
    <link rel="canonical" href="https://codespirit.com.br/">
    
    <meta property="og:title" content="Code Spirit - Desenvolvimento de Web Sites">
    <meta property="og:site_name" content="Mentoria Corpo dos Sonhos">
    <meta property="og:description" content="Code spirit é uma agência de desenvolvimento de web sites e sistemas web de Curitiba para que atende o Brasil todo!">
    <meta property="og:url" content="https://codespirit.com.br/">
    <meta property="og:image" content="https://codespirit.com.br/images/codespirit-banner.jpg">
    <meta property="og:image:type" content="image/jpeg">

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MRF60MHZKR"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-MRF60MHZKR');
    </script>
    <script src="https://kit.fontawesome.com/53f10bde57.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <header>
        <div class="header__bg bg <?php if($url != "home"){echo 'limit-to-title';} ?>">
            <div class="overlay <?php if($url != "home"){echo 'limit-to-title';} ?>">
                <h1 class="left"><a href="<?php echo INCLUDE_PATH; ?>">Code Spirit</a></h1>
                <nav class="right desktop" id="navigation">
                    <ul>
                        <li><a title="Home" href="<?php echo INCLUDE_PATH;?>home">Home</a></li>
                        <li><a title="Como funciona" class="one-page" goto="como-funciona" href="<?php echo INCLUDE_PATH;?>">Como funciona?</a></li>
                        <li><a title="Diferenciais" class="one-page" goto="diferenciais" href="<?php echo INCLUDE_PATH;?>">Diferenciais</a></li>
                        <li><a title="Contato" class="btn contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
                    </ul>
                </nav>
                <nav class="right mobile" id="navigation">
                    <i id="mobile_menu"class="fas fa-bars"></i>
                    <ul id="ul_mobile">
                        <li><a href="<?php echo INCLUDE_PATH;?>home">Home</a></li>
                        <li><a class="one-page" goto="como-funciona" href="<?php echo INCLUDE_PATH;?>">Como funciona?</a></li>
                        <li><a class="one-page" goto="diferenciais" href="<?php echo INCLUDE_PATH;?>">Diferenciais</a></li>
                        <li><a class="btn contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
                    </ul>
                </nav>
                <div class="clear"></div>
                <div class="header__conteudo <?php if($url != "home"){echo "hide";}?> right">
                    <h2>Sites próprios para empresas autênticas</h2>
                    <q>Em um futuro breve, empresas farão negócios na internet ou não farão negócio algum</q>
                    <p>- Bill Gates</p>
                    <p>Criação de sites e sistemas web</p>
                    <br>
                    <a class="btn one-page" goto="diferenciais" href="<?php echo INCLUDE_PATH;?>">Ver diferenciais!</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </header>
    <main>
        <?php 
            if(file_exists("./pages/$url.php")){
                include("./pages/$url.php");
            }else{
                include("./pages/home.php");
            }
        ?>
    </main>
    <footer <?php if($url == "404") echo "class='fixed-footer'"?>>
        <p style="position:relative; bottom:0;">Todos os direitos reservados © Code Spirit</p>
        <div class="w100 left">
            <p>Siga-nos nas mídias sociais!</p>
            <a style="color: black; background-color: white; display:inline-block; width: 32px; height: 32px; border-radius: 50%; font-size: 22px;" target="_blank" rel="external" href="https://www.instagram.com/codespiritreal/"><i style="position:relative; top:48%; transform: translateY(-50%);" class="fa fa-instagram"></i></a>
            <a style="color: black; background-color: white; display:inline-block; width: 32px; height: 32px; border-radius: 50%; font-size: 22px;" target="_blank" rel="external" href="https://www.facebook.com/Code-Spirit-111786764604934/"><i style="position:relative; top:48%; transform: translateY(-50%);" class="fa fa-facebook"></i></a>
        </div>
        <div class="clear"></div>
    </footer>

    <script src="<?php echo INCLUDE_PATH;?>js/script.js"></script>
</body>
</html>