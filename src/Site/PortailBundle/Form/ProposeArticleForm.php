<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProposeArticleForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder
->add('nom','text',array('label' => 'Nom et Prenom'))
->add('email','email',array('label' =>'E-mail'))
->add('titre','text',array('label' => 'Titre'))
->add('categorie','choice',array('label' => 'Type  article ','choices'=> array(
'news national'=>'news national',
'news international'=>'news international',
'sport national'=>'sport national',
'sport international'=>'sport international',
'film'=>'film',
'divers'=>'divers',
'motors'=>'motors',
'hi-tech'=>'hi-tech',
'accessoires femmes'=>'accessoires femmes',
'Trucs &amp; Astuces femmes'=>'Trucs et Astuces femmes',
'Cuisine'=>'Cuisine',
'Accessoires hommes'=>'Accessoires hommes',
'Beaute du corps hommes'=>'Beaute du corps hommes',
'Divers pour hommes'=>'Divers pour hommes'
)))
->add('contenu','textarea',array('label' => "Corps de l'article "))
->add('media', 'file',array('label' => 'Image'))
;
    }

   public function  getName()
   {
   return'Article';
   }
}