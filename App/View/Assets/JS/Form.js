var lista_jogadores = [];

window.onload = () => {

    document.getElementById("botao_prosseguir").style.display = "flex";

    const requisicao = fetch("http://localhost:8000/generate_json");

    const json = requisicao.then(retorno => {

        if(retorno.ok)
        {

            return retorno.json();

        }

        else
        {

            return "Nada a retornar.";

        }

    });

    json.then(listagem_jogadores => {

        if(listagem_jogadores != "Nada a retornar.")
        {

            for(var i = 0; i < listagem_jogadores.length; i++)
            {

                lista_jogadores.push({"id": listagem_jogadores[i].id, "usuario": listagem_jogadores[i].usuario, "ativo": listagem_jogadores[i].ativo});
    
            }

            if(lista_jogadores.length > 0)
            {

                var condicao = false;

                for(var i = 0; i < lista_jogadores.length; i++)
                {

                    if(lista_jogadores[i].ativo == 1)
                    {

                        condicao = true;

                        break;

                    }

                }

                if(condicao)
                {

                    (document.getElementById("opcao").value = "login").selected = true;

                    mudar_formulario("login");

                }

                else
                {

                    (document.getElementById("opcao").value = "cadastro").selected = true;

                    mudar_formulario("cadastro");

                }

            }

            else
            {

                (document.getElementById("opcao").value = "cadastro").selected = true;

                mudar_formulario("cadastro");

            }

        }

        else
        {

            (document.getElementById("opcao").value = "cadastro").selected = true;

            mudar_formulario("cadastro");
            
        }

    });

}

