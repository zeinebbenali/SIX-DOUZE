<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AjoutAdminForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder
->add('nom','text',array('label' => 'Nom'))
->add('login','text',array('label' => 'Login'))
->add('motpasse','password',array('label' => 'Mot de passe'))
->add('confirme_motpasse','password',array('label' => 'confirmation de mot passe'));

    }

   public function  getName()
   {
   return'Admin';
   }
}