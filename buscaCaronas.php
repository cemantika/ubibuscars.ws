<?php

require("criaConexao.php");

/**
 * Retorna a quantidade de vagas ocupadas em cada carona
 */
function getVagasOcupadasPorCarona() {
	$query = 
		"SELECT
			id_carona, COUNT(*)
		FROM
			usuarios_solicita_caronas
		WHERE
			situacao = 'Solicitacao aceita'
		GROUP BY id_carona";

	$result = pg_query($query) or die ("Erro ao buscar dados");

	$linhas = array();
	while($r = pg_fetch_assoc($result)) {
		$linhas[$r['id_carona']] = $r['count'];
	}
	return $linhas;
}

$query = 
"SELECT
	u.nome_usuario
AS
	nome, c.id_carona, c.id_usuario,c.endereco_origem,c.horario_origem,c.endereco_destino,c.horario_destino, c.tipo,c.ativo, c.vagas
FROM
	caronas AS c INNER JOIN usuarios AS u ON (c.id_usuario=u.id_usuario) ORDER BY c.id_carona DESC"; 

$result = pg_query($query) or die ("Erro ao buscar dados");
$vagasOcupadasPorCarona = getVagasOcupadasPorCarona();

pg_close();

$linhas = array();

while($r = pg_fetch_assoc($result))
{
	$r['vagas_disponiveis'] = ($r['tipo'] == 1) ? strval(isset($vagasOcupadasPorCarona[$r['id_carona']]) ? $r['vagas'] - $vagasOcupadasPorCarona[$r['id_carona']] : $r['vagas']) : '';
	$linhas[] = $r;
}

echo json_encode($linhas);


?>
