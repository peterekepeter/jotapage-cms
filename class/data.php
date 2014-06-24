<?php
include_once 'config.php';
function getDataConnection()
{
	global $dataConnection, $dataUser, $dataPassword;
	return new PDO($dataConnection, $dataUser, $dataPassword);
}
?>