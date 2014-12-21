<?php
namespace Site\PortailBundle\Entity;

class CommantArticle 
{

Private $id;

Private $id_article;

private $commentaire;

private $email;

private $nom;
private $id_mbr;

public function setid($id)
{
$this->id=$id;
}

public function getid_mbr()
{
return $this->id_mbr;
}
public function setid_mbr($id_mbr)
{
$this->id_mbr=$id_mbr;
}

public function getid()
{
return $this->id;
}
public function setid_article($id_article)
{
$this->id_article=$id_article;
}

public function getid_article()
{
return $this->id_article;
}


public function setnom($nom)
{
$this->nom=$nom;
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

public function setcommentaire($commentaire)
{
$this->commentaire=$commentaire;

}

public function getcommentaire()
{
return $this->commentaire;

}


/*******************************************************************/
public function Save()
{
$cnx=mysqli_connect('localhost','root');
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 

$date=date("Y-m-d H:i:s");

$db="portail";
mysqli_select_db($cnx,$db)or
    die('Impossible de selectionne la base de donnee'. mysql_error()); 
mysqli_query($cnx,"SET NAMES 'utf8'");

$req = "insert into commentaire(id_article,id_mbr,nom,email,commentaire,date)value('".$this->id_article."','".$this->id_mbr."','".$this->nom."','".$this->email."','".$this->commentaire."','".$date."')"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());
mysqli_close($cnx);
if(!$res)
return false;
else 
return true;

}
/**************************************************************************/
public function list_commentaire($id_article)
{
$cnx=mysqli_connect('localhost','root');
    
  if(!$cnx) 
   { 
    die('Impossible de se connecter au serveur MySQL'. mysql_error());
	
    } 
$db="portail";
mysqli_select_db($cnx,$db)or
    die('Impossible de selectionne la base de donnee'. mysql_error()); 


$req = "select * from commentaire where id_article='$id_article'"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'affichage : ". mysql_error());
$list= array();


while($row = mysqli_fetch_object($res)) 
{
$list[]=$row;

}

mysqli_close($cnx);
return $list;
}
/**********************************************/

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

}