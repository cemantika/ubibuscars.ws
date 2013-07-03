<?php

require("criaConexao.php");

$id_usuario=$_GET["id_usuario"];

$query = "SELECT s.id_solicitacao, c.id_carona, c.id_usuario as id_usuarioCarona, s.id_usuario AS id_usuarioSolicita, s.situacao,c.endereco_origem, c.endereco_destino,c.horario_origem,c.horario_destino,c.data, u1.nome_usuario AS nome_usuarioSolicita, u2.nome_usuario AS nome_usuarioCarona
FROM usuarios_solicita_caronas AS s 
INNER JOIN caronas AS c ON (s.id_carona=c.id_carona)
INNER JOIN usuarios AS u1 ON (s.id_usuario=u1.id_usuario)
INNER JOIN usuarios AS u2 ON (c.id_usuario=u2.id_usuario) 
WHERE s.id_usuario=$id_usuario OR c.id_usuario=$id_usuario 
ORDER BY id_solicitacao DESC"; 

$result = pg_query($query) or die ("Erro ao buscar dados".pg_last_error());


pg_close();

$linhas = array();

while($r = pg_fetch_assoc($result))
{
	$linhas[] = $r;
}

echo json_encode($linhas);


?>
