<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Site\PortailBundle\Entity\Newsletters;
use Site\PortailBundle\Form\NewslettersForm;


class NewsLettersController extends Controller
{
public function IndexAction()
{
return $this->container->get('templating')->renderResponse('SitePortailBundle:NewsLetters:gestion_newsletters.html.twig');

}
/********************************************************/
public function AjoutAction()
    {
		        
$message='';
$nl= new Newsletters();
$form = $this->container->get('form.factory')->create(new NewslettersForm(),$nl);
$request = $this->container->get('request');
 $session=$this->getRequest()->getSession();
     if($request->getMethod()=='POST')
	 {
	
	$form->bindRequest($request);

    if ($form->isValid()) 
    {
       $nl->setId_admin($session->get('id'));
		 if(!$nl->save())
		$message="Erreur";
		else
		{
		$message='NewsLetters bien enregistree';
		$this->get('session')->setFlash('enregister_nl',$message);
			  return $this->container->get('templating')->renderResponse('SitePortailBundle:NewsLetters:AjoutNewsLetters.html.twig',array('form' => $form->createView()));

       }
       
 
      }}
	  return $this->container->get('templating')->renderResponse('SitePortailBundle:NewsLetters:AjoutNewsLetters.html.twig',array('form' => $form->createView()));
	}
/***************************************************************/	
public function ListAction()
{
 $nl=new Newsletters();
         $message='';
		$liste=$nl->affichAll();
       
		$message='la liste de NewsLetters';
		return $this->container->get('templating')->renderResponse('SitePortailBundle:AbonneNewsLetters:ListNewletters.html.twig',array('liste'=>$liste,'message'=>$message)); 
       
}	
/**********************************************************************/
public function DeleteAction($email)
    {
	     $nl=new ListeNewsletters();
         $message='';
        if(!$nl->delete($email))
		throw new NotFoundHttpException("Erreur");
		else
		{
	
		return $this->redirect($this->generateUrl('SitePortailBundle_gestion_NewsLetters_liste'));
        }
	}
/*************************************************************/	 
}  
	  