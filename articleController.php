<?php
include_once 'class/user.php';
include_once 'class/article.php';

$user = User::GetCurrent();
if (isset($user))
{
	if (!isset($_POST['cmd']))
	{
		echo '<table><tbody><tr><td>Title</td><td>Author</td><td>Created</td></tr>';
		foreach(Article::View() as $entity)
		{
			echo '<tr class="entity" content="'.$entity->idarticle.'"><td>';
			echo $entity->title;
			echo '</td><td>';
			echo $entity->author;
			echo '</td><td>';
			echo $entity->created;
			echo '</td></tr>';
		}
		echo '</tbody></table>';
	}
	else if ($_POST['cmd']==='create')
	{
		$title = $_POST['title'];
		$author = $user->username;
		$markdown = '# '.$title.' #'.PHP_EOL;
		$html = '<h1>'.$title.'</h1>'.PHP_EOL;
		if (isset($_POST['author'])) $author = $_POST['author'];
		if (isset($_POST['markdown'])) $markdown = $_POST['markdown'];
		if (isset($_POST['html'])) $html = $_POST['html'];
		Article::Create($_POST['title'],$author,$markdown,$html);
	}
	else if ($_POST['cmd']==='delete')
	{
		Article::Delete($_POST['idarticle']);
	}
	else if ($_POST['cmd']==='getmarkdown')
	{
		echo Article::Read($_POST['idarticle'])->markdown;
	}
	else if ($_POST['cmd']==='gethtml')
	{
		echo Article::Read($_POST['idarticle'])->html;
	}
	else if ($_POST['cmd']==='gettitle')
	{
		echo Article::Read($_POST['idarticle'])->title;
	}
	else if ($_POST['cmd']==='update')
	{
		if (isset($_POST['markdown']))
		{
			Article::UpdateMarkdown($_POST['idarticle'],$_POST['markdown']);
		}
		if (isset($_POST['html']))
		{
			Article::UpdateHtml($_POST['idarticle'],$_POST['html']);
		}
		if (isset($_POST['title']))
		{
			Article::UpdateTitle($_POST['idarticle'],$_POST['title']);
		}
	}
	
}

?>