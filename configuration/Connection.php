<?php

class Connection
{

  private $username;
  private $password;
  private $database;

  public function __construct($database, $username, $password)
  {
    $this->username = $username;
    $this->password = $password;
    $this->database = $database;
  }

  public function getConnection()
  {
    try {
      $connection = new PDO('mysql:host=localhost;dbname=' . $this->database, $this->username, $this->password);
      return $connection;
    } catch (PDOException $e) {
      echo 'Erro de conexão: ' . $e->getMessage();
      return null;
    }
  }
}