<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentaireForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder
->add('nom','text',array('label' => 'Nom'))
->add('email','email',array('label' => 'Email'))

->add('commentaire','textarea',array('label' => 'Commentaire'))
;
    }

   public function  getName()
   {
   return'membre';
   }
}