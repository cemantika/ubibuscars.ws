<?php

require("criaConexao.php");

$id_usuario = $_POST["id_usuario"];
$nome = $_POST["id_usuario"];
$lugares = $_POST["lugares"];

$query = "
	INSERT INTO carros_particulares 
		(id_usuario, nome, lugares)
	VALUES
		($id_usuario, '$nome', $lugares)";

pg_query($con,$query) or die ("Erro ao inserir dados");

echo "Veículo cadastrado com sucesso";

pg_close();

?>
