<?php 
try {
	$mysqlClient = new PDO('mysql:host=localhost;dbname=manga;charset=utf8', 'root', '');
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}
$sql = 'SELECT * FROM products'; 

$wow = $mysqlClient->prepare($sql);
$wow->execute();
$mangas = $wow->fetchAll();