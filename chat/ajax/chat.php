<?php 
    include("../../config.php");
    $data['sucesso'] = true;
    $data['mensagem'] = "";
    if(!Painel::logado()){
        Painel::alert("erro", "Você não está logado!");
        Painel::redirect_to(INCLUDE_PATH."chat");
    }
    else{
        if(isset($_POST['insert'])){
            $mensagem = $_POST['mensagem'];
            if($mensagem != ""){
                $has_link = count(explode(":a", $mensagem)) > 1 && count(explode("a:", $mensagem)) > 1;
            $has_image = count(explode(":img", $mensagem)) > 1 && count(explode(("img:"), $mensagem)) > 1;

            if($has_image){
                $image = explode(":img", $mensagem)[1];
                $image = explode("img:", $image)[0];

                $mensagem_sem_imagem = explode(":img", $mensagem);
                $mensagem_1 = $mensagem_sem_imagem[0];
                $mensagem_sem_imagem = explode("img:", $mensagem);
                $mensagem_2 = $mensagem_sem_imagem[1];
                $mensagens = array($mensagem_1, $mensagem_2);
                $mensagem_sem_imagem = implode($mensagens);

                $mensagem = "<div class='imagem-chat'> <img src='$image'></div>".$mensagem_sem_imagem;
            }

            if($has_link){
                $link = explode(":a", $mensagem)[1];
                $link = explode("a:", $link)[0];

                /*
                $is_youtube = count(explode("youtube", $link)) > 1 || count(explode("youtu.be",$link)) > 1;
                if($is_youtube && count(explode("youtube", $mensagem)) > 1){
                    $link = str_replace("youtube.com/", "youtube.com/embed/", $link);
                    $link = str_replace("watch?v=", "", $link);

                }else if($is_youtube && count(explode("youtu.be",$mensagem)) > 1){
                    $link = str_replace("youtu.be/", "www.youtube.com/embed/", $link);
                }
                */
                $mensagem = str_replace(":a", "<a target='_blank' rel='external' href='$link'>", $mensagem);
                $mensagem = str_replace("a:", "</a>", $mensagem);
                /*
                if($is_youtube)
                    $mensagem = "<div class='iframe-chat'> <iframe src='$link'></iframe></div>".$mensagem;
                    */
            }else{
                $mensagem = "<p>$mensagem</p>";
            }
            $nome = $_SESSION['nome-chat'];
            $id_user = $_SESSION['id-chat'];
            $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.chat` VALUES(null, ?, ?)");
            $sql->execute(array($id_user, $mensagem));
            
            echo "<div class='chat-mensagem'>
            <h4>$nome: </h4>
            $mensagem
            </div>";
            }
        }
        else if(isset($_POST['get_messages'])){
            $total = MySql::connect()->prepare("SELECT id FROM `tb_admin.chat` ORDER BY id DESC");
            $total->execute();;
            $last_id = $total->fetch()['id'];
            $total = $total->fetchAll();
            if(count($total) + 1 > 10){
                $sql = MySql::connect()->prepare("DELETE FROM `tb_admin.chat` WHERE id < ?");
                $sql->execute(array($last_id-10));
            }

            $mensagens = MySql::connect()->prepare("SELECT * FROM `tb_admin.chat` ORDER BY id DESC LIMIT 10");
            $mensagens->execute();
            $mensagens = $mensagens->fetchAll();
            $mensagens = array_reverse($mensagens);
            foreach ($mensagens as $key => $value) {
                $user = MySql::connect()->prepare("SELECT nome FROM `tb_admin.membros` WHERE id = ?");
                $user->execute(array($value['membro_id']));
                $user = $user->fetch()['nome'];
                echo "<div class='chat-mensagem'>
                    <h4>".$user.": </h4>
                    <p>".$value['mensagem']."</p>
                    </div>";
            }
        }
    }
?>