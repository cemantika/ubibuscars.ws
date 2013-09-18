<?php

require("criaConexao.php");

$id = $_POST["id"];
$nome = $_POST["nome"];
$login = $_POST["login"];
$email = $_POST["email"]; 
$nascimento = $_POST["nascimento"];
// $curso = $_POST["curso"];
// $imagem = $_REQUEST["imagem"];

//Converte a string nascimento em Data
list($d, $m, $y) = explode('/', $nascimento);
$mk=mktime(0, 0, 0, $m, $d, $y);
$myDate=strftime('%Y-%m-%d',$mk);

//Imagem
/**
 * Fix me: não funciona
 */
//$aux=base64_decode($imagem);
// $escaped = bin2hex($aux);

$query = "
	UPDATE 
		usuarios
	SET
		nome_usuario='$nome', login='$login',email='$email', data_nascimento='$myDate' WHERE id_usuario=$id";

pg_query($con,$query) or die ("Erro ao inserir dados".pg_last_error());

echo "Dados alterados com sucesso";

pg_close();

?>
