<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\PortailBundle\Entity\connexion;
use Site\PortailBundle\Entity\membre;
class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('SitePortailBundle:Default:index.html.php');
    }
	public function connexionAction()
    {
	   $connexion= new connexion();
	   
        return $this->render('SitePortailBundle:Default:connexion.html.php',array('connexion'=>$connexion));
    }
	/**************************************************/
	 public function ajoutAction()
    {
	$request = $this->getRequest();
	$this->forwardUnless($mbr = $request->getParameter('nom', 'prenom', 'tel','email','pwd'));
$m=new Membre();
if($m->SetMembre($mbr))
{
        return $this->render('SitePortailBundle:Default:inscri.html.php');
		}
    }
}
