<?php

class Estoque
{

  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function itemExists(string $name)
  {
    try {
      $stmt = $this->connection->prepare('SELECT * FROM estoque WHERE produto = ?');
      $stmt->execute([$name]);
      $stmt->fetch();
      if ($stmt->rowCount() > 0) {
        return true;
      }
      return false;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function upsertItem($objetoJSON, $exists)
  {
    try {
      $dados = json_decode($objetoJSON, true);

      $produto = $dados['produto'];
      $cor = $dados['cor'];
      $tamanho = $dados['tamanho'];
      $deposito = $dados['deposito'];
      $data_disponibilidade = $dados['data_disponibilidade'];
      $quantidade = $dados['quantidade'];

      $sql = "INSERT INTO estoque (cor, tamanho, deposito, data_disponibilidade, quantidade, produto) VALUES (?, ?, ?, ?, ?, ?)";

      if ($exists) {
        $sql = "UPDATE estoque SET cor = ?, tamanho = ?, deposito = ?, data_disponibilidade = ?, quantidade = ? WHERE produto = ?";
      }

      $stmt = $this->connection->prepare($sql);
      $stmt->execute([$cor, $tamanho, $deposito, $data_disponibilidade, $quantidade, $produto]);
      return true;
    } catch (PDOException $e) {
      echo 'Erro ao inserir dados: ' . $e->getMessage();
      return false;
    }
  }

}