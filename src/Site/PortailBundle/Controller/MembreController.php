<?php

namespace Site\PortailBundle\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Site\PortailBundle\Form\Inscription;
use Site\PortailBundle\Entity\Membre;
use Site\PortailBundle\Entity\Message;
use Site\PortailBundle\Entity\AnnonceEmploi;
use Site\PortailBundle\Entity\AnnonceAuto;
use Site\PortailBundle\Entity\AnnonceImbl;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\OptionableView;
class MembreController extends Controller
{
public function indexAction()
    {
	
	$message=new Message();
	$annonceimbl=new AnnonceImbl();
	$ancimbl=$annonceimbl->ListeSite(3);
	$annonceemploi=new AnnonceEmploi();
	$ancemploi=$annonceemploi->ListeSite(3);
	$annonceauto=new AnnonceAuto();
	$anceauto=$annonceauto->ListeSite(3);
        return $this->render('SitePortailBundle:Portail:index.html.twig',array('m'=>'','messages'=>$message->ListeValide(),'anceauto'=>$anceauto,'ancemploi'=>$ancemploi,'ancimbl'=>$ancimbl));
    }

public function ConnexionAction()
{

$m='';
$membre = new Membre();

$request = $this->container->get('request');
  $session=$this->getRequest()->getSession();
     if($request->getMethod() =='POST')
	 {
	 	 

	 
     $membre->setmotpasse($request->get('pwd'));
     $membre->setemail($request->get('email'));
    
        if($membre->connect())
		{
		 $session->set('type',"membre");
     $session->set('nom',$membre->getnom());
     $session->set('id',$membre->getid()); 
     $session->set('email',$membre->getemail()); 
	  
	 }
	 else
	 {
      $this->get('session')->setFlash('erreur',"verifier votre login et mot de pass");
	   
	  }
	  }
	 $message=new Message();
     return $this->redirect($this->generateUrl('SitePortailBundle_homepage'));

}

/************************************************************/
public function DeconnexionAction()
{

$session=$this->get('Session');

if($session->get('type')=="membre")

{
$session->remove('type');
$session->remove('nom');
$session->remove('id');
$session->clear();
$session->close();

}
return $this->render('SitePortailBundle:Portail:index.html.twig',array('m'=>''));
//return $this->render($this->generateUrl('SitePortailBundle_homepage'));
//return new RedirectResponse($this->container->get('router')->generate('SitePortailBundle_homepage'));	 

}
/********************************************************/
public function AjoutAction()
{

$message='';
$membre = new Membre();
$form = $this->container->get('form.factory')->create(new Inscription(),$membre);
$request = $this->container->get('request');

  
     if($request->getMethod()=='POST')
	 {
	 $form->bindRequest($request);

    if ($form->isValid()) 
    
	 {
	       if(!$membre->save())
		throw new NotFoundHttpException(" membre deja exist");
		else
		  {
         $message='bien enregistrer';
	     return $this->container->get('templating')->renderResponse('SitePortailBundle:Membre:inscription.html.twig',array('message'=>$message)); 
	      }
		  }
    }
	 
return $this->container->get('templating')->renderResponse('SitePortailBundle:Membre:inscription.html.twig',array('message'=>$message,'form' => $form->createView()));
 



}
/*************************************************/
public function EditAction($id=null)
    {
	$mbr = new Membre();
	$membre=new Membre();
	$message='';
	
$request = $this->container->get('request');

 if ($request->getMethod() == 'POST') 
    {
	      $membre->setid($request->get('id'));
		$membre->setnom($request->get('nom'));
        $membre->setprenom($request->get('prenom'));
        $membre->setmotpasse($request->get('motpass'));
        $membre->setemail($request->get('email'));
        $membre->settel($request->get('tel'));
       /* $membre->settype($request->getParameter('type'));
		if($membre->type='entreprise')
	    {
		$membre->setsociet=$request.getParameter('nom_societe');
		}*/
	  
	    if($membre->update())
		{
	    
	    return $this->container->get('templating')->renderResponse('SitePortailBundle:Membre:editMembre.html.twig',array('message'=>"modification enregistrer ")); 
	     }
		 else 
		 return $this->container->get('templating')->renderResponse('SitePortailBundle:Membre:editMembre.html.twig',array('message'=>"erreur")); 
	}
	else
	{
	$membre->find($id);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Membre:editMembre.html.twig',array('message'=>$message,'membre'=>$membre)); 
	}
   }
/**************************************************************************/
public function listAction()
{

$membre = new Membre();


      $membres=$membre->findAll();
	   if(!$membres)
		throw new NotFoundHttpException("Erreur");
		else
		{
		$message='la liste de touts les Membres';
		$adapter =new ArrayAdapter($membres);
     /* j' utilise un         Adapter que je  vais  passer à pagerfanta*/
     $pagerfanta = new Pagerfanta($adapter); // j' instancie pagerfanta
     $pagerfanta->setMaxPerPage(5);//je fixe le nombre d'articles par page à 5
     $request = $this->get('request');
     $page = $request->query->get('page',1);
     try
    {
         $pagerfanta->setCurrentPage($page);
     }
     catch (\Pagerfanta\Exception\NotValidCurrentPageException $e)
    {
         $this->createNotFoundException();
     }
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Membre:MembreAll.html.twig',array('pagerfanta' => $pagerfanta,'message'=>$message)); 
        
        }
}		

/****************************************************/
public function ForgetAction()
{

$membre = new Membre();
    $confirme='';  
      	
$request = $this->container->get('request');

 if ($request->getMethod() == 'POST') 
    {
    $membre->setemail($request->get('email'));
    if(!$membre->findEmail($membre->getemail()))
    $confirme="votre email n exit pas dans la base de donnee fire l'inscription d'abord";
    else 
    {
    $confirme="votre mot de pass est envoye dans un email";

	
 $mailer = $this->get('mailer');

        // Création de l'e-mail : le service mailer utilise SwiftMailer, donc nous créons une instance de Swift_Message.
        $message = \Swift_Message::newInstance()
            ->setSubject('Mot de passe de site six-douze')
            ->setFrom('benalii.zeineb@gmail.com')
            ->setTo($membre->getemail())
            ->setBody('Coucou, voici un email que vous venez de recevoir !et vote mot passe est '.$membre->getmotpasse());

        // Retour au service mailer, nous utilisons sa méthode « send() » pour envoyer notre $message.
        $mailer->send($message);

    return $this->container->get('templating')->renderResponse('SitePortailBundle:Membre:forgetPwd.html.twig',array('confirme'=>$confirme));

    }
    }
return $this->container->get('templating')->renderResponse('SitePortailBundle:Membre:forgetPwd.html.twig',array('confirme'=>$confirme));
      
}			
 
}