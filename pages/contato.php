<?php 
    if(isset($_POST['acao'])){
        $nome = $_POST['nome'];
        if($nome == ""){
            echo "<script>alert('O campo nome é obrigatório!'); </script>";
            Painel::redirect_to(INCLUDE_PATH."contato");
            die();
        }
        if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $email = $_POST["email"];
        }else{
            echo "<script>alert('E-mail em formato inválido!'); </script>";
            Painel::redirect_to(INCLUDE_PATH."contato");
            die();
        }
        $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : "Não definido";

        $mail = new Email('smtp.titan.email', 'contato@codespirit.com.br', 'MakerTV4K', "Luis Felipe - Code Spirit");
        $mail->addAddress("contato@codespirit.com.br", "Luis Felipe - Code Spirit");
        $corpo = "";
        foreach ($_POST as $key => $value) {
            if($key != "acao"){
                $corpo.="<strong>".strtoupper($key)."</strong>: $value <br>"; 
            }
        }
        $mail->formatEmail(array("assunto" => "Novo e-mail cadastrado no site", "corpo" => $corpo));
    }
?>
<section class="bg__contato bg">
    <div class="overlay">
        <h1>Entre em contato!</h1>
    </div>
</section>
<section class="main__conteudo contato">
    <?php 
    if(isset($_POST["acao"])){
        if($mail->sendEmail()){
            Painel::alert("sucesso", "E-mail foi enviado com sucesso!");
        }else{
            Painel::alert("erro", "Erro ao enviar o e-mail!");
        }
    }
    ?>
    <div class="contato__form container">
        <h2>Contato por e-mail</h2>
        <p>Insira seu nome e e-mail no formulário abaixo para que nós possamos entrar em contato com você</p>
        <form method="post">
            <input type="text" name="nome" required placeholder="*Nome... ">
            <input type="email" name="email" required placeholder="*E-mail... ">
            <input type="tel" name="telefone" placeholder="Telefone (Opcional)... ">
            <input type="submit" value="Enviar" name="acao">
        </form>
    </div>
    <div class="contato__telefone container">
        <h2>Também atendemos por WhatsApp, entre em contato já!</h2>
        <p>Para facilitar a vida de nossos clientes, nós também abrimos a possibilidade de termos um contato direto pelo WhatsApp!</p>
        <a title="Entre em contato pelo WhatsApp!" class="btn" href="https://api.whatsapp.com/send?phone=554199113882&text=Ol%C3%A1%2C%20tenho%20interesse%20em%20criar%20um%20site%2Fsistema%20web..." target="_blank" rel="external">Entre em contato pelo WhatsApp!</a>
    </div>
</section>