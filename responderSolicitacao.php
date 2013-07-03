<?php

require("criaConexao.php");



$id_solicitacao= $_POST["id_solicitacao"];
$resposta = $_POST["resposta"];
$novaSituacao;

if($resposta=="aceitar"){
	$novaSituacao="Solicitacao aceita";	
}else if($resposta=="recusar"){
	$novaSituacao="Solicitacao recusada";
}



$query = "UPDATE usuarios_solicita_caronas
SET situacao='$novaSituacao'
WHERE id_solicitacao=$id_solicitacao";

pg_query($con,$query) or die ("Erro ao alterar dados");

echo "Resposta enviada com sucesso.";

pg_close();

?>
