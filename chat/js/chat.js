window.onload = () => {
    $(".chat").scrollTop($(".chat")[0].scrollHeight);
    let is_shift = false;

    $("textarea").keydown(function (e){
        let key = e.keyCode || e.which;
        if($("textarea").val() != ""){
            if(key == 16)
                is_shift = true;
        }
        else if(key == 13 || key == 32)
            return false;
    })

    $("textarea").keyup(function (e){
        if($("textarea").val() != ""){
            let key = e.keyCode || e.which;
            if(key == 16)
                is_shift = false;
            if(is_shift == false && $("textarea").val() != "" && key == 13)
                insert_chat();
        }
    })

    $("form").submit(function (e){
        insert_chat();
        return false;
    })

    function insert_chat(){
        let mensagem = $("textarea").val();
        if(mensagem != ""){
            $("textarea").val("");

            $.ajax({
                url:"https://codespirit.com.br/chat/ajax/chat.php",
                method:"post",
                data: {"mensagem":mensagem, "insert":true}
            }).done(function(data){
                $(".chat .conteudo").append(data);
                $(".chat .conteudo").scrollTop($(".chat")[0].scrollHeight);
            })
        }
    }

    function get_messages() {  
        $.ajax({
            url:"https://codespirit.com.br/chat/ajax/chat.php",
            method:"post",
            data:{"get_messages":true}
        }).done(function(data){
            $(".chat .conteudo").html("")
            $(".chat .conteudo").append(data);
        })
    }

    setInterval(function(){
        get_messages();
    }, 1000);
}