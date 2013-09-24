<?php

require("criaConexao.php");

$id_usuario = $_POST["id_usuario"];

//recupera todos os alertas ativos
$query = "SELECT alertas FROM usuarios WHERE id_usuario=$id_usuario";

$result = pg_query($query) or die ("Erro ao buscar dados");

$linhas = array();

while($r = pg_fetch_assoc($result))
{
	$linhas[] = $r;
}
pg_close();

echo json_encode($linhas);
?>