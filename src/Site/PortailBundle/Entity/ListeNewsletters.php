<?php
namespace Site\PortailBundle\Entity;

class ListeNewsletters
{

Private $id;

Private $email;
/**************************************************************/
public function save($email)
{
$host='localhost';
$user='root';
$db='portail';

$cnx=mysqli_connect($host,$user);
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 
	
if (!mysqli_select_db($cnx,$db))
   { die('Impossible de selectionne la base de donnee'. mysql_error()); }

if( $this->find($email) )
{
$req = "INSERT INTO list_nl VALUES('".$email."')"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;
}
return false;

}
else return false;
 
}
/********************************************************************/
public function affichAll ()
{

$host='localhost';
$user='root';
$db='portail';

$cnx=mysqli_connect($host,$user);
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 
	
if (!mysqli_select_db($cnx,$db))
   { die('Impossible de selectionne la base de donnee'. mysql_error()); }



$req = 'select * from list_nl';
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;
}
mysqli_close($cnx);
return $list;
}
/****************************************************/
public function delete($email)
{
$host='localhost';
$user='root';
$db='portail';
$cnx=mysqli_connect($host,$user);
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 
	
if (!mysqli_select_db($cnx,$db))
   { die('Impossible de selectionne la base de donnee'. mysql_error()); }

$req = "delete from list_nl where email='$email'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;
}
return false;
}
/************************************************************************/
public function find($email)
{

	
$req = "select * from list_nl where email='$email'";
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$num_rows = mysqli_affected_rows($cnx);

if($num_rows==1)
{
return false;
}
return true;
}
}