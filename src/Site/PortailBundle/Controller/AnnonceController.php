<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Site\PortailBundle\Form\AnnonceEmploiForm;
use Site\PortailBundle\Form\AnnonceAutoForm;
use Site\PortailBundle\Form\AnnonceImmoblForm;
use Site\PortailBundle\Form\AnnonceBnCoinForm;
use Site\PortailBundle\Entity\AnnonceEmploi;
use Site\PortailBundle\Entity\AnnonceAuto;
use Site\PortailBundle\Entity\AnnonceImbl;
use Site\PortailBundle\Entity\AnnonceBnCoin;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\OptionableView;

class AnnonceController extends Controller
{
public function AjoutAction($categorie=null)
    {
	        $session=$this->getRequest()->getSession();
			if($session->get('type')=="membre")
{
$m='';
$request = $this->container->get('request');
	 
  if($categorie=='anc_emploi'||$request->get('categorie')=='anc_emploi')
    { $annonce = new AnnonceEmploi();
	 $form = $this->container->get('form.factory')->create(new AnnonceEmploiForm(),$annonce);
	if($request->getMethod()=='POST')
	 {
	
	$form->bindRequest($request);

    if ($form->isValid()) 
    {
	  
	  $annonce->setidMbr($session->get('id'));
     $annonce->setemail($session->get('email'));
    if(!$annonce->save())
		throw new NotFoundHttpException("Erreur");
		else
		{
		$m='votre Annonce envoye';
		}
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:Ajoutannonce_emploi.html.twig',array('confirmeAnnonce'=>$m,'form' => $form->createView())); 
	  }}
	 // $form->get('email')->setData($session->get('email'));
	  return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:Ajoutannonce_emploi.html.twig',array('confirmeAnnonce'=>$m,'form' => $form->createView())); 
	  }
      else if($categorie=='anc_auto'||$request->get('categorie')=='anc_auto')
    {
	$annonce = new AnnonceAuto();
	 $form = $this->container->get('form.factory')->create(new AnnonceAutoForm(),$annonce);
	
	
	if($request->getMethod()=='POST')
	 {
	
	$form->bindRequest($request);

    if ($form->isValid()) 
    {
	  
	  $annonce->setidMbr($session->get('id'));
    
    if(!$annonce->save())
		$m="erreur votre ne peut pas etre enregistrer";
		else
		{
		$m='votre message envoyer';
		
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:Ajoutannonce_auto.html.twig',array('confirmeAnnonce'=>$m,'form' => $form->createView())); 
	  }
	}}
	$form->get('email')->setData($session->get('email'));
       return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:Ajoutannonce_auto.html.twig',array('confirmeAnnonce'=>$m,'form' => $form->createView()));  
	 }
 else if($categorie=='anc_immobl'||$request->get('categorie')=='anc_immobl')
    {
	$annonce = new AnnonceImbl();
	 $form = $this->container->get('form.factory')->create(new AnnonceImmoblForm(),$annonce);
	if($request->getMethod()=='POST')
	 {
	
	$form->bindRequest($request);

    if ($form->isValid()) 
    {

	  $annonce->setidMbr($session->get('id'));
     
	
    if(!$annonce->save())
		$m="Erreur";
		else
		
		$m='votre message envoyer';
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:Ajoutannonce_immobil.html.twig',array('confirmeAnnonce'=>$m,'form' => $form->createView())); 
	  
       }
	 }
	 $form->get('email')->setData($session->get('email'));
    return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:Ajoutannonce_immobil.html.twig',array('confirmeAnnonce'=>$m,'form' => $form->createView()));  
      }
	  else if($categorie=='anc_bncoin'||$request->get('categorie')=='anc_bncoin')
    {
	$annonce = new AnnonceBnCoin();
	 $form = $this->container->get('form.factory')->create(new AnnonceBnCoinForm(),$annonce);
	if($request->getMethod()=='POST')
	 {
	
	$form->bindRequest($request);

    if ($form->isValid()) 
    {

	  $annonce->setidMbr($session->get('id'));
     
	
    if(!$annonce->save())
		$m="Erreur";
		else
		
		$m='votre Annonce Enregistrer';
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:AjoutAnnonce_BnCoin.html.twig',array('confirmeAnnonce'=>$m,'form' => $form->createView())); 
	  
       }
	 }
	 $form->get('email')->setData($session->get('email'));
    return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:AjoutAnnonce_BnCoin.html.twig',array('confirmeAnnonce'=>$m,'form' => $form->createView()));  
      }
	  }
	  return $this->container->get('templating')->renderResponse('SitePortailBundle:Portail:Inscrire_connect.html.twig');  
     
}
/*****************************************************************/
public function ListeAction($categorie=null)
    {
	$request = $this->container->get('request');
  
	if($categorie!=null)
	 {
	 if($categorie=='auto')
	 {
	 $annonce = new AnnonceAuto();
	 $annonces=$annonce->liste();
	  $adapter =new ArrayAdapter( $annonces);
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
 
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:AnnonceAutoAll.html.twig',array('pagerfanta' => $pagerfanta));
	 }
	  if($categorie=='emploi')
	 {
	 $annonce = new AnnonceEmploi();
	 $annonces=$annonce->liste();
	 $adapter =new ArrayAdapter( $annonces);
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
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:AnnonceEmploiAll.html.twig',array('pagerfanta' => $pagerfanta));
	 }
	  if($categorie=='imobl')
	 {
	 $annonce = new AnnonceImbl();
	 $annonces=$annonce->liste();
	 $adapter =new ArrayAdapter( $annonces);
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
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:AnnonceImoblAll.html.twig',array('pagerfanta' => $pagerfanta));
	 }
	 
	 if($categorie=='anc_bncoin')
	 {
	 $annonce = new AnnonceBnCoin();
	 $annonces=$annonce->liste();
	 $adapter =new ArrayAdapter( $annonces);
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
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:AnnonceBnCoinAll.html.twig',array('pagerfanta' => $pagerfanta));
	 }}
	 
	return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:gestionAnnonce.html.twig');
	   }
/**********************************************************/
public function AfficheAction($id,$categorie)
    {
  if($categorie=='auto')
	 {
	 $annonce = new AnnonceAuto();
	 $annonces=$annonce->find($id);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:afficheAnnonceAuto.html.twig',array('anc'=>$annonces));
	 }
	  if($categorie=='emploi')
	 {
	 $annonce = new AnnonceEmploi();
	 $annonces=$annonce->find($id);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:afficheAnnonceEmploi.html.twig',array('anc'=>$annonces));
	 }
	  if($categorie=='imobl')
	 {
	 $annonce = new AnnonceImbl();
	 $annonces=$annonce->find($id);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:afficheAnnonceImobl.html.twig',array('anc'=>$annonces));
	 
	 }
    if($categorie=='anc_bncoin')
	 {
	 $annonce = new AnnonceBnCoin();
	 $annonces=$annonce->find($id);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:afficheAnnonceBnCoin.html.twig',array('anc'=>$annonces));
	 
	 }
    }
	/*********************************************************/
	public function DeleteAction($id,$categorie)
    {
  if($categorie=='auto')
	 {
	 $annonce = new AnnonceAuto();
	 $annonces=$annonce->delete($id);
	 
	 }
	  if($categorie=='emploi')
	 {
	 $annonce = new AnnonceEmploi();
	 $annonces=$annonce->delete($id);
	 
	 }
	  if($categorie=='imobl')
	 {
	 $annonce = new AnnonceImbl();
	 $annonces=$annonce->delete($id);
	
	 
	 }
return $this->redirect($this->generateUrl('SitePortailBundle_liste_annonce',array('categorie'=>$categorie))); 
    }
	/******************************************************************************************/
	/*********************************************************/
	public function ValideAction($id,$categorie)
    {
  if($categorie=='auto')
	 {
	 $annonce = new AnnonceAuto();
	 $annonces=$annonce->valide($id);
	 
	 }
	  if($categorie=='emploi')
	 {
	 $annonce = new AnnonceEmploi();
	 $annonces=$annonce->valide($id);
	 
	 }
	  if($categorie=='imobl')
	 {
	 $annonce = new AnnonceImbl();
	 $annonces=$annonce->valide($id);
	
	 
	 }
return $this->redirect($this->generateUrl('SitePortailBundle_liste_annonce',array('categorie'=>$categorie))); 
    }
	/******************************************************************************************/
       public function ListeSiteAction ($type,$categorie)
	   {
	   
	   
	 if($categorie=='anc_auto')
	 {
	 $annonce = new AnnonceAuto();
	 $annonces=$annonce->listeSite2($type);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:ListeAutoSite.html.twig',array('type'=>$type,'annonces'=>$annonces));
	 }
	  if($categorie=='anc_emploi')
	 {
	 $annonce = new AnnonceEmploi();
	 $annonces=$annonce->listeSite2($type);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:ListeEmploiSite.html.twig',array('type'=>$type,'annonces'=>$annonces));
	 }
	  if($categorie=='anc_immobl')
	 {
	 $annonce = new AnnonceImbl();
	 $annonces=$annonce->listeSite2($type);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:ListeImbilSite.html.twig',array('type'=>$type,'annonces'=>$annonces));
	 }
	 
	 if($categorie=='anc_bncoin')
	 {
	 $annonce = new AnnonceBnCoin();
	 $annonces=$annonce->listeSite2($type);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:ListeBnCoinSite.html.twig',array('type'=>$type,'annonces'=>$annonces));
	 }
	 return $this->redirect($this->generateUrl('SitePortailBundle_homepage'));
	
	   }
/***************************************************************************/
          public function LireSiteAction($id,$categorie)
	{
	if($categorie=='anc_auto')
	 {
	 $annonce = new AnnonceAuto();
	 $annonce=$annonce->find($id);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:LireAutoSite.html.twig',array('anc'=>$annonce));
	 }
	  if($categorie=='anc_emploi')
	 {
	 $annonce = new AnnonceEmploi();
	 $annonce=$annonce->find($id);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:LireEmploiSite.html.twig',array('anc'=>$annonce));
	 }
	  if($categorie=='anc_immobl')
	 {
	 $annonce = new AnnonceImbl();
	 $annonce=$annonce->find($id);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:LireImbilSite.html.twig',array('anc'=>$annonce));
	 
	 }
    if($categorie=='anc_bncoin')
	 {
	 $annonce = new AnnonceBnCoin();
	 $annonce=$annonce->find($id);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Annonce:LireBnCoinSite.html.twig',array('anc'=>$annonce));
	 
	 }
return $this->redirect($this->generateUrl('SitePortailBundle_homepage'));
	 }

}