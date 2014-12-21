<?php
namespace Site\PortailBundle\Entity;

use Symfony\component\Validator as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class Newsletters
{

private $titre;
private $newsletters;
private $id_admin;
private $date;
/************************************************************/

public function setnewsletters ($newsletters)
{

$newsletters->getClientOriginalName();
 $newsletters->getClientMimeType();
  $newsletters->move(__DIR__.'/../../../../web/up/NewsLetters',$newsletters->getClientOriginalName());
  $this->newsletters='up/NewsLetters/'.$newsletters->getClientOriginalName();
}
public function getnewsletters ()
{
return $this->newsletters;
}
public function settitre ($titre)
{
$this->titre=$titre;
}
public function gettitre ()
{
return $this->titre;
}
public function setdate ($date)
{
$this->date=$date;
}
public function getdate ()
{
return $this->date;
}

public function setId_admin ($id)
{
$this->id_admin=$id;
}
public function getId_admin ()
{
return $this->id_admin;
}
public function save()
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

$date=date('y-m-d');
$req = "insert into newsletters(id_admin,date,newsletters,titre)value('".$this->id_admin."','".$date."','".$this->newsletters."','".$this->titre."')"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());
mysqli_close($cnx);
if(!$res)
return false;
else 
return true;


}
}