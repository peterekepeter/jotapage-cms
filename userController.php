<?php
include 'class/user.php';

$user = User::GetCurrent();
if (isset($user))
{
	if (!isset($_POST['cmd']))
	{
		echo '<table><tbody>';
		echo '<tr><td>Username</td>';
		echo '<td>Password</td>';
		echo '<td>Email</td>';
		echo '<td>Created</td>';
		echo '<td>Admin</td></tr>';
		foreach(User::View() as $entity)
		{
			echo '<tr class="entity" content="'.$entity->username.'"><td>';
			echo $entity->username;
			echo '</td><td>';
			echo substr($entity->password,12,12);
			echo '</td><td>';
			echo $entity->email;
			echo '</td><td>';
			echo $entity->created;
			echo '</td><td>';
			echo $entity->level;
			echo '</td></tr>';
		}
		echo '</tbody></table>';
	}
	else if ($_POST['cmd']==='create')
	{
		User::Create($_POST['username'],$_POST['password'],$_POST['email'],$_POST['level']);
	}
	else if ($_POST['cmd']==='delete')
	{
		if ($user->username===$_POST['username']) //can't delete yourself... sorry
		{
			
		}
		else
		{
			User::Delete($_POST['username']);
		}
	}
}

?>