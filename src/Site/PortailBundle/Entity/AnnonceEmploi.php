<?php
namespace Site\PortailBundle\Entity;

use Symfony\component\Validator as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Site\PortailBundle\Entity\Annonce;  


class AnnonceEmploi extends Annonce
{

private $cv;
private $letter;
private $secteur;

Private $id;

Private $date;

private $email;
private $idMbr;
private $idAdmin;
private $tel;
private $nature;
private $type;


private $valid;
private $etat;
private $delai;
/************************************************************/

public function setCv ($cv)
{

$cv->getClientOriginalName();
 $cv->getClientMimeType();
  $cv->move(__DIR__.'/../../../../web/up/cv',$cv->getClientOriginalName());
  $this->cv='up/cv'.$cv->getClientOriginalName();
}
public function getCv ()
{
return $this->cv;
}
public function setLetter ($letter)
{
$this->letter=$letter;
}
public function getLetter ()
{
return $this->letter;
}
public function setSecteur ($secteur)
{
$this->secteur=$secteur;
}
public function getSecteur ()
{
return $this->secteur;
}
public function setidMbr ($idMbr)
{
$this->idMbr=$idMbr;
}
public function getidMbr ()
{
return $this->idMbr;
}


public function setnature ($nature)
{
$this->nature=$nature;
}
public function getnature ()
{
return $this->nature;
}
public function setdate ($date)
{
$this->date=$date;
}

public function getdate ()
{
return $this->date;
}

public function settel ($tel)
{
$this->tel=$tel;
}
public function gettel ()
{
return $this->tel;
}
public function setemail ($email)
{
$this->email=$email;
}
public function getemail ()
{
return $this->email;
}


public function setvalid ($valid)
{
$this->valid=$valid;
}
public function getvalid ()
{
return $this->valid;
}
public function setetat ($etat)
{
$this->etat=$etat;
}
public function getetat ()
{
return $this->etat;
}
public function setdelai ($delai)
{
$this->delai=$delai;
}

public function getdelai ()
{
return $this->delai;
}

public function settype ($type)
{
$this->type=$type;
}
public function gettype ()
{
return $this->type;
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
$etat="c";/* c= annonce  non lu et o= annonce lu */ 
$date=date('y-m-d');

$valid="n";/*n =annonce non valide o= annonce valide*/
$req = "insert into annonceemploi(id_mbr,date,email,etat,valide,letter,secteur,cv,nature,type)value('".$this->getidMbr()."','".$date."','".$this->getemail()."','".$etat."','".$valid."','".$this->letter."','".$this->secteur."','".$this->cv."','".$this->nature."','".$this->type."')"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());
mysqli_close($cnx);
if(!$res)
return false;
else 
return true;


}

public function liste()
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
$req = "select * from annonceemploi"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;

}
mysqli_close($cnx);
return $list;
}

/**************************************************************/
public function find($id)
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


$req = "select * from annonceemploi where id=".$id; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
$row=mysqli_fetch_object($res);

return $row;
}
return false;



}
/***************************************************************/
public function delete($id)
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

$req = "delete from annonceemploi where id=".$id; 
$res = mysqli_query($req)OR die ("Erreur d'affichage  : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;
}
return false;
}
/*****************************************************/
public function valide($id)
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

$req = "update annonceemploi SET valide='o' where id='$id'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur de mise a jours : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;
}
return false;
}
/**********************************************************/
public function ListeSite($limite)
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

$req = "select * from annonceemploi order by date LIMIT ".$limite; 
$res = mysqli_query($cnx,$req)OR die ("Erreur emploi : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;

}
mysqli_close($cnx);
return $list;
}
/**************************************************************/
public function ListeSite2($type)
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

$req = "select * from annonceemploi where type='$type'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur imble : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;

}
mysqli_close($cnx);
return $list;
}
}