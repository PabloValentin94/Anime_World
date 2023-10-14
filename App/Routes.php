<?php

// Namespaces utilizados nesta classe.

use App\Controller\DataController;

// Obtendo a url atual.

$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Executando ações de acordo com a url retornada.

switch($url)
{

    case "/":
        DataController::LoadPage("Index");
    break;

    case "/form":
        DataController::LoadPage("Form");
    break;

    case "/form/save":
        (count($_POST) > 0) ? DataController::SaveData() : header("Location: /form");
    break;

    case "/game":
        (count($_SESSION) > 0) ? DataController::LoadPage("Game") : header("Location: /form");
    break;

    case "/game/save":
        (count($_SESSION) > 0) ? DataController::SaveGame() : header("Location: /form");
    break;

    case "/ranking":
        DataController::LoadPage("Ranking");
    break;

    case "/generate_json":
        DataController::GenerateJSON();
    break;

    default:
        http_response_code(404);
        header("Location: /");
    break;

}

?>