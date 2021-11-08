mensagem-chatmensagem-chat<div class="box__conteudo flex-mode">
    <div class="conteudo__single w33 green">
        <h3>Visitantes online</h3>
        <p><?php echo Painel::access_counter("tb_admin.online");?></p>
    </div>
    <div class="conteudo__single w33 orange">
        <h3>Visitantes totais</h3>
        <p><?php echo Painel::access_counter("tb_admin.visitas");?></p>
    </div>
    <div class="conteudo__single w33 blue">
        <h3>Visitantes hoje</h3>
        <p><?php echo Painel::access_counter("tb_admin.visitas", date("Y-m-d"));?></p>
    </div>
</div>