<?php 
    class Painel{
        public static function alert($tipo, $msg){
            echo "<div class='box-alert $tipo text-center'>$msg</div>";
        }

        public static function login($table, $user, $password){
            $sql = MySql::connect()->prepare("SELECT * FROM `$table` WHERE user=? AND password=?");
            $sql->execute(array($user, $password));
            if($sql->rowCount() == 1){
                return true;
            }
            return false;
        }

        public static function loggout(){
            session_destroy();
            self::redirect_to();
        }

        public static function redirect_to($url=INCLUDE_PATH_PAINEL){
            echo "<script>window.location.assign('".$url."')</script>";
        }

        public static function access_counter($table, $date = null){
            if($date != null){
                $sql = MySql::connect()->prepare("SELECT * FROM `$table` WHERE date = ?");
                $sql->execute(array($date));
            }else{
                $sql = MySql::connect()->prepare("SELECT * FROM `$table`");
                $sql->execute();
            }
            return $sql->rowCount();
        }

        public static function already_exists($table, $key, $value){
            $sql = MySql::connect()->prepare("SELECT * FROM `$table` WHERE ? = ?");
            $sql->execute(array($key, $value));
            if($sql->rowCount() > 0){
                return true;
            }
            return false;
        }

        public static function add_online($token){
            $data_atual = date("Y-m-d H:i:s");
            if($token != "" && isset($token)){
                if(!self::already_exists("tb_admin.online", "token", $token)){
                    $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.online` VALUES (null, ?, ?)");
                    $sql->execute(array($token, $data_atual));
                    
                    $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.visitas` VALUES (null, ?, ?)");
                    $sql->execute(array($token, $data_atual));
                }
            }
        }

        public static function update_online($token){
            $data_atual = date("Y-m-d H:i:s");
            $sql = MySql::connect()->prepare("UPDATE `tb_admin.online` SET date = ? WHERE token = ?");
            $sql->execute(array($data_atual, $token));

            $sql = MySql::connect()->prepare("UPDATE `tb_admin.visitas` SET date = ? WHERE token = ?");
            $sql->execute(array($data_atual, $token));
        }

        public static function remove_online($table, $type){
            $now = date("Y-m-d H:i:s");
            if($type == 1){
                $sql = MySql::connect()->prepare("DELETE FROM `$table` WHERE date < ? - INTERVAL 1 MINUTE");
                $sql->execute(array($now));
            }else if($type == 2){
                $sql = MySql::connect()->prepare("DELETE FROM `$table` WHERE date < ? - INTERVAL 1 WEEK");
                $sql->execute(array($now));
            }
        }

        public static function remove_chat(){
            $sql = MySql::connect()->prepare("DELETE FROM `tb_admin.chat`");
            $sql->execute();
        }

        public static function logado(){
            return isset($_SESSION['login-chat']) ? true : false;
        }
    }
?>