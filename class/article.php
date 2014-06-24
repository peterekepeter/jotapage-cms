<?php
include_once 'data.php';

class Article
{
	public $idarticle;
	public $title;
	public $author;
	public $markdown;
	public $html;
	public $created;
	
	public static function Create($title, $author, $markdown,$html)
	{
		$data = getDataConnection();
		$st = $data->prepare("insert into `article` (`title`, `author`, `markdown`, `html`) values (:title,:author,:markdown,:html);");
		$st->execute(array(':title'=>$title,':author'=>$author,':markdown'=>$markdown,':html'=>$html));
	}
	public static function Read($idarticle)
	{
		$data = getDataConnection();
		$st = $data->prepare("select * from `article` where `idarticle` = :idarticle");
		$st->execute(array(':idarticle' => $idarticle));
		return $st->fetchObject("Article");
	}
	public static function Delete($idarticle)
	{
		$data = getDataConnection();
		$st = $data->prepare("delete from `article` where `idarticle` = :idarticle;");
		$st->execute(array(':idarticle' => $idarticle));
	}
	public static function View()
	{
		$data = getDataConnection();
		$st = $data->prepare("select * from `article` order by `created` desc;");
		$st->execute();
		return $st->fetchAll(PDO::FETCH_CLASS,"Article");
	}
	public static function UpdateMarkdown($idarticle,$markdown)
	{
		$data = getDataConnection();
		$st = $data->prepare("update `article` set `markdown` = :markdown where `idarticle` = :idarticle;");
		$st->execute(array(':markdown' => $markdown, ':idarticle' => $idarticle));
	}
	public static function UpdateHtml($idarticle,$html)
	{
		$data = getDataConnection();
		$st = $data->prepare("update `article` set `html` = :html where `idarticle` = :idarticle;");
		$st->execute(array(':html' => $html, ':idarticle' => $idarticle));
	}
	public static function UpdateTitle($idarticle,$title)
	{
		$data = getDataConnection();
		$st = $data->prepare("update `article` set `title` = :title where `idarticle` = :idarticle;");
		$st->execute(array(':title' => $title, ':idarticle' => $idarticle));
	}
}

?>