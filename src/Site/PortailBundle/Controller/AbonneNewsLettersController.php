<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Site\PortailBundle\Entity\ListeNewsletters;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\OptionableView;

class AbonneNewsLettersController extends Controller
{

/********************************************************/
public function AjoutAbonneAction()
    {
	        
$message='';
$nl= new ListeNewsletters();

$request = $this->container->get('request');
  
     if($request->getMethod()=='POST')
	 {
	
      $email=$request->get('email');
		 if(!$nl->save($email))
				$message='erreur';

		else
		{
		$message='votre inscription enregistee';
		$this->get('session')->setFlash('enregister_abonne',$message);
	     return $this->redirect($this->generateUrl('SitePortailBundle_homepage'));
       }
         return $this->redirect($this->generateUrl('SitePortailBundle_homepage'));
 
      }
	}
/***************************************************************/	
public function ListAbonneAction()
{
 $nl=new ListeNewsletters();
         $message='';
		$liste=$nl->affichAll();
        $adapter =new ArrayAdapter($liste);
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
 
		$message='la liste de NewsLetters';
		return $this->container->get('templating')->renderResponse('SitePortailBundle:AbonneNewsLetters:ListNewletters.html.twig',array('pagerfanta' => $pagerfanta,'message'=>$message)); 
       
}	
/**********************************************************************/
public function DeleteAbonneAction($email)
    {
	     $nl=new ListeNewsletters();
         $message='';
		 $session = $this->getRequest()->getSession();
        if(!$nl->delete($email))
		throw new NotFoundHttpException("Erreur");
		else
		{
		$session->setFlash('message','abonnee est supprimee');
		return $this->redirect($this->generateUrl('SitePortailBundle_gestion_NewsLetters_liste'));
        
        }
	}
/*************************************************************/	

}	  
	  