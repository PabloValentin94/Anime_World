<?php

// Namespace desta classe.

namespace App\DAO;

// Namespaces utilizados nesta classe.

use App\Model\DataModel;

class DataDAO extends DAO
{

    public function __construct()
    {

        parent::__construct();

    }

    public function Insert(DataModel $model) : bool
    {

        $sql = "INSERT INTO Player(anime, usuario, senha) VALUES(?,?,?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->anime);

        $stmt->bindValue(2, $model->usuario);

        $stmt->bindValue(3, $model->senha);

        return $stmt->execute();

    }

    public function Update(DataModel $model) : bool
    {

        $sql = "UPDATE Player SET anime = ?, usuario = ?, senha = ?, recorde = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->anime);

        $stmt->bindValue(2, $model->usuario);

        $stmt->bindValue(3, $model->senha);

        $stmt->bindValue(4, $model->recorde);

        $stmt->bindValue(5, $model->id);

        return $stmt->execute();

    }

    public function Modify(int $id, int $condicao) : bool
    {

        $sql = "UPDATE Player SET ativo = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $condicao);

        $stmt->bindValue(2, $id);

        return $stmt->execute();

    }

    public function Select() : array
    {

        $sql = "SELECT * FROM Player ORDER BY recorde ASC, usuario ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\DataModel");

    }

    public function Search(string $valor_filtro, $valor_coluna) : array
    {

        $parametro = [":filtro" => "%" . $valor_filtro . "%"];

        $sql = "SELECT * FROM Player WHERE $valor_coluna LIKE :filtro ORDER BY recorde ASC, usuario ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute($parametro);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\DataModel");

    }

}

?>