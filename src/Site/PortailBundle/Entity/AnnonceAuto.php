<?php
namespace Site\PortailBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\Validator as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class AnnonceAuto extends Annonce
{

private $modele;/*auto*/
private $annee;/*auto*/
private $energie;/*auto*/
private $kilometrage;/*auto*/
private $prix;/*auto*/
private $photo;/*auto*/

private $marque;
private $description;

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

public function setmodele ($modele)
{
$this->modele=$modele;
}
public function getmodele ()
{
return $this->modele;
}
public function setmarque ($marque)
{
$this->marque=$marque;
}
public function getmarque ()
{
return $this->marque;
}
public function setannee ($annee)
{
$this->annee=$annee;
}
public function getannee ()
{
return $this->annee;
}
public function setenergie ($energie)
{
$this->energie=$energie;
}
public function getenergie ()
{
return $this->energie;
}
public function setkilometrage ($kilometrage)
{
$this->kilometrage=$kilometrage;
}
public function getkilometrage ()
{
return $this->kilometrage;
}
public function setprix ($prix)
{
$this->prix=$prix;
}
public function getprix ()
{
return $this->prix;
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
/**********************************************/
public function setphoto ($photo)
{
$photo->getClientOriginalName();
 $photo->getClientMimeType();
  $photo->move(__DIR__.'/../../../../web/up/photo',$this->modele .$photo->getClientOriginalName());
  $this->photo='up/photo'.$this->modele .$photo->getClientOriginalName();
}
public function getphoto ()
{
return $this->photo;
}
public function setdescription ($descri)
{
$this->description=$descri;
}
public function getdescription ()
{
return $this->description;
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
$req = "insert into annonceauto(type,nature,id_mbr,date,email,etat,valide,modele,marque,annee,energie,kilometrage,prix,descri)value('".$this->type."','".$this->nature."','".$this->getidMbr()."','".$date."','".$this->getemail()."','".$etat."','".$valid."','".$this->modele."','".$this->marque."','".$this->annee."','".$this->energie."','".$this->kilometrage."','".$this->prix."','".$this->description."')"; 
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
$req = "select * from annonceauto order by date"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;

}
mysqli_close($cnx);
return $list;
}
/*************************************************************************/
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


$req = "select * from annonceauto where id=".$id; 
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

$req = "delete from annonceauto where id=".$id; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;
}
return false;
}
/***********************************************************************/
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

$req = "update annonceauto SET valide='o' where id='$id'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur de mise a jours : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;
}
return false;
}
/***************************************************************/
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

$req = "select * from annonceauto order by date LIMIT ".$limite; 
$res = mysqli_query($cnx,$req)OR die ("Erreur auto: ". mysql_error());
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

$req = "select * from annonceauto where type='$type'"; 
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