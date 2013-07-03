<?php

require("criaConexao.php");

$query = "SELECT id_usuario,nome_usuario AS nome, login, senha, email, st_x(localizacao) as coord_x, st_y(localizacao) as coord_y, sexo, data_nascimento, ativo FROM usuarios"; 

$result = pg_query($query) or die ("Erro ao buscar dados");

pg_close();

$linhas = array();

while($r = pg_fetch_assoc($result))
{
	$linhas[] = $r;
}

echo json_encode($linhas);


?>
