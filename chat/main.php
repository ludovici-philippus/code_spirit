<?php 
    if(isset($_GET['deletar']) && Painel::logado()){
        Painel::remove_chat();
        Painel::redirect_to(INCLUDE_PATH."chat");
    }
    $mensagens = MySql::connect()->prepare("SELECT * FROM `tb_admin.chat` ORDER BY id DESC LIMIT 10");
    $mensagens->execute();
    $mensagens = $mensagens->fetchAll();
    $mensagens = array_reverse($mensagens);
?>
<main>
    <section class="chat-box">
        <div class="container">
            <div class="chat box">
            <h2>Chat super secreto dos guri</h2>
            <a class="btn-deletar" href="?deletar=true">Deletar tudo!</a>
                <div class="conteudo">
                <?php foreach ($mensagens as $key => $value) { 
                    $user = MySql::connect()->prepare("SELECT nome FROM `tb_admin.membros` WHERE id = ?");
                    $user->execute(array($value['membro_id']));
                    $user = $user->fetch()['nome']; ?>
                    <div class="chat-mensagem">
                        <h4><?php echo $user; ?></h4>
                        <p><?php echo $value['mensagem']; ?></p>
                    </div>    
                <?php }?>
                </div>
            </div>
            <div class="form-chat">
                <form method="post">
                    <textarea name="mensagem"></textarea>
                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo INCLUDE_PATH."chat/"?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH."chat/"?>js/jquery.ajaxform.js"></script>
<script src="<?php echo INCLUDE_PATH."chat/"?>js/chat.js"></script>