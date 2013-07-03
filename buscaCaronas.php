<?php

require("criaConexao.php");

$query = "SELECT u.nome_usuario AS nome, c.id_carona, c.id_usuario,c.endereco_origem,c.horario_origem,c.endereco_destino,c.horario_destino, c.tipo,c.ativo FROM caronas AS c INNER JOIN usuarios AS u ON (c.id_usuario=u.id_usuario) ORDER BY c.id_carona DESC"; 

$result = pg_query($query) or die ("Erro ao buscar dados");


pg_close();

$linhas = array();

while($r = pg_fetch_assoc($result))
{
	$linhas[] = $r;
}

echo json_encode($linhas);


?>
