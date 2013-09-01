<?php 

header('Content-Type: text/html; charset=utf-8');
require("criaConexao.php");

	
$id_carro_particular = $_POST["id_carro_particular"];

$query =  "UPDATE carros_particulares SET ativo=0 WHERE id_carro_particular=$id_carro_particular";

pg_query($con,$query) or die ("Erro ao deletar dados".pg_last_error());

pg_close();
	
	
echo "Carro excluída"

?>
