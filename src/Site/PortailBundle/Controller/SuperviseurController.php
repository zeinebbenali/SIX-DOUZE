<?php

namespace Site\PortailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class SuperviseurController extends Controller
{
public function indexAction()
{

	
	        return $this->container->get('templating')->renderResponse('SitePortailBundle:Superadmin:super_gestion.html.twig');
        
}
/*************************************************************/
public function AdminAction()
{
return $this->container->get('templating')->renderResponse('SitePortailBundle:Admin:gerer_admin.html.twig'); 


}

}
