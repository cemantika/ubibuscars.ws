<?php

require("criaConexao.php");

$id_usuario = $_POST["id_usuario"];

//recupera todos os alertas ativos
$query = "SELECT nome_remetente, alerta FROM alertas WHERE id_usuario=$id_usuario AND ativo=1";

$result = pg_query($query) or die ("Erro ao buscar dados");

$linhas = array();

while($r = pg_fetch_assoc($result))
{
	$linhas[] = $r;
}

//desativa alertas
$query = "UPDATE alertas SET ativo=0 WHERE id_usuario=$id_usuario";

pg_query($con,$query) or die ("Erro ao inserir dados".pg_last_error());

pg_close();

echo json_encode($linhas);
?>