<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
class ContactForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder
->add('nom')
->add('prenom')
->add('email','email')
->add('objet')
->add('message','textarea')
;
    }

   public function  getName()
   {
   return'contact';
   }
}