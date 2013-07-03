<?php

require("criaConexao.php");

$query = "SELECT id_parada AS id_ponto, nome_parada as nome_do_ponto, descricao_parada as descricao_do_ponto, st_x(localizacao) as latitude, st_y(localizacao) as longitude FROM paradas"; 

$result = pg_query($query) or die ("Erro ao buscar dados");


pg_close();

$linhas = array();

while($r = pg_fetch_assoc($result))
{
	$linhas[] = $r;
}

echo json_encode($linhas);


?>
