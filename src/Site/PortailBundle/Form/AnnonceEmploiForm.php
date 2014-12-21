<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AnnonceEmploiForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder
->add('type','choice',array('label' => 'type','choices'=> array(
'Offre' => 'Offre', 
'Demande' => 'Demande')))
->add('nature','choice',array('label' => 'Nature','choices'=> array(
'Emploi' => 'emploi', 
'Stage' => 'stage', 
'Formation' => 'formation')))
->add('letter','textarea',array('label' => 'Letter de Motivation'))
->add('cv', 'file',array('label' => 'CV','required' => false))
->add('secteur','choice',array('label' => 'Secteur','choices'=> array(
'Comptabilit&eacute'=>'Comptabilite',
'Marketing'=>'Marketing',
'Architecture'=>'Architecture',
'Arts & Design'=>'Arts & Design',
'Finance'=>'Finance',
'juridique'=>'juridique',
'Service a la clientele'=>'Service &agrave; la clientele',
'Sante'=>'Sante',
'Ressources humaines'=>'Ressources humaines',
'Informatique'=>'Informatique',
'Services'=>'Services',
'Gestion'=>'Gestion',
'Fabrication'=>'Fabrication',
'Media'=>'Media',
'Secteur Public'=>'Secteur Public',
'Ventes'=>'Ventes',
'Textile'=>'Textile',
'Telecommunications'=>'Telecommunications',
'Tourisme'=>'Tourisme',
'Ingenierie'=>'Ingenierie',
'Centres appels'=>'Centres appels',
'Mode & Design'=>'Mode & Design',
'Administration'=>'Administration')));
    }

   public function  getName()
   {
   return'AnnonceEmploi';
   }
}