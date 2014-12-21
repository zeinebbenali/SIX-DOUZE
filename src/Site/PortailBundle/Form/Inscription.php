<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Inscription extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder
->add('nom','text',array('label' => 'Nom'))
->add('prenom','text',array('label' => 'Prenom'))
->add('email','email',array('label' => 'Email'))
->add('tel','number',array('label' => 'Telephone'))
->add('type','choice',array('label' => 'Type','choices'=> array('Societe' => 'Societe', 'personne' => 'Personne')))
->add('societe','text',array('label' => 'Nom de Societe','required'=> false))
->add('photo', 'file',array('label' => 'Photo de profil','required' => false))
->add('motpasse','password',array('label' => 'Mot de passe'))
->add('confirme_motpasse','password',array('label' => 'confirmation de mot passe'))
->add('accepte','checkbox',array('label'=> 'J accepte et je certifie que j ai lu et accepte les termes des documents'));
    }

   public function  getName()
   {
   return'membre';
   }
}