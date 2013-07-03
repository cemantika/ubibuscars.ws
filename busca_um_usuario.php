<?php

require("criaConexao.php");

$id=$_GET["id"];

$query = "SELECT nome_usuario AS nome,login,email, sexo, data_nascimento FROM usuarios WHERE id_usuario=$id"; 

$result = pg_query($query) or die ("Erro ao buscar dados");


pg_close();

$linhas = array();

while($r = pg_fetch_assoc($result))
{
	$linhas[] = $r;
}

echo json_encode($linhas);


?>
