<?php 
namespace Site\PortailBundle\Entity;
class connectmysql
{
private $host;
private $user;
private $db;
public function connectmysql($host,$user,$db)
{
$cnx=mysqli_connect($host,$user);
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 
	
if (!mysqli_select_db($cnx,$db))
   { die('Impossible de selectionne la base de donnee'. mysql_error()); }
} 

}