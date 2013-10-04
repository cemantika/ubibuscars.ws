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
	u.nome_usuario as nome,
	j.id_carona, 
	j.id_usuario,
	j.endereco_origem,
	j.horario_origem,
	j.endereco_destino,
	j.horario_destino, 
	j.tipo,
	j.ativo, 
	j.vagas,
	j.nota
FROM 

(
SELECT
	c.id_carona, 
	c.id_usuario,
	c.endereco_origem,
	c.horario_origem,
	c.endereco_destino,
	c.horario_destino, 
	c.tipo,
	c.ativo, 
	c.vagas,
	(avg(a.nota)) as nota
	 
FROM
	caronas AS c

LEFT JOIN  
	avaliacao AS a 
USING 
	(id_carona)

GROUP BY
	id_carona

ORDER BY c.id_carona DESC
) as j

INNER JOIN usuarios AS u ON (j.id_usuario=u.id_usuario)"; 

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