function mudar_formulario()
{

    switch(document.getElementById("opcao").value)
    {

        case "cadastro":

            const form_cadastro = 
            
            "<div id='cadastro'>" +

                "<span>" +

                    "<input id='usuario' type='text' name='usuario' placeholder='Crie um nome de jogador(a).'" +
                    " minlength='2' maxlength='25' autocomplete='off' required>" +

                "</span>" +

                "<span>" +

                    "<input id='senha' type='password' name='senha' placeholder='Crie uma senha.'" +
                    " minlength='4' maxlength='20' autocomplete='off' required>" +

                "</span>" +

            "</div>";

            document.getElementById("form").innerHTML = form_cadastro;

            document.getElementById("botao_prosseguir").style.display = "flex";

            document.getElementById("botao_prosseguir").innerText = "Cadastrar";

            document.getElementById("botao_prosseguir").ariaLabel = "Criar meu perfil no jogo.";

        break;

        case "edicao":

            if(lista_jogadores.length > 0)
            {

                var condicao = false;

                for(var i = 0; i < lista_jogadores.length; i++)
                {

                    if(lista_jogadores[i].ativo == 1)
                    {

                        condicao = true;

                        break;

                    }

                }

                if(condicao)
                {

                    const form_edicao = 
            
                    "<div id='edicao'>" +
        
                        "<span>" +
        
                            "<input id='usuario' type='text' name='usuario' placeholder='Insira seu atual nome de jogador(a).'" +
                            " minlength='2' maxlength='25' autocomplete='off' required>" +
        
                        "</span>" +
        
                        "<span>" +
        
                            "<input id='senha' type='password' name='senha' placeholder='Insira sua atual senha.'" +
                            " minlength='4' maxlength='20' autocomplete='off' required>" +
        
                        "</span>" +
        
                        "<span>" +
        
                            "<input id='usuario_novo' type='text' name='usuario_novo' placeholder='Crie um novo nome de jogador(a).'" +
                            " minlength='2' maxlength='25' autocomplete='off' required>" +
        
                        "</span>" +
        
                        "<span>" +
        
                            "<input id='senha_nova' type='password' name='senha_nova' placeholder='Crie uma nova senha.'" +
                            " minlength='4' maxlength='20' autocomplete='off' required>" +
        
                        "</span>" +
        
                    "</div>";
        
                    document.getElementById("form").innerHTML = form_edicao;
        
                    document.getElementById("botao_prosseguir").style.display = "flex";
        
                    document.getElementById("botao_prosseguir").innerText = "Editar";
        
                    document.getElementById("botao_prosseguir").ariaLabel = "Editar meu perfil do jogo.";

                }

                else
                {

                    document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                    document.getElementById("botao_prosseguir").style.display = "none";

                }

            }

            else
            {

                document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                document.getElementById("botao_prosseguir").style.display = "none";

            }

        break;

        case "banimento":

            if(lista_jogadores.length > 0)
            {

                var condicao = false;

                for(var i = 0; i < lista_jogadores.length; i++)
                {

                    if(lista_jogadores[i].ativo == 1)
                    {

                        condicao = true;

                        break;

                    }

                }

                if(condicao)
                {

                    const form_banimento = 
                    
                    "<div id='banimento'>" +

                        "<span>" +

                            "<select id='jogador' type='text' name='jogador' required> </select>" +

                        "</span>" +

                        "<span>" +

                            "<input id='chave' type='password' name='chave' placeholder='Insira a senha mestra.'" +
                            " minlength='4' maxlength='20' autocomplete='off' required>" +

                        "</span>" +

                        "<span style='display: none'>" +

                            "<input id='condicao' type='hidden' name='condicao' value='0'" +
                            " minlength='1' maxlength='1' autocomplete='off' required>" +

                        "</span>" +

                    "</div>";

                    document.getElementById("form").innerHTML = form_banimento;

                    document.getElementById("botao_prosseguir").style.display = "flex";

                    document.getElementById("botao_prosseguir").innerText = "Desativar";

                    document.getElementById("botao_prosseguir").ariaLabel = "Desativar um perfil do jogo.";

                    document.getElementById("jogador").innerHTML = "";

                    var numeracao = 0;

                    for(var i = 0; i < lista_jogadores.length; i++)
                    {

                        if(lista_jogadores[i].ativo == 1)
                        {

                            numeracao++;
            
                            document.getElementById("jogador").innerHTML += "<option value='" + lista_jogadores[i].id + "'> " + numeracao + " - " + lista_jogadores[i].usuario + " </option>";

                        }
            
                    }

                    if(document.getElementById("jogador").innerHTML == "")
                    {

                        document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                        document.getElementById("botao_prosseguir").style.display = "none";

                    }

                }

                else
                {

                    document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                    document.getElementById("botao_prosseguir").style.display = "none";

                }

            }

            else
            {

                document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                document.getElementById("botao_prosseguir").style.display = "none";

            }

        break;

        case "desbanimento":

            if(lista_jogadores.length > 0)
            {

                var condicao = false;

                for(var i = 0; i < lista_jogadores.length; i++)
                {

                    if(lista_jogadores[i].ativo == 0)
                    {

                        condicao = true;

                        break;

                    }

                }

                if(condicao)
                {

                    const form_desbanimento = 
                    
                    "<div id='banimento'>" +

                        "<span>" +

                            "<select id='jogador' type='text' name='jogador' required> </select>" +

                        "</span>" +

                        "<span>" +

                            "<input id='chave' type='password' name='chave' placeholder='Insira a senha mestra.'" +
                            " minlength='4' maxlength='20' autocomplete='off' required>" +

                        "</span>" +

                        "<span style='display: none'>" +

                            "<input id='condicao' type='hidden' name='condicao' value='1'" +
                            " minlength='1' maxlength='1' autocomplete='off' required>" +

                        "</span>" +

                    "</div>";

                    document.getElementById("form").innerHTML = form_desbanimento;

                    document.getElementById("botao_prosseguir").style.display = "flex";

                    document.getElementById("botao_prosseguir").innerText = "Reativar";

                    document.getElementById("botao_prosseguir").ariaLabel = "Reativar um perfil do jogo.";

                    document.getElementById("jogador").innerHTML = "";

                    var numeracao = 0;

                    for(var i = 0; i < lista_jogadores.length; i++)
                    {

                        if(lista_jogadores[i].ativo == 0)
                        {

                            numeracao++;
            
                            document.getElementById("jogador").innerHTML += "<option value='" + lista_jogadores[i].id + "'> " + numeracao + " - " + lista_jogadores[i].usuario + " </option>";

                        }
            
                    }

                    if(document.getElementById("jogador").innerHTML == "")
                    {

                        document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                        document.getElementById("botao_prosseguir").style.display = "none";

                    }

                }

                else
                {

                    document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                    document.getElementById("botao_prosseguir").style.display = "none";

                }

            }

            else
            {

                document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                document.getElementById("botao_prosseguir").style.display = "none";

            }

        break;

        case "login":

            if(lista_jogadores.length > 0)
            {

                var condicao = false;

                for(var i = 0; i < lista_jogadores.length; i++)
                {

                    if(lista_jogadores[i].ativo == 1)
                    {

                        condicao = true;

                        break;

                    }

                }

                if(condicao)
                {

                    const form_login = 
            
                    "<div id='login'>" +

                        "<span>" +

                            "<input id='usuario' type='text' name='usuario' placeholder='Insira seu nome de jogador(a).'" +
                            " minlength='2' maxlength='25' autocomplete='off' required>" +

                        "</span>" +

                        "<span>" +

                            "<input id='senha' type='password' name='senha' placeholder='Insira sua senha.'" +
                            " minlength='4' maxlength='20' autocomplete='off' required>" +

                        "</span>" +

                    "</div>";

                    document.getElementById("form").innerHTML = form_login;

                    document.getElementById("botao_prosseguir").style.display = "flex";

                    document.getElementById("botao_prosseguir").innerText = "Entrar";

                    document.getElementById("botao_prosseguir").ariaLabel = "Acessar o jogo utilizando meu perfil.";

                }

                else
                {

                    document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                    document.getElementById("botao_prosseguir").style.display = "none";

                }

            }

            else
            {

                document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                document.getElementById("botao_prosseguir").style.display = "none";

            }

        break;

    }

}