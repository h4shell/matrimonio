<?php



$name = $_GET['name'];
$accept = $_GET['accept'];

require 'Database.php';

$csvManager = new CsvManager('lista.csv');
$csvManager->addRecord($name, $accept);

// Crea una risposta basata sul valore di $accept
$response = ($accept == 'true') ? 1 : 0;

// Imposta l'intestazione per il contenuto JSON
header('Content-Type: application/json');

// Restituisci la risposta in formato JSON
echo $response;