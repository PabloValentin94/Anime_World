var players = [];

window.onload = () => {

    listagem_jogadores();

}

function listagem_jogadores()
{

    players = [];

    var tabela_jogadores = document.getElementById("data");

    tabela_jogadores.innerHTML = "";

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

    json.then(lista_jogadores => {

        if(lista_jogadores != "Nada a retornar.")
        {

            var posicao = 0;

            for(var i = 0; i < lista_jogadores.length; i++)
            {

                if(lista_jogadores[i].ativo == 1 && lista_jogadores[i].recorde != null)
                {

                    posicao++;

                    players.push({"posicao": posicao.toString() + "º", "usuario": lista_jogadores[i].usuario, "recorde": lista_jogadores[i].recorde});

                }
    
            }

            if(players.length > 0)
            {

                document.getElementById("container").style.display = "flex";

                for(var i = 0; i < players.length; i++)
                {

                    tabela_jogadores.innerHTML += "<span> <p>" + players[i].posicao + "</p> <p>" + players[i].usuario + "</p> <p>" + players[i].recorde + "</p> </span>";
        
                }

            }

            else
            {

                document.getElementById("container").style.display = "none";

                setTimeout(() => {

                    alert("Nenhum jogador encontrado.");
    
                }, 200);

            }

        }

        else
        {

            document.getElementById("container").style.display = "none";

            setTimeout(() => {

                alert("Nenhum jogador encontrado.");

            }, 200);

        }

    });

    //document.getElementById("usuario").value = "";

}

function pesquisar_jogador()
{

    if(document.getElementById("usuario").value.trim() == "")
    {

        alert("Preencha o campo de forma correta, antes de prosseguir!");

    }

    else
    {

        var jogador = "";

        for(var i = 0; i < players.length; i++)
        {
    
            if(players[i].usuario == document.getElementById("usuario").value.trim())
            {
    
                jogador = players[i];
    
                break;
    
            }
    
        }
    
        if(jogador != "")
        {
    
            alert("Usuário: " + jogador.usuario + ".\n\nPosição no Ranking: " + jogador.posicao + "º lugar.\n\nRecorde: " + jogador.recorde + ".");
    
        }
    
        else
        {
    
            alert("Usuário não encontrado. Verifique se este realmente existe. Caso ele exista, veja se há algum recorde salvo.");
    
        }

    }

    document.getElementById("usuario").value = "";

}