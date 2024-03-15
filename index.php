<?php

include './configuration/Connection.php';
include './configuration/Estoque.php';
$json = file_get_contents('./assets/mock.json');

$connection = new Connection();
$sesstion = $connection->getConnection();
$estoque = new Estoque($session);

$mockList = json_decode($json, true);

foreach ($mockList as $item) {
  $exists = $estoque->getItemByName($item['produto']);
  $estoque->insertItem(json_encode($item), $exists);
}