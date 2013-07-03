<?php

header('Content-Type: text/html; charset=utf-8');

$con=pg_connect("host='localhost' port='5432' dbname='simtur' user='postgres' password='senha'") or die ("Não foi possível conectar o banco");

?>
