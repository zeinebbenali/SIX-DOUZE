<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Site\PortailBundle\Entity\Message;
use Site\PortailBundle\Form\MessageForm;


class MessageController extends Controller
{

public function indexAction()
    {
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Message:gestion_message.html.twig');
	}
/************************************************************************/	
public function AjoutAction()
    {
	        
$m='';
$message = new Message();


  $form = $this->container->get('form.factory')->create(new MessageForm(),$message);
$request = $this->container->get('request');

  
     if($request->getMethod()=='POST')
	 {
	 $form->bindRequest($request);

    if ($form->isValid()) 
    
	 {
   
	
    if(!$message->save())
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Message:message.html.twig',array('m'=>'Erreur')); 
		else
		{
		$m='votre message envoyer';
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Message:message.html.twig',array('m'=>$message,'form' => $form->createView())); 
	  }
       }
	 }
return $this->container->get('templating')->renderResponse('SitePortailBundle:Message:message.html.twig',array('m'=>$message,'form' => $form->createView()));
 
      
	  }
	  /********************************************************* *****************/
	  public function AffichAllAction()
    {
	        $message=new Message();
         $m='';
		$messages=$message->ListAll();
       
		$m='la liste de touts les messages';
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Message:messageAll.html.twig',array('list'=>$messages,'m'=>$m)); 
        
        
	}	
/***********************************************************************************************/
public function NewsAction()
    {
	     
	        $message=new Message();
         $m='';
		$messages=$message->ListNew();
       
		$m='la liste de touts les messages';
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Message:messageAll.html.twig',array('list'=>$messages,'m'=>$m)); 
        
        
	}	
/*******************************************************************************************/	
	public function DeleteAction($id)
    {
	     $message=new Message();
         $m='';
		if(!$message->delete($id))
		throw new NotFoundHttpException("Erreur");
		else
		{
		$messages=$message->ListAll();
		$m='le message est supprimer';
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Message:messageAll.html.twig',array('list'=>$messages,'m'=>$m)); 
        
        }
	}
/***************************************************************************************************/
	public function AffichAction($id)
    {
	    $message=new Message();
         $m='';
		$res=$message->find($id);
        if(!$res)
		throw new NotFoundHttpException("Erreur");
		else
		
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Contact:afficheContact.html.twig',array('message'=>$res)); 
        
        
	}
	/**************************************************************/
public function ValideAction($id)
{
$message=new Message();
$res=$message->valider($id);
if(!$res)
		return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:erreur.html.twig',array('m'=>"Erreur de validation de message "));
		else
return $this->redirect($this->generateUrl('SitePortailBundle_gerer_message_list')); 
 
}
/**********************************************************************/
public function MessageValideAction()
{
$message=new Message();
$res=$message->ListeValide();
return messages;
}
 }	
