<?php

	include "criaConexao.php";
	
	//$id_avaliador = $_POST["id_avaliador"];
	$idCarona = $_POST["id_carona"];
	
	$query = "SELECT id_avaliador FROM avaliacao WHERE id_carona=$idCarona";
	
	$result = pg_query($con,$query) or die ("Erro na query");
	
	$linhas=array();
	
	while($r = pg_fetch_assoc($result))
	{
		$linhas[] = $r;
	}
pg_close();

echo json_encode($linhas);
	
	

?>