<?php 

    class MySql{
        private static $pdo;
        public static function connect(){
            if(self::$pdo == null){
                try{
                    self::$pdo = new PDO("mysql:host=".HOST.";dbname=".DBNAME, USER, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                }
                catch(Throwable $th){
                    echo "<h1>ERRO AO CONECTAR!</h1>";
                }
            }
            return self::$pdo;
        }
    }
?>