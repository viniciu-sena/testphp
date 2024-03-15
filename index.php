<?php

include './configuration/Connection.php';
include './configuration/Estoque.php';
$json = file_get_contents('./assets/mock.json');

$connection = new Connection('crud', 'root', 'admin');
$session = $connection->getConnection();

if ($session) {
  $estoque = new Estoque($session);

  $mockList = json_decode($json, true);

  foreach ($mockList as $item) {
    $exists = $estoque->itemExists($item['produto']);
    $estoque->upsertItem(json_encode($item), $exists);
  }
} else {
  echo 'Erro ao conectar com o banco de dados!';
}
