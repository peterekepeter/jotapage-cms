<?php

include_once 'class/article.php';
include_once 'class/user.php';


$e = Article::View(1);
print_r($e);

?>