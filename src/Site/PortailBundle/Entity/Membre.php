<?php
namespace Site\PortailBundle\Entity;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Site\PortailBundle\Entity\connectmysql;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class Membre
{

Private $id;
Private $nom;
private $prenom;
private $email;
private $motpasse;
private $confirme_motpasse;
private $tel;
private $type;
private $societe;
private $photo;
private $accepte;


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
public function setmotpasse($motpasse)
{
$this->motpasse=$motpasse;

}
public function getmotpasse()
{
return $this->motpasse;
}
public function setConfirmeMotpasse($confirme_motpasse)
{
$this->confirme_motpasse=$confirme_motpasse;

}
public function getConfirmeMotpasse()
{
return $this->confirme_motpasse;
}
public function settype($type)
{
$this->type=$type;
}
public function gettype()
{
return $this->type;
}
public function settel($tel)
{
$this->tel=$tel;

}
public function gettel()
{
return $this->tel;
}
public function setAccepte($accepte)
{
$this->accepte=$accepte;

}
public function getAccepte()
{
return $this->accepte;
}
public function setsociete($societe)
{
$this->societe=$societe;

}
public function getsociete()
{
return $this->societe;

}
public function getphoto()
{
return $this->photo;
}
public function setphoto($photo)
{
$photo->getClientOriginalName();
 $photo->getClientMimeType();
  $photo->move(__DIR__.'/../../../../web/up/photo',$photo->getClientOriginalName());
  $this->photo='up/photo'.$photo->getClientOriginalName();
}

/*************************/
public function connect()
{

$email=$this->email;
$pwd=$this->motpasse;
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


$req = "select * from membre where email='$email'and pwd_mbr='$pwd'";
$res = mysqli_query($cnx,$req);
    if(!$res)
         return false;
    else 
     {
      $num_rows = mysqli_num_rows($res);
         if($num_rows==1)
            {
            $res=mysqli_fetch_object($res);
            $this->id=$res->id_mbr;
            $this->nom=$res->nom_mbr;
			$this->prenom=$res->prenom_mbr;
			$this->email=$res->email;
			$this->type=$res->type;
			$this->societe=$res->nom_societe;
			$this->tel=$res->tel;
			return true;
			}

else
	return false;
	}
	

}



/*********************************************/
public function findAll ()
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



$req = 'select * from membre';
$res = mysqli_query($cnx,$req);
$num_rows = mysqli_num_rows($res);
if($num_rows==0)
{
mysqli_close($cnx);
return false;}
$list= array();


while ($row = mysqli_fetch_object($res)) 
{
$list[]=$row;
}

mysqli_close($cnx);
return $list;





}
/*****************************************/

public function find ($id)
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



$req = "select * from membre where id_mbr='$id'";
$res = mysqli_query($cnx,$req);
$num_rows = mysqli_num_rows($res);
if($num_rows==1)
{
$res=mysqli_fetch_object($res);
$this->id=$res->id_mbr;
$this->nom=$res->nom_mbr;
$this->prenom=$res->prenom_mbr;
$this->email=$res->email;
$this->type=$res->type;
$this->societe=$res->nom_societe;
$this->tel=$res->tel;
mysqli_close($cnx);
return true;

}
else return false;

}

/**********************************/
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
$prenom=$this->prenom;
$tel=$this->tel;
$email=$this->email;
$motpass=$this->motpasse;
$photo=$this->photo;
$type=$this->type;
$societe=$this->societe;

$req = "insert into membre(pwd_mbr,nom_mbr,prenom_mbr,email,tel,photo,type,nom_societe)value('".$motpass."','".$nom."','".$prenom."','".$email."','".$tel."','".$photo."','".$type."','".$societe."')"; 
$res = mysqli_query($cnx,$req)OR die ("Erreur d'Insertion dans la base : ". mysql_error());
mysqli_close($cnx);
if(!$res)
return false;
else 
return true;

}
/*************************************************/
public function remove ($id)
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

$req = 'DELETE FROM membre WHERE id_mbr='.$id;
$res = mysqli_query($cnx,$req);
$num_rows = mysqli_affected_rows($res);
mysqli_close($cnx);
if($num_rows==1)
{
return true;

}
return false;
}
/********************************************************/
public function update()
{
$id=$this->id;
$nom=$this->nom;
$prenom=$this->prenom;
$tel=$this->tel;
$email=$this->email;
$motpass=$this->motpasse;
/*$societe=$this->societe;
$type=$this->type;*/
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


$req = "update membre SET nom_mbr='$nom',prenom_mbr='$prenom',tel='$tel',email='$email',pwd_mbr='$motpass'where id_mbr='$id'";
$res = mysqli_query($cnx,$req);
$num_rows = mysqli_affected_rows($cnx);
mysqli_close($cnx);
if($num_rows==1)
{
return true;

}
return false;
}
/**************************************************************************/
public function findEmail ($email)
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



$req = "select * from membre where email='$email'";
$res = mysqli_query($cnx,$req);
$num_rows = mysqli_num_rows($res);
mysqli_close($cnx);
if($num_rows==1)
{
$res=mysqli_fetch_object($res);
$this->id=$res->id_mbr;
$this->nom=$res->nom_mbr;
$this->prenom=$res->prenom_mbr;
$this->email=$res->email;
$this->type=$res->type;
$this->societe=$res->nom_societe;
$this->tel=$res->tel;

return true;

}
else return false;

}
/*********************************************************/
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


$req = "select * from membre where nom='%$cle%' OR prenom='%$cle%'"; 
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
}