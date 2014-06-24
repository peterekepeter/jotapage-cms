CREATE DATABASE  IF NOT EXISTS `devcms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `devcms`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: devcms
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `idarticle` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `markdown` text,
  `html` text,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idarticle`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (6,'How to use Markdown (tutorial)','admin','\n# How to use Markdown (tutorial) #\n\nThis is meant as a tutorial for the article editor. It shows some of the features it\'s capable of.\n\n## Introduction ##\n\nMarkdown is a text-to-HTML conversion tool for web writers. Markdown allows you to write using an easy-to-read, easy-to-write plain text format, then convert it to structurally valid XHTML (or HTML).\n\nThus, â€œMarkdownâ€ is two things: (1) a plain text formatting syntax; and (2) a software tool, written in Perl, that converts the plain text formatting to HTML. See the Syntax page for details pertaining to Markdownâ€™s formatting syntax. You can try it out, right now, using the online Dingus.\n\n[source](http://daringfireball.net/projects/markdown)\n\n---\n\n## Formatting ##\n\n*Italic*, **Bold**, ***BoldItalic*** can be used by putting words between `*` characters.\n\n> You can quote someone if you start the line with the `>` character.\n\nParagraphs are separated by an empty line.\nIf you only have a single line break, it\'s still considered as the same paragraph.\n\nYou can write lists:\n\n- orange\n- green\n- yellow\n\nYou can write ordered lists:\n\n1. Type a number at the start of the line \n2. Put a dot next to it\n4. Leave one space before typing something\n\nYou can include preformatted code in your articles by starting the line with 4 spaces or a tab character. You can add horizontal separators by adding at least 3 dashes.\n\n\n    var markdown = \"\";\n\nYou can also put [links](http://www.google.com) in your article. If you prepend the link with a `!` character then the link will be interpreted.\n\n![](http://localhost/devcms/favicon.png)\n\nIt\'s supposed to be easy!','\n<h1> How to use Markdown (tutorial) </h1>\n\n<p>This is meant as a tutorial for the article editor. It shows some of the features it\'s capable of.\n</p>\n<h2> Introduction </h2>\n\n<p>Markdown is a text-to-HTML conversion tool for web writers. Markdown allows you to write using an easy-to-read, easy-to-write plain text format, then convert it to structurally valid XHTML (or HTML).\n</p>\n<p>Thus, â€œMarkdownâ€ is two things: (1) a plain text formatting syntax; and (2) a software tool, written in Perl, that converts the plain text formatting to HTML. See the Syntax page for details pertaining to Markdownâ€™s formatting syntax. You can try it out, right now, using the online Dingus.\n</p>\n<p><a href=http://daringfireball.net/projects/markdown>source</a>\n</p>\n<p><hr/></p>\n<h2> Formatting </h2>\n\n<p><em>Italic</em>, <strong>Bold</strong>, <em><strong>BoldItalic</strong></em> can be used by putting words between `*` characters.\n</p>\n<blockquote> You can quote someone if you start the line with the `&gt;` character.</blockquote>\n\n<p>Paragraphs are separated by an empty line.\nIf you only have a single line break, it\'s still considered as the same paragraph.\n</p>\n<p>You can write lists:\n</p>\n<ul><li>orange</li>\n<li>green</li>\n<li>yellow</li>\n\n</ul><p>You can write ordered lists:\n</p>\n<ol><li class=\"ordered\">Type a number at the start of the line </li>\n<li class=\"ordered\">Put a dot next to it</li>\n<li class=\"ordered\">Leave one space before typing something</li>\n\n</ol><p>You can include preformatted code in your articles by starting the line with 4 spaces or a tab character. You can add horizontal separators by adding at least 3 dashes.\n</p>\n<pre><code>    var markdown = \"\";</code></pre>\n\n<p>You can also put <a href=http://www.google.com>links</a> in your article. If you prepend the link with a `!` character then the link will be interpreted.\n</p>\n<p><img width=\"max-width:100%\" src=http://localhost/devcms/favicon.png></a>\n</p>\nIt\'s supposed to be easy!','2014-06-05 15:50:49');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin','sha256:1000:0iOfaKzVAzLd7mn8JqQ0rxnmMTV1v8rz:UlN+v4PZNkEAS9gTJOYr6VxER/mfIZwL','admin@locakhost.com','2014-06-05 15:20:36',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-05 20:14:20
