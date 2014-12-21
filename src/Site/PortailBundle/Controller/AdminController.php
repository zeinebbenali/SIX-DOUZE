<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Site\PortailBundle\Entity\Admin;
use Site\PortailBundle\Form\AjoutAdminForm;


class AdminController extends Controller
{
/***********************************************************/
public function indexAction()
    {
	
	
	
	        return $this->render('SitePortailBundle:Admin:admin.html.twig',array('m'=>''));
       
			

    }
	
/*******************************************/
public function ConnexionAction()
{
$message="";
$admin = new Admin();

$request = $this->container->get('request');
  $session=$this->getRequest()->getSession();
     if($request->getMethod() =='POST')
	 {
	 	 

	 
     $admin->setmotpasse($request->get('pwd'));
     $admin->setlogin($request->get('login'));
          $message=$admin->connect();
       if($message=="erreur")
		
     return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:admin.html.twig',array('m'=>$message));
	 else  if($message=="admin")
	 {
	 $session->set('type',"admin");
	 }
	else  if($message=="superviseur")
	 {
	 $session->set('type',"superviseur");
       }
	    $session->set('nom',$admin->getnom());
	    $session->set('id',$admin->getid());
	    $session->set('login',$admin->getlogin());
	   return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:admin_gestion.html.twig'); 
	   }
	
	 

}
/******************************************************************/
public function DeconnexionIndex()
{
$session=$this->get('Session');

if($session->get('type')=="admin"||$session->get('type')=="superviseur")
{

$session->remove('type');
$session->clear();
$session->close();
return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:admin.html.twig'); 
}
}
/********************************************************/
public function AjoutAction()
{
$session=$this->get('Session');
if($session->get('type')=="superviseur")
{
$message='';
$admin = new Admin();
$form = $this->container->get('form.factory')->create(new AjoutAdminForm(),$admin);
$request = $this->container->get('request');

  
     if($request->getMethod()=='POST')
	 {
	 $form->bindRequest($request);

    if ($form->isValid()) 
    
	 {
       if(!$admin->save())
		     throw new NotFoundHttpException('admin ne peut etre enregistrer');
	   else
	   {
               $message='Le nouvel admin est enregistré';
     return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:Valide.html.twig',array('m'=>$message));
        }}
	}	
return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:AjoutAdmin.html.twig',array('m'=>$message,'form'=> $form->createView()));
}
else
throw new NotFoundHttpException("accss interdit pour les admin"); 
}
 

/****************************************************************/
public function ListAction()
{

$admin = new Admin();

$list=$admin->listAll();
return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:list.html.twig',array('list'=>$list,'message'=>"liste des admins"));
}
/*************************************************/
public function SupprimAction($id)
    {
	$session=$this->get('Session');
if($session->get('type')=="superviseur")
{
	$admin= new admin();
	
     if(!$admin->delete($id))
	  {
	   throw new NotFoundHttpException("admin non trouvé");
	  }
	  
	return $this->redirect($this->generateUrl('SitePortailBundle_list_admin'));
	}
	 else
throw new NotFoundHttpException("accss interdit pour les admin"); 
    }
/*******************************************************************/
public function ModifAction($id=null)
    {
	$session=$this->get('Session');
if($session->get('type')=="superviseur")
{
	$admin=new Admin();
	$message='';
	if(isset ($id))
	{
	$admin->find($id);
	}
$request = $this->container->get('request');
$form = $this->container->get('form.factory')->create(new AjoutAdminForm(),$admin);
 if ($request->getMethod() == 'POST') 
    {   $admin->setid($request->get('id'));
	 $form->bindRequest($request);

    if ($form->isValid()) 
    
	 {
	    if($admin->modifier())
		{
	    $message="votre modification est enregistrer";
	    return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:valide.html.twig',array('m'=>$message)); 
	     }
		 
		 else
		 return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:erreur.html.twig',array('m'=>"erreur de modification")); 
	}
	
	
	}
return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:editAdmin.html.twig',array('a'=>$admin,'m'=>$message,'form'=> $form->createView())); 
	
	}
	else
throw new NotFoundHttpException("accss interdit pour les admin"); 
   }
/*************************************************************************/

}