<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Site\PortailBundle\Form\ContactForm;
use Site\PortailBundle\Entity\Contact;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\OptionableView;

class ContactController extends Controller
{

public function indexAction()
    {
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Contact:gestion_contact.html.twig');
	}
/*****************************************************/	
public function AjoutAction()
    {
	        
$message='';
$contact = new Contact();

$form = $this->container->get('form.factory')->create(new ContactForm(),$contact);
	
$request = $this->container->get('request');

  
     if($request->getMethod()=='POST')
	 {
	 $form->bindRequest($request);

    if ($form->isValid()) 
    
	 {
   
    if(!$contact->save())
		throw new NotFoundHttpException("Erreur");
		else
		{
		$message='votre message envoyer';
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Contact:Contact.html.twig',array('message'=>$message)); 
	  }
       }
	 }
return $this->container->get('templating')->renderResponse('SitePortailBundle:Contact:Contact.html.twig',array('message'=>$message,'form' => $form->createView()));
 
      }
	  /********************************************************* *****************/
	  public function AffichAllAction()
    {
	        $contact=new Contact();
         $message='';
		$contacts=$contact->ListAll();
		$adapter =new ArrayAdapter($contacts);
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
 
		$message='la liste de touts les contacts';
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Contact:contactAll.html.twig',array('pagerfanta' => $pagerfanta,'message'=>$message)); 
        
        
	}	
/***********************************************************************************************/
public function NewsAction()
    {
	     
	        $contact=new Contact();
         $message='';
		$contacts=$contact->ListNew();
       $adapter =new ArrayAdapter($contacts);
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
		$message='la liste de touts les contacts';
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Contact:contactAll.html.twig',array('pagerfanta' => $pagerfanta,'message'=>$message)); 
        
        
	}	
/*******************************************************************************************/	
	public function DeleteAction($id)
    {
	     $contact=new Contact();    
         $message='';
        if(!$contact->delete($id))
		throw new NotFoundHttpException("Erreur");
		else
		{
		$contacts=$contact->ListAll();
		$message='le message est supprimer';
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Contact:contactAll.html.twig',array('contacts'=>$contacts,'message'=>$message)); 
        
        }
	}
/***************************************************************************************************/
	public function AffichAction($id)
    {
	    $contact=new Contact();    
        $res=$contact->find($id);
        if(!$res)
		throw new NotFoundHttpException("Erreur");
		else
		
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Contact:afficheContact.html.twig',array('contact'=>$res,'message'=>'Erreur')); 
        
        
	}
 }	
