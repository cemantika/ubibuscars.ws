<?php

require("criaConexao.php");

$id = $_POST["id_usuario"];

$queryPerfil = "SELECT COUNT(*)
  FROM usuarios
  WHERE data_nascimento IS NOT NULL 
  AND sexo IS NOT NULL
  AND id_usuario=$id;
";

$resultPerfil = pg_query($queryPerfil);

$resPerfil = pg_fetch_assoc($resultPerfil);

$query = "SELECT id_usuario, tipo, data, COUNT(*)
  FROM caronas
  WHERE id_usuario=$id
  GROUP BY id_usuario, tipo, data"; 

$result = pg_query($query) or die ("Erro ao buscar dados");

pg_close();

$linhas = array();
$caronasOferecidas = 0;
$caronasRecebidas = 0;
$caronasOferecidasMesmoDia = 0;
while($r = pg_fetch_assoc($result))
{
	if($r['tipo'] == 1){
		$caronasOferecidas += $r['count'];
		
		if($r['count'] > $caronasOferecidasMesmoDia){
			$caronasOferecidasMesmoDia = $r['count'];
		}
	}else{
		$caronasRecebidas += $r['count'];
	}

	$linhas[] = $r;
}

//print_r($linhas);

//echo json_encode($linhas);

$arr['completar_perfil'] = $resPerfil['count'] == 1;
$arr['qtd_oferecer_carona'] = $caronasOferecidas;
$arr['oferecer_carona'] = $caronasOferecidas > 0;
$arr['oferecer_10_carona'] = $caronasOferecidas >= 10;
$arr['oferecer_20_carona'] = $caronasOferecidas >= 20;
$arr['oferecer_50_carona'] = $caronasOferecidas >= 50;
$arr['qtd_solicitar_carona'] = $caronasRecebidas;
$arr['solicitar_carona'] = $caronasRecebidas > 0;
$arr['solicitar_10_carona'] = $caronasRecebidas >= 10;
$arr['solicitar_20_carona'] = $caronasRecebidas >= 20;
$arr['solicitar_50_carona'] = $caronasRecebidas >= 50;
$arr['carona_5_carro_cheio'] = false;
$arr['carona_10_carro_cheio'] = false;
$arr['carona_20_carro_cheio'] = false;
$arr['qtd_caronas_mesmo_dia'] = $caronasOferecidasMesmoDia;
$arr['carona_2_mesmo_dia'] = $caronasOferecidasMesmoDia >= 2;
$arr['carona_4_mesmo_dia'] = $caronasOferecidasMesmoDia >= 2;
$arr['carona_10_mesmo_dia'] = $caronasOferecidasMesmoDia >= 2;


echo json_encode($arr);
?>