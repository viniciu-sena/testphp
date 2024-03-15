<?php

class Connection
{
  public static function getConnection()
  {
    try {
      return new PDO('mysql:host=localhost', 'root', 'admin');
    } catch (PDOException $e) {
      echo 'Erro de conexão: ' . $e->getMessage();
    }
  }
}