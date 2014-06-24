<?php
include_once 'data.php';
include_once 'security.php';

class User
{
	public $username;
	public $password;
	public $email;
	public $created;
	public $level;
	
	public static function Create($username, $password, $email,$level)
	{
		$data = getDataConnection();
		$st = $data->prepare("insert into `user` (`username`, `password`, `email`, `level`) values (:username,:password,:email,:level);");
		$st->execute(array(':username'=>$username,':password'=>create_hash($password),':email'=>$email,':level'=>$level));
	}
	public static function Read($username)
	{
		$data = getDataConnection();
		$st = $data->prepare("select `username`, `password`, `email`, `created`, `level` from `user` where `username` = :username");
		$st->execute(array(':username' => $username));
		return $st->fetchObject("User");
	}
	public static function Delete($username)
	{
		$data = getDataConnection();
		$st = $data->prepare("delete from `user` where `username` = :username;");
		$st->execute(array(':username' => $username));
	}
	public static function View()
	{
		$data = getDataConnection();
		$st = $data->prepare("select * from `user`;");
		$st->execute();
		return $st->fetchAll(PDO::FETCH_CLASS,"User");
	}
	
	public static function Login($username, $password)
	{
		$user = User::Read($username);
		if (validate_password($password,$user->password))
		{
			session_start();
			$_SESSION['current_user'] = $user;
			return $user;
		}
		else
		{
			session_destroy();
			return null;
		}
	}
	
	public static function GetCurrent()
	{
		session_start();
		$user = $_SESSION['current_user'];
		if (isset($user))
		{
			return $user;
		}
		else
		{
			return null;
		}
	}
	
	public static function Logout()
	{
		session_destroy();
	}
	
}

?>