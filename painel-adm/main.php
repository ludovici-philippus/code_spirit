<?php 
    $url = isset($_GET['url']) ? $_GET['url'] : "home";
?>
<header>
    <div class="container">
        <a href="?loggout" class="right">Loggout</a>
        <div class="clear"></div>
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