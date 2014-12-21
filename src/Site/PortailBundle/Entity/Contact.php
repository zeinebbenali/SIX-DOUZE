<?php
namespace Site\PortailBundle\Entity;

class Contact 
{

Private $id;

Private $nom;

private $prenom;

private $email;

private $objet;

private $message;
private $date;
private $etat;

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


public function getnom()
{
return $this->nom;
}

public function setprenom($prenom)
{
$this->prenom=$prenom;
}

public function getprenom()
{
return $this->prenom;
}

public function setemail($email)
{
$this->email=$email;
}

public function getemail()
{
return $this->email;
}

public function setobjet($objet)
{
$this->objet=$objet;

}

public function getobjet()
{
return $this->objet;

}
public function setMessage($msg)
{
$this->message=$msg;

}

public function getMessage()
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
/*******************************************************************/
public function Save()
{
$cnx=mysqli_connect('localhost','root');
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 
$nom=$this->nom;
$prenom=$this->prenom;
$email=$this->email;
$objet=$this->objet;
$msg=$this->message;
$etat="c";/* c= message non lu et o= message lu */ 
$date=date('Y-d-m');

$db="portail";
mysqli_select_db($cnx,$db)or
    die('Impossible de selectionne la base de donnee'. mysql_error()); 


$req = "insert into contact(nom,prenom,email,objet,contenu,etat,date_envoie)value('".$nom."','".$prenom."','".$email."','".$objet."','".$msg."','".$etat."','".$date."')"; 
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


$req = "select * from contact where etat LIKE 'c'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$list= array();


while($row = mysqli_fetch_object($res)) 
{
$list[]=$row;
/*$id=$row->id_contact;
$req = "update contact SET etat='o' where id_contact='$id'"; 
$res= mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());*/
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


$req = "select * from contact"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;
/*$id=$row->id_contact;
$req = "update contact SET etat='o' where id_contact='$row->id_contact'"; 
$res= mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());*/
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

$req = "delete from contact where id_contact=".$id; 
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


$req = "select * from contact where id_contact=".$id; 
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
}