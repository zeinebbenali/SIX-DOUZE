<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Site\PortailBundle\Entity\Sondage;
use Site\PortailBundle\Entity\ReponseSondage;


class SondageController extends Controller
{

public function indexAction()
    {
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Sondage:GestionSondage.html.twig',array('enregister_sondage'=>''));
	}
/*************************************************************************/
public function AjoutAction()
    {
	
$m='';

$request = $this->container->get('request');
  if($request->get('etap')==1)
  {$sondage=new Sondage();
     if($request->getMethod()=='POST')
	 {
	 
	$sondage->setquestion($request->get('question'));
    
       $sondage->setnbr($request->get('nbr'));
	   $session=$this->getRequest()->getSession();
       $sondage->setIdAdmin($session->get('id'));
    if(!$sondage->save())
		$m="Erreur";
		else
		{
		$m="inserer les reponse";
		$this->get('session')->setFlash('enregister_sondage',$m);
	 return $this->container->get('templating')->renderResponse('SitePortailBundle:Sondage:AjouteSondage.html.twig',array('m'=>$m,'question'=>$sondage->getquestion(),'nbr'=>$sondage->getnbr())); 
	  }
       }
	 }
	 if($request->get('etap')==2)
  { 
  $sondage=new ReponseSondage();
   $nbr=$request->get('nbr');
  $sondage->delete();
  for($i=1;$i<=$nbr;$i++)
  {
  $sondage->setreponse($request->get((String)$i));
       
	   if(!$sondage->save())
	   {
	   $m="erreur d'enregistrement de sondage";
	   return $this->container->get('templating')->renderResponse('SitePortailBundle:Sondage:GestionSondage.html.twig',array('enregister_sondage'=>$m));
	   }
	   else
	   $m="votre sondage est enregistree";
  
 }
	
  return $this->container->get('templating')->renderResponse('SitePortailBundle:Sondage:GestionSondage.html.twig',array('enregister_sondage'=>$m)); 
  }
  
return $this->container->get('templating')->renderResponse('SitePortailBundle:Sondage:AjouteSondage.html.twig',array('m'=>$m));
 
      }	
	  /**********************************************/
	  public function ConsultatAction()
	  {
	  $sondage=new Sondage();
	  $sondage=$sondage->Liste();
	   $reponse=new ReponseSondage();
	  $liste_reponse=$reponse->ListeReponse();
	  return $this->container->get('templating')->renderResponse('SitePortailBundle:Sondage:ResultatSondage.html.twig',array('sondage'=>$sondage,'reponse'=>$liste_reponse));
	  }
	 /************************************************/
	  public function RepondreAction()
	  {
	  $ReponseSondage=new ReponseSondage();
	  $request = $this->container->get('request');
   if($request->getMethod()=='POST')
	 {
	$ReponseSondage->setreponse($request->get('reponse'));
	
	  if(!$ReponseSondage->Repondre())
	 {$m='vous avez deja voter ';}
	  else $m='votre participation aux sondage est enregistre';
	  
	  $this->get('session')->setFlash('enregister_reponse',$m);
	  return $this->redirect($this->generateUrl('SitePortailBundle_homepage'));
	  }
	  	return $this->redirect($this->generateUrl('SitePortailBundle_homepage'));
	  }
	 
}	