<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\PortailBundle\Form\InscriType;
use Site\PortailBundle\Entity\Membre;
use Site\PortailBundle\Entity\Message;
use Site\PortailBundle\Entity\AnnonceEmploi;
use Site\PortailBundle\Entity\AnnonceAuto;
use Site\PortailBundle\Entity\AnnonceImbl;
use Site\PortailBundle\Entity\AnnonceBnCoin;
use Site\PortailBundle\Entity\Sondage;
use Site\PortailBundle\Entity\ReponseSondage;
use Site\PortailBundle\Entity\Article;
class IndexController extends Controller
{
    
    public function indexAction()
    {
	$session=$this->getRequest()->getSession();
	$message=new Message();
	$session->set('messages',$message->ListeValide());
	$annonceimbl=new AnnonceImbl();
	$session->set('ancimbl',$annonceimbl->ListeSite(3));
	$annonceemploi=new AnnonceEmploi();
	$session->set('ancemploi',$annonceemploi->ListeSite(3));
	$annonceauto=new AnnonceAuto();
	$session->set('anceauto',$annonceauto->ListeSite(3));
	$annoncbn=new AnnonceBnCoin();
	$session->set('ancbn',$annoncbn->ListeSite(3));
	$sondage=new Sondage();
	  $session->set('sondage',$sondage->Liste());
	   $reponse=new ReponseSondage();
	  $session->set('reponse',$reponse->ListeReponse());
	  $article=new Article();
	  $session->set('article',$article->slide(7));
	  $session->set('alaune',$article->alaune(6));
	   $session->set('documentaire',$article->ListeSite('documentaire'));
	   $session->set('film',$article->ListeSite('film'));
	   $session->set('top_occidental',$article->ListeSite('top_occidental'));
	   $session->set('top_oriental',$article->ListeSite('top_oriental'));
        return $this->render('SitePortailBundle:Portail:index.html.twig',array('m'=>''));
    }
	
}
