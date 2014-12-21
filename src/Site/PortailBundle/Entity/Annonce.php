<?php
namespace Site\PortailBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\Validator as Assert;

class Annonce
{

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
public function setid ($id)
{
$this->id=$id;
}
public function getid ()
{
return $this->id;
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
{}




}