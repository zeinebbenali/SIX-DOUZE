<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Site\PortailBundle\Form\ProposeArticleForm;
use Site\PortailBundle\Form\CommentaireForm;
use Site\PortailBundle\Form\AjoutArticle;
use Site\PortailBundle\Entity\Article;
use Site\PortailBundle\Entity\CommantArticle;



class CommentaireController extends Controller
{
public function AjoutAction()
    {
	$session=$this->getRequest()->getSession();
			if($session->get('type')=="membre")
{        
	$m='';
$request = $this->container->get('request');
$session=$this->getRequest()->getSession();
 
 $commentaire= new CommantArticle();
	 $form = $this->container->get('form.factory')->create(new CommentaireForm(),$commentaire);
	if($request->getMethod()=='POST')
	 {
	
	$form->bindRequest($request);

    if ($form->isValid()) 
    {
	   $commentaire->setid_article($request->get('id_article'));
	  $commentaire->setid_mbr($session->get('id'));
     
   $commentaire->save();
		
		
		
	
	return $this->redirect($this->generateUrl('SitePortailBundle_lire_article',array('id'=>$commentaire->getid_article()))); 
	}
	 
	
	}}
	return $this->container->get('templating')->renderResponse('SitePortailBundle:Portail:Inscrire_connect.html.twig'); 
	
	
	}}