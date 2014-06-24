<?php

include 'class/user.php';

$user = User::Login($_POST['username'],$_POST['password']);

if (isset($user))
{
	header( 'Location: manager.html' ) ;
}
else
{
	header( 'Location: login.html' ) ;
}

?>