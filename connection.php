<?php

class Connection
{

    private $databaseFile;
    private $connection;

    public function __construct()
    {
        $this->databaseFile = realpath(__DIR__ . "/database/db.sqlite");
        $this->connect();
    }

    private function connect()
    {
        return $this->connection = new PDO("sqlite:{$this->databaseFile}");
    }

    public function getConnection()
    {
        return $this->connection ?: $this->connection = $this->connect();
    }

    public function query($query)
    {
        $result      = $this->getConnection()->query($query);

        $result->setFetchMode(PDO::FETCH_INTO, new stdClass);

        return $result;
    }

    // Método para executar consultas de seleção
    public function select($query, $params = [])
    {
        $statement = $this->getConnection()->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para executar consultas de atualização
    public function update($query, $params = [])
    {
        $statement = $this->getConnection()->prepare($query);
        $result = $statement->execute($params);
        return $result;
    }
}
