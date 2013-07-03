<?php 

header('Content-Type: text/html; charset=utf-8');
require("criaConexao.php");

	
$id_carona = $_POST["id_carona"];

$query =  "UPDATE caronas SET ativo=0 WHERE id_carona=$id_carona";

pg_query($con,$query) or die ("Erro ao deletar dados".pg_last_error());

pg_close();
	
	
echo "Carona excluída"

?>
