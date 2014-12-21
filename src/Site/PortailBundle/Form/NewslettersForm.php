<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class NewslettersForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder

->add('titre','text',array('label' => 'titre'))
->add('newsletters','file',array('label' => 'NewsLetters'));
    }

   public function  getName()
   {
   return'NewsLetters';
   }
}