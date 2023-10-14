<?php

// Namespace desta classe.

namespace App\Model;

// Namespaces utilizados nesta classe.

use App\DAO\DataDAO;

class DataModel extends Model
{

    public $id, $anime, $usuario, $senha, $recorde, $ativo;

    public function Save() : void
    {

        $dao = new DataDAO();

        (empty($this->id)) ? $dao->Insert($this) : $dao->Update($this);

    }

    public function Manipulate(int $id, int $condicao) : void
    {

        (new DataDAO())->Modify($id, $condicao);

    }

    public function GetData(string $filtro = null, string $coluna = null) : void
    {

        $dao = new DataDAO();

        $this->dados = ($filtro == null && $coluna == null) ? $dao->Select() : $dao->Search($filtro, $coluna);

    }

}

?>