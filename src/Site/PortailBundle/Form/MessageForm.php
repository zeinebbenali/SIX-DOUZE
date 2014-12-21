<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MessageForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder
->add('nom','text',array('label' => 'Nom'))
->add('prenom','text',array('label' => 'Prenom'))
->add('email','email',array('label' => 'Email'))
->add('tel','number',array('label' => 'Telephone'))
->add('message','textarea',array('label' => 'Message'))
;
    }

   public function  getName()
   {
   return'membre';
   }
}