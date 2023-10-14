<?php

// Namespace desta classe.

namespace App\Controller;

// Namespaces utilizados nesta classe.

use App\Model\DataModel;

use Exception;

class DataController extends Controller
{

    public static function LoadPage(string $arquivo_html) : void
    {

        try
        {

            if($arquivo_html != "Game")
            {

                session_destroy();

            }

            else if($arquivo_html == "Form" && count($_POST) > 0)
            {

                $_SESSION["anime"] = $_POST["anime"];

            }

            parent::ViewRenderer($arquivo_html);

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex . "\n\n" . "Fonte: DataController->LoadPage()");

        }

    }

    public static function RegisterUser() : void
    {

        try
        {

            if(parent::InputVerification($_POST["usuario"]) || parent::InputVerification($_POST["senha"]))
            {

                exit("<script> alert('Não são permitidos campos preenchidos somente com espaços! Revise seus dados e tente novamente.'); " .
                     "history.pushState(null,null,'http://localhost:8000/form'); " .
                     "window.location.reload(true); </script>");

            }

            else
            {

                $model = new DataModel();

                $model->GetData();

                $usuarios = $model->dados;

                if($usuarios)
                {

                    $condicao = 0;

                    foreach($usuarios as $item)
                    {
    
                        if($item->usuario == $_POST["usuario"])
                        {
    
                            $condicao = 1;
    
                            break;
    
                        }
    
                    }
    
                    switch($condicao)
                    {

                        case 0:

                            $model->anime = $_SESSION["anime"];
                
                            $model->usuario = trim($_POST["usuario"]);
                
                            $model->senha = md5(trim($_POST["senha"]));
    
                            $model->Save();
    
                            header("Location: /form");

                            parent::GenerateBackup();
    
                        break;
    
                        case 1:
    
                            exit("<script> alert('Este Usuário já está cadastrado! Tente outra opção.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>");
    
                        break;
    
                    }

                }

                else
                {

                    $model->anime = $_SESSION["anime"];
        
                    $model->usuario = trim($_POST["usuario"]);
        
                    $model->senha = md5(trim($_POST["senha"]));

                    $model->Save();

                    header("Location: /form");

                    parent::GenerateBackup();

                }

            }

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex . "\n\n" . "Fonte: DataController->RegisterUser()");

        }

    }

    public static function EditUser() : void
    {

        try
        {

            if(parent::InputVerification($_POST["usuario"]) || parent::InputVerification($_POST["senha"]) ||
               parent::InputVerification($_POST["usuario_novo"]) || parent::InputVerification($_POST["senha_nova"]))
            {

                exit("<script> alert('Não são permitidos campos preenchidos somente com espaços! Revise seus dados e tente novamente.'); " .
                     "history.pushState(null,null,'http://localhost:8000/form'); " .
                     "window.location.reload(true); </script>");

            }

            else
            {

                $model = new DataModel();

                $model->GetData($_POST["usuario"], "usuario");

                $usuarios = $model->dados;

                if($usuarios)
                {

                    $condicao = 0;

                    $id_array = 0;

                    foreach($usuarios as $item)
                    {

                        if($_POST["usuario"] == $item->usuario &&
                        md5($_POST["senha"]) == $item->senha)
                        {

                            if($_POST["usuario_novo"] == $item->usuario && $_POST["usuario"] != $_POST["usuario_novo"])
                            {

                                $condicao = 1;

                                break;

                            }

                            else
                            {

                                $condicao = 2;

                                break;

                            }

                            $id_array++;
        
                        }

                    }

                    switch($condicao)
                    {

                        case 0:

                            exit("<script> alert('Usuário ou senha incorretos! Revise seus dados e tente novamente.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>");

                        break;

                        case 1:

                            exit("<script> alert('Já existe um usuário com este nome! Tente outra opção.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>");

                        break;

                        case 2:

                            $model->id = (int) $usuarios[$id_array]->id;

                            $model->anime = $_SESSION["anime"];

                            $model->usuario = trim($_POST["usuario_novo"]);
            
                            $model->senha = md5(trim($_POST["senha_nova"]));

                            $model->recorde = $usuarios[$id_array]->recorde;

                            $model->Save();

                            header("Location: /form");

                            parent::GenerateBackup();

                        break;

                    }

                }

                else
                {

                    exit("<script> alert('Este usuário não existe! Verifique se você realmente está cadastrado.'); " .
                         "history.pushState(null,null,'http://localhost:8000/form'); " .
                         "window.location.reload(true); </script>");

                }

            }

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex . "\n\n" . "Fonte: DataController->EditUser()");

        }

    }

    public static function ChangeConditionUser() : void
    {

        try
        {

            if(parent::InputVerification($_POST["chave"]))
            {

                exit("<script> alert('Não são permitidos campos preenchidos somente com espaços! Revise seus dados e tente novamente.'); " .
                     "history.pushState(null,null,'http://localhost:8000/form'); " .
                     "window.location.reload(true); </script>");

            }

            else
            {

                if(md5(trim($_POST["chave"])) == MASTER)
                {

                    (new DataModel())->Manipulate((int) $_POST["jogador"], (int) $_POST["condicao"]);

                    header("Location: /form");

                    parent::GenerateBackup();

                }

                else
                {

                    exit("<script> alert('Senha mestra incorreta! Tente novamente.'); " .
                         "history.pushState(null,null,'http://localhost:8000/form'); " .
                         "window.location.reload(true); </script>");

                }

            }

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex . "\n\n" . "Fonte: DataController->DeactivateUser()");

        }

    }

    public static function LoginUser() : void
    {

        try
        {

            if(parent::InputVerification($_POST["usuario"]) || parent::InputVerification($_POST["senha"]))
            {

                exit("<script> alert('Não são permitidos campos preenchidos somente com espaços! Revise seus dados e tente novamente.'); " .
                     "history.pushState(null,null,'http://localhost:8000/form'); " .
                     "window.location.reload(true); </script>");

            }

            else
            {

                $model = new DataModel();

                $model->GetData($_POST["usuario"], "usuario");

                $usuarios = $model->dados;

                if($usuarios)
                {

                    $condicao = 0;

                    $id_array = 0;

                    foreach($usuarios as $item)
                    {

                        if($_POST["usuario"] == $item->usuario &&
                        md5($_POST["senha"]) == $item->senha)
                        {

                            if($item->ativo == 0)
                            {

                                $condicao = 1;

                            }

                            else
                            {

                                $condicao = 2;

                            }

                            break;
    
                        }

                        $id_array++;

                    }

                    switch($condicao)
                    {

                        case 0:

                            exit("<script> alert('Usuário ou senha incorretos! Revise seus dados e tente novamente.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>");

                        break;

                        case 1:

                            exit("<script> alert('Este usuário está banido e, portanto, não pode jogar! Por favor, não insista.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>");

                        break;

                        case 2:

                            $_SESSION["id_usuario"] = $usuarios[$id_array]->id;
    
                            $_SESSION["cpf"] = $usuarios[$id_array]->cpf;
    
                            $_SESSION["usuario"] = $usuarios[$id_array]->usuario;
            
                            $_SESSION["senha"] = $usuarios[$id_array]->senha;
            
                            header("Location: /game");

                        break;

                    }

                }

                else
                {

                    exit("<script> alert('Este usuário não existe! Verifique se você realmente está cadastrado.'); " .
                         "history.pushState(null,null,'http://localhost:8000/form'); " .
                         "window.location.reload(true); </script>");

                }

            }

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex . "\n\n" . "Fonte: DataController->LoginUser()");

        }

    }

    public static function SaveData() : void
    {

        try
        {

            switch($_POST["opcao"])
            {

                case "cadastro":

                    self::RegisterUser();

                break;

                case "edicao":

                    self::EditUser();

                break;

                case "banimento":

                    self::ChangeConditionUser();

                break;

                case "desbanimento":

                    self::ChangeConditionUser();

                break;

                case "login":

                    self::LoginUser();

                break;

                default:

                exit("<script> alert('Opção inválida!'); " .
                     "history.pushState(null,null,'http://localhost:8000/'); " .
                     "window.location.reload(true); </script>");

                break;

            }

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex . "\n\n" . "Fonte: DataController->SaveData()");

        }

    }

    public static function SaveGame() : void
    {

        try
        {

            $model = new DataModel();

            $model->GetData($_SESSION["usuario"], "usuario");

            $jogador = $model->dados;

            if($jogador)
            {

                if(parent::RecordVerification($jogador[0]->recorde, $_POST["recorde"]))
                {

                    $model->id = (int) $_SESSION["id_usuario"];

                    $model->anime = $_SESSION["anime"];
        
                    $model->usuario = $_SESSION["usuario"];
        
                    $model->senha = $_SESSION["senha"];
        
                    $model->recorde = $_POST["recorde"];
    
                    $model->Save();

                    parent::GenerateBackup();

                }

            }

            header("Location: /");

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex . "\n\n" . "Fonte: DataController->SaveGame()");

        }

    }

    public static function GenerateJSON() : void
    {

        try
        {

            $model = new DataModel();

            $model->GetData();

            if($model->dados)
            {

                parent::SendReturnAsJSON($model->dados);

            }

            else
            {

                parent::SendReturnAsJSON("Nada a retornar.");

            }

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex . "\n\n" . "Fonte: DataController->GenerateJSON()");

        }

    }

}

?>