<?php
namespace Site\PortailBundle\Entity;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class Admin
{

Private $id;

Private $nom;


private $login;

private $motpasse;
private $Confirme_motpasse;
/**************************************************************************/

public function setid($id)
{
$this->id=$id;
}
public function getid()
{
return $this->id;
}
/*************************************************************************/
public function setnom($nom)
{
$this->nom=$nom;
}
public function getnom()
{
return $this->nom;
}

/*************************************************************************/
public function setlogin($login)
{
$this->login=$login;
}
public function getlogin()
{
return $this->login;
}
/*********************************************************************/
public function setmotpasse($pwd)
{
$this->motpasse=$pwd;

}
public function getmotpasse()
{
return $this->motpasse;
}
/***************************************************************/
public function setConfirmeMotpasse($pwd)
{
$this->Confirme_motpasse=$pwd;

}
public function getConfirmeMotpasse()
{
return $this->Confirme_motpasse;
}
/********************************************************************/
public function connect()
{

$host='localhost';
$user='root';
$db='portail';
$login=$this->login;
$pwd=$this->motpasse;
$cnx=mysqli_connect($host,$user);
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 
	
if (!mysqli_select_db($cnx,$db))
   { die('Impossible de selectionne la base de donnee'. mysql_error()); }


$req = "select * from administrateur where log_admin='$login'and pwd_admin='$pwd'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);

if($num_rows==1)
{
$row=mysqli_fetch_object($res);
$this->id=$row->id_admin;
$this->nom=$row->nom_admin;
$this->login=$row->log_admin;
if ($row->status=="admin")
return 'admin';
else
return 'superviseur';
}

mysqli_close($cnx);
return 'erreur';

}
/********************************************************************
public function deconnexion()
{

session_destroy(); 
return true;
}

return false;

}
/****************************************************************/
public function listAll()
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



$req = "select * from administrateur where status='admin' ";
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;
}
mysqli_close($cnx);
return $list;
}


/**********************************/
public function Save()
{

$nom=$this->nom;
$login=$this->login;
$motpass=$this->motpasse;


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

else 
{

$req = "insert into administrateur(pwd_admin,nom_admin,log_admin,status)value('".$motpass."','".$nom."','".$login."','admin')"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());
mysqli_close($cnx);
if(!$res)
return false;
else 
return true;
}
}
/***********************************************************/
public function delete ($id)
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

else 
{

$req = "delete FROM administrateur WHERE id_admin='$id'";
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage  : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx)or die('impossible de fermer le connexion'. mysql_error());
if($num_rows==1)
{
return true;
}
return false;
}
}
/********************************************************************/
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

else 
{
$req = "select * FROM administrateur WHERE id_admin='$id'";
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage 22222 : ". mysql_error());

$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx)or die('impossible de fermer le connexion'. mysql_error());
if($num_rows==1)
{
$row=mysqli_fetch_object($res);
$this->id=$row->id_admin;
$this->nom=$row->nom_admin;
$this->login=$row->log_admin;
$this->motpasse=$row->pwd_admin;

return true;
}
return false;

}

}
/*******************************************************/
public function modifier()
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
$login=$this->login;
$id=$this->id;
$nom=$this->nom;
$pwd=$this->motpasse;

$req = "update administrateur SET log_admin='$login',nom_admin='$nom',pwd_admin='$pwd'WHERE id_admin='$id'";
if(mysqli_query($cnx,$req))
{return true;
}
else
{

die ("Erreur  : ". mysql_error());
return false;
}

mysqli_close($cnx)or die('impossible de fermer le connexion'. mysql_error());


}
}