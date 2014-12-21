<?php
namespace Site\PortailBundle\Entity;

use Site\PortailBundle\Entity\Admin;
class Sondage
{

Private $id;

Private $question;

private $nbr;
private $idAdmin;

public function setid($id)
{
$this->id=$id;
}

public function getid()
{
return $this->id;
}


public function setquestion($question)
{
$this->question=$question;
}


public function getquestion()
{
return $this->question;
}

public function setnbr($nbr)
{
$this->nbr=$nbr;
}

public function getnbr()
{
return $this->nbr;
}

public function setIdAdmin($id)
{
$this->idAdmin=$id;
}

public function getIdAdmin()
{
return $this->idAdmin;
}

/*******************************************************************/
public function Save()
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


$question=$this->question;


$nbr=$this->nbr;
$id=$this->idAdmin;

$date=date('y-m-d');
$this->delete();
mysqli_query($cnx,"SET NAMES 'utf8'");
$req = "insert into sondage(question,nbr,date,id_admin)value('".$question."','".$nbr."','".$date."','".$id."')"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());
mysqli_close($cnx);
if(!$res)
{

return false;
}
else 
return true;

}
/**********************************************/
/***************************************************************************/
public function Liste()
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


$req = "select * from sondage "; 
mysqli_query($cnx,"SET NAMES 'utf8'");
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
if(!$res)
return false;

$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;
}

mysqli_close($cnx);
return $list;



}
/***************************************************************/
public function delete()
{

$req = "delete from sondage"; 
 

$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);



}
/******************************************************************/
}