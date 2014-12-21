<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AbonneNewsLetters extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder

->add('email','email')

    }

   public function  getName()
   {
   return'AbonneNewsLetters';
   }
}