<?php
namespace Site\PortailBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\Validator as Assert;

class Message
{

Private $id;

Private $nom;
Private $prenom;
private $tel;
private $email;
private $etat;
private $date;

private $message;
private $valid;

public function setid($id)
{
$this->id=$id;
}

public function getid()
{
return $this->id;
}


public function setnom($nom)
{
$this->nom=$nom;
}


public function getprenom()
{
return $this->prenom;
}

public function setprenom($prenom)
{
$this->prenom=$prenom;
}


public function getnom()
{
return $this->nom;
}
public function setemail($email)
{
$this->email=$email;
}

public function getemail()
{
return $this->email;
}
public function settel($tel)
{
$this->tel=$tel;
}

public function gettel()
{
return $this->tel;
}



public function setmessage ($msg)
{
$this->message=$msg;

}

public function getmessage()
{
return $this->message;

}

public function setetat($e)
{
$this->etat=$e;

}
public function getetat()
{
return $this->etat;

}
public function setvalid($v)
{
$this->valid=$v;

}
public function getvalid()
{
return $this->valid;

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


$nom=$this->nom;

$email=$this->email;
$id=$this->id;
$msg=$this->message;
$tel=$this->tel;
$etat="c";/* c= message non lu et o= message lu */ 
$date=date('y-m-d');
$valid="n";
mysqli_query($cnx,"SET NAMES 'utf8'");
$req = "insert into message(nom,email,contenu,date,etat,valide,tel)value('".$nom."','".$email."','".$msg."','".$date."','".$etat."','".$valid."','".$tel."')"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());
mysqli_close($cnx);
if(!$res)
return false;
else 
return true;

}
/**************************************************************************/
public function ListNew()
{
$cnx=mysqli_connect('localhost','root');
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 
$db="portail";
mysqli_select_db($cnx,$db)or
    die('Impossible de selectionne la base de donnee'. mysql_error()); 
mysqli_query($cnx,"SET NAMES 'utf8'");

$req = "select * FROM message WHERE etat LIKE 'c'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;
$req = "update message SET etat='o' where id_msg=".$row->id_msg; 
$res2 = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
}

mysqli_close($cnx);
return $list;
}
/**********************************************/
public function ListAll()
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
$req = "select * from message"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;
$req = "update message SET etat='o' where id_msg=".$row->id_msg; 
$res2 = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
}
mysqli_close($cnx);
return $list;

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

$req = "delete from message where id_msg=".$id; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;
}
return false;
}
/***************************************************************************/
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
$req = "select * from message where id_msg=".$id; 
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

$req = "update message SET valide='o' where id_msg='$id'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur de mise a jours : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;
}
return false;
}
/*********************************************************************/
public function   ListeValide()
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
$req = "select * FROM message WHERE valide LIKE 'o'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;
}

mysqli_close($cnx);
return $list;
}
}