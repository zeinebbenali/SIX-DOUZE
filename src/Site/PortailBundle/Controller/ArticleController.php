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
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\OptionableView;
class ArticleController extends Controller
{
public function IndexAction()
    {
	return $this->container->get('templating')->renderResponse('SitePortailBundle:Article:GestionArticle.html.twig');
	}
	/***************************************/
	public function tchatAction()
    {
	return $this->container->get('templating')->renderResponse('SitePortailBundle:tchat:tchat.html.twig');
	}
	/*******************************************************/
public function AjoutAction()
    {
	        
$m='';
$request = $this->container->get('request');
$session=$this->getRequest()->getSession();
 $article = new Article();
	 $form = $this->container->get('form.factory')->create(new AjoutArticle(),$article);
	if($request->getMethod()=='POST')
	 {
	
	$form->bindRequest($request);

    if ($form->isValid()) 
    {
	  
	  $article->setid_admin($session->get('id'));
     
    if(!$article->save('admin'))
		throw new NotFoundHttpException("Erreur");
		else
		{
		$m='votre message envoyer';
		}
		$this->get('session')->setFlash('enregister_article',$m);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Article:GestionArticle.html.twig'); 
	  }
	  }
	 
    return $this->container->get('templating')->renderResponse('SitePortailBundle:Article:AjoutArticle.html.twig',array('form' => $form->createView()));  
   
}
/*****************************************************************/

public function ProposeAction()
    {
	 $session=$this->getRequest()->getSession();
			if($session->get('type')=="membre")
{        
$m='';
$request = $this->container->get('request');
$session=$this->getRequest()->getSession();
 $article = new Article();
	 $form = $this->container->get('form.factory')->create(new ProposeArticleForm(),$article);
	if($request->getMethod()=='POST')
	 {
	
	$form->bindRequest($request);

    if ($form->isValid()) 
    {
	  
	  $article->setid_mbr($session->get('id'));
     
    if(!$article->save('membre'))
		throw new NotFoundHttpException("Erreur");
		else
		{
		$m='votre article proposé est enregistre';
		}
		$this->get('session')->setFlash('enregister_article',$m);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Article:ProposeArticle.html.twig',array('form' => $form->createView())); 
	  }
	  }
	 
    return $this->container->get('templating')->renderResponse('SitePortailBundle:Article:ProposeArticle.html.twig',array('form' => $form->createView()));  
}
	return $this->container->get('templating')->renderResponse('SitePortailBundle:Portail:Inscrire_connect.html.twig');  
     
	}
/***********************************************************************/
public function ListeAction($categorie=null)
    {
	
	   $request = $this->container->get('request');
  $article = new Article();
	if($categorie!=null)
	 {
	 $liste=$article->listAll($categorie);
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
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Article:ListeArticle.html.twig',array('pagerfanta' => $pagerfanta,'categorie'=>$categorie));
	 
	 }
	   $adapter =new ArrayAdapter($article->listCategorie());
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
 
     return $this->render('SitePortailBundle:Article:ListeCategorie.html.twig',array('pagerfanta' => $pagerfanta));	
 }
/**********************************************************/
public function AfficheAction($id)
    {
	  
	 $article = new Article();
	 $article=$article->find($id);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Article:AfficheArticle.html.twig',array('article'=>$article));
	 

    }
	/***********************************************************************************/
	public function LireAction($id)
    {
	$article = new Article();
	 $article=$article->find($id);
	$request = $this->container->get('request');
 $commentaire2 = new CommantArticle();
 $commentaire = new CommantArticle();
 $form = $this->container->get('form.factory')->create(new CommentaireForm(),$commentaire); 
	/*if($request->getMethod()=='POST')
	 {
	
	$form->bindRequest($request);

    if ($form->isValid()) 
    {
	  $session=$this->getRequest()->getSession();
			if($session->get('type')=="membre")
{        
	  $commentaire->setid_mbr($session->get('id'));
     
   $commentaire->save();
   }
   else return $this->container->get('templating')->renderResponse('SitePortailBundle:Portail:Inscrire_connect.html.twig'); 
	}
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Article:LireArticle.html.twig',array('commentaire'=>$commentaire->list_commentaire($id),'article'=>$article,'form' => $form->createView()));
	 

    }*/
	return $this->container->get('templating')->renderResponse('SitePortailBundle:Article:LireArticle.html.twig',array('commentaire'=>$commentaire2->list_commentaire($id),'article'=>$article,'form' => $form->createView()));
	}
	/*********************************************************/
	public function DeleteAction($id,$categorie)
    {
  $session=$this->getRequest()->getSession();
	 $article = new Article();
	 if(!$article->delete($id))
	 {$m='Erreur';}
	 else
	 {$m='article sumpprimeé';}
	 $this->get('session')->setFlash('supprime_article',$m);
	 return $this->redirect($this->generateUrl('SitePortailBundle_Liste_article', array('categorie' =>$categorie)));

    }
	/******************************************************************************************/
	
	public function ValideAction($id,$categorie)
    {
	$session=$this->getRequest()->getSession();
 $article = new Article();
	 if(!$article->valider($id))
	 {$m='Erreur';}
	 else
	 {$m='article validé';}
	 $this->get('session')->setFlash('validation_article',$m);
	 return $this->redirect($this->generateUrl('SitePortailBundle_Liste_article', array('categorie' =>$categorie)));

    }
	/******************************************************************************************/
	public function PagerAction($categorie)
    {
	$session=$this->getRequest()->getSession();
	 $article = new Article();
	$liste=$article->ListeSite($categorie);
	if($categorie=='islamiyat')
	{
	return $this->render('SitePortailBundle:Article:Islamiyat.html.twig',array('islamiyat'=>$liste));
	}
	 $session->set('article',$liste);
	 
	 return $this->render('SitePortailBundle:Portail:index.html.twig',array('m'=>''));
	}
}