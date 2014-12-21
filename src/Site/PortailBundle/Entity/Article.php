<?php
namespace Site\PortailBundle\Entity;
use Symfony\component\Validator as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class Article
{

private $id;
private $nom;
private $email;
private $titre;
private $contenu;
private $media;
private $categorie;
private $id_admin;
private $id_mbr;
private $date;
private $lien;

/************************************************************/
public function setnom($nom)
{
$this->nom=$nom;
}
public function getnom()
{
return $this->nom;
}
public function setlien($lien)
{
$this->lien=$lien;
}
public function getlien()
{
return $this->lien;
}
public function setemail($email)
{
$this->email=$email;
}
public function getemail()
{
return $this->email;

}
public function setid ($id)
{
$this->id=$id;
}

public function getid ()
{
return $this->id;
}
public function settitre ($titre)
{
$this->titre=$titre;
}
public function gettitre ()
{
return $this->titre;
}
public function setcontenu ($contenu)
{
$this->contenu=$contenu;
}
public function getcontenu ()
{
return $this->contenu;
}
public function setid_admin ($id_admin)
{
$this->id_admin=$id_admin;
}
public function getid_admin ()
{
return $this->id_admin;
}
public function setid_mbr ($id_mbr)
{
$this->id_mbr=$id_mbr;
}
public function getid_mbr ()
{
return $this->id_mbr;
}
public function setmedia ($media)
{
$media->getClientOriginalName();
 $media->getClientMimeType();
  $media->move(__DIR__.'/../../../../web/up/media/',$this->titre .$media->getClientOriginalName());
  $this->media='up/media/'.$this->titre .$media->getClientOriginalName();
}
public function getmedia ()
{
return $this->media;
}
public function setcategorie ($categorie)
{
$this->categorie=$categorie;
}
public function getcategorie ()
{
return $this->categorie;
}
public function setdate ($date)
{
$this->date=$date;
}
public function getdate ()
{
return $this->date;
}

public function Save($acteur)
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
mysqli_query($cnx,"SET NAMES 'utf8'");
$date=date('y-m-d h:i:s');
if($acteur=='admin')
{
$valid="o";
$req = "insert into article(id_admin,titre,contenu,media,categorie,date,valider,lien)value('".$this->id_admin."','".$this->titre."','".$this->contenu."','".$this->media."','".$this->categorie."','".$date."','".$valid."','".$this->lien."')"; 
}
else if($acteur=='membre'){
$valid="n";/*n =annonce non valide o= annonce valide*/
$req = "insert into article(nom,email,id_mbr,titre,contenu,media,categorie,date,valider)value('".$this->nom."','".$this->email."','".$this->id_mbr."','".$this->titre."','".$this->contenu."','".$this->media."','".$this->categorie."','".$date."','".$valid."')"; 
}

$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());
mysqli_close($cnx);
if(!$res)
return false;
else 
return true;


}


public function listAll($categorie)
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
   mysqli_query($cnx,"SET NAMES 'utf8'");
$req = "select * from article where categorie='$categorie'"; 
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

mysqli_query($cnx,"SET NAMES 'utf8'");
$req = "select * from article where id=".$id; 
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
mysqli_query($cnx,"SET NAMES 'utf8'");
$req = "delete from article where id=".$id; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;
}
return false;
}
/************************************************************/
public function valider($id)
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
mysqli_query($cnx,"SET NAMES 'utf8'");
$req = "update article SET valider='o' where id='$id'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur de mise a jours : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;
}
return false;
}
/*******************************************************************/
public function ListeSite($categorie)
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
mysqli_query($cnx,"SET NAMES 'utf8'");
$req = "select * from article where valider='o'AND categorie='$categorie' order by date "; 
$res = mysqli_query($cnx,$req)OR die ("Erreur imble : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;

}
mysqli_close($cnx);
return $list;
}
/****************************************************************/
public function recherche($cle)
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
mysqli_query($cnx,"SET NAMES 'utf8'");

$req = "select * from article where titre='%$cle%' OR contenu='%$cle%'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
if(!$res){return false;}
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;

}
mysqli_close($cnx);
return $list;
}
/*********************************************************/

public function listCategorie()
{

$host='localhost';
$user='root';
$db='portail';
$cnx=mysqli_connect($host,$user);
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 
	mysqli_query($cnx,"SET NAMES 'utf8'");
if (!mysqli_select_db($cnx,$db))
   { die('Impossible de selectionne la base de donnee'. mysql_error()); }
$req = "select categorie,COUNT(*)As total from article GROUP BY categorie"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;

}
mysqli_close($cnx);
return $list;
}
/**********************************************************/
public function slide($limite)
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
mysqli_query($cnx,"SET NAMES 'utf8'");
$req = "select * from article where valider='o' ORDER BY date ASC LIMIT ".$limite; 
$res = mysqli_query($cnx,$req)OR die ("Erreur imble : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;

}
mysqli_close($cnx);
return $list;
}
/********************************************/
public function alaune($limite)
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
mysqli_query($cnx,"SET NAMES 'utf8'");
$req = "select * from article where valider='o' AND (categorie='news national' or categorie='news international') ORDER BY date ASC LIMIT ".$limite; 
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