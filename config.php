<?php 
    session_start();
    date_default_timezone_set("America/Sao_Paulo");
    $autoload = function($class){
        include("classes/$class.php");
    };
    spl_autoload_register($autoload);

    #http://localhost/code-spirit/
    define("INCLUDE_PATH", "http://localhost/code-spirit/");
    define("INCLUDE_PATH_PAINEL", INCLUDE_PATH."painel-adm/");
    
    define("HOST", "localhost");
    define("DBNAME", "code-spirit");
    define("USER", "root");
    define("PASSWORD", "");

    $fixed_footer = false;
?>