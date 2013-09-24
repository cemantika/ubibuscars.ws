<?php

require("criaConexao.php");

$id_usuario = $_POST["id_usuario"];
$id_solicitacao = $_POST["id_solicitacao"];
$alerta = $_POST["alerta"];
$nome_remetente = $_POST["nome_remetente"];

$query = "INSERT INTO alertas (id_alerta, alerta, ativo, id_usuario, nome_remetente) VALUES (nextval('sq_alertas'),'$alerta',1, 
			(SELECT c.id_usuario FROM caronas AS c 
			  INNER JOIN usuarios_solicita_caronas AS usc ON c.id_carona=usc.id_carona
			  WHERE id_solicitacao=$id_solicitacao
				AND usc.id_usuario=$id_usuario), '$nome_remetente')";

pg_query($con,$query) or die ("Erro ao inserir dados".pg_last_error());

echo "Alerta enviado com sucesso";

pg_close();
?>