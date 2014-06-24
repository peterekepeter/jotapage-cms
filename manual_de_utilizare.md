

# Manual de utilizare #

Pentru aplicatia nanoCMS (Proiect final Proiectare Software)

## Technologii folosite ##

 - HTML5
 - CSS 3.0
 - Javascript
 - jQuery
 - Ajax
 - Regexp
 - PHP5
 - PDO
 - SQL


## Instalarea ##

Aplicatia are nevoie de un server HTML cu support pentru PHP5 si de o baza de date. Documentele trebuie copiate la documentele acesibile de server si petru baza de date trebuie rulat scriptul SQL pentru a genera tabelele cu utilizatorul implicit.

Fisierul config.php contine setarile pentru conectiunea la baza de date.

Proiectul a fost dezvoltat folosind Apache, PHP5 si MySQL.


### Instalarea baza de date ###

1. Se instaleaza serverul [MySQL](http://www.mysql.com/)
2. Se importeaza baza de date din fisierul SQL 'schema.sql'
3. Conectiunea la baza de date este setata dintr-un fisier de sursa 'config.php'

### Instalarea pe XAMPP ###

XAMPP contine toate programele de care are nevoie aplicatia. Este mai simplu de configurat decat un server normal.

1. Se instaleaza XAMPP
2. Folosind phpMyAdmin se importeaza schema bazei de date
3. Se copiaza documentele la un subfolder al folderului htdocs
4. Se acceseaza siteul 'localhost/subfolder/login.html'


## Folosirea ##

Aplicatia se porneste din pagina de login. 'login.html'

Fisierul SQL creeaza implicit un utilizator cu toate drepturile de acces. Acest utilizator are numele si parola setate la 'admin'.

Aplicatia vine cu un articol tutorial in interiorul bazei de date care exemplifica folosirea editorului de articole.


## Dezvoltare ##

Proiectul a fost dezvoltat in Notepad++ si JetBrains WebStorm. Dezvoltarea in continuare se poate face cu orice editor de text.


