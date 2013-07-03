<?php

require("criaConexao.php");

$nome = $_POST["nome"];
$login = $_POST["login"];
$senha = $_POST["senha"];
$email = $_POST["email"];
$coord_x = $_POST["coord_x"];
$coord_y = $_POST["coord_y"]; 
$sexo = $_POST["sexo"];
$nascimento = $_POST["nascimento"];



//Converte a string nascimento em Data
list($d, $m, $y) = explode('/', $nascimento);
$mk=mktime(0, 0, 0, $m, $d, $y);
$myDate=strftime('%Y-%m-%d',$mk);

//Imagem
$arquivo = fopen($_FILES['imagem']['tmp_name'],'r');
$dados = fread($arquivo,filesize($_FILES['imagem']['tmp_name']));
$imagem = file_get_contents($_FILES['imagem']['tmp_name']);
$escaped = bin2hex($imagem);

$query = "INSERT INTO usuarios (id_usuario, nome_usuario,login,senha,email,data_nascimento,sexo,foto_perfil,localizacao,data_ingresso,data_ultimo_acesso) VALUES (nextval('sq_usuarios'),'$nome','$login','$senha','$email', '$myDate','$sexo', decode('{$escaped}' , 'hex'), ST_GeomFromText('POINT($coord_x $coord_y)',4326), current_date, current_date)";

pg_query($con,$query) or die ("Erro ao inserir dados");

echo "Usuário cadastrado com sucesso";

pg_close();

?>
