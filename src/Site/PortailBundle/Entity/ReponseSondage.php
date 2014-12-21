<?php
namespace Site\PortailBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\Validator as Assert;

class ReponseSondage
{

private $reponse;
private $nbr_rep;


public function setreponse($reponse)
{
$this->reponse=$reponse;
}

public function getreponse()
{
return $this->reponse;
}
public function setNbrRep($i)
{
$this->nbr_rep=$i;
}

public function getNbrRep()
{
return $this->nbr_rep;
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


$req = "insert into reponse_sdg(reponse)value('".$this->reponse."')"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());

mysqli_close($cnx);
if(!$res)
{

return false;
}


return true;

}
/**********************************************/
/***************************************************************************/
public function ListeReponse()
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



$req="select * from reponse_sdg"; 

$res= mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
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

$req = "delete from reponse_sdg"; 
 

$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx)or die(mysql_error());;

}
/******************************************************************/
public function Repondre()
{
$host='localhost';
$user='root';
$db='portail';
$cnx=mysqli_connect($host,$user);
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 
$ip = $_SERVER['REMOTE_ADDR']; 	
if (!mysqli_select_db($cnx,$db))
   { die('Impossible de selectionne la base de donnee'. mysql_error()); }




$req = "insert into participe_sondage(adress_ip)value('".$ip."')"; 
$res = mysqli_query($cnx,$req);
if(!$res)
{

return false;
}
$req = "update reponse_sdg SET nbr_rep=nbr_rep+1 where reponse='$this->reponse'"; 

$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());
mysqli_close($cnx);
if(!$res)
{

return false;
}

return true;

}
}