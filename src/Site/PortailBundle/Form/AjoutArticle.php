<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AjoutArticle extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder

->add('titre','text',array('label' => 'Titre'))
->add('categorie','choice',array('label' => 'Type  article ','choices'=> array(
'news national'=>'news national',
'news international'=>'news international',
'sport national'=>'sport national',
'sport international'=>'sport international',
'film'=>'film',
'documentaire'=>'documentaire',
'divers'=>'divers',
'motors'=>'motors',
'hi-tech'=>'hi-tech',
'islamiyat'=>'islamiyat',
'accessoires femmes'=>'accessoires femmes',
'Trucs &amp; Astuces femmes'=>'Trucs et Astuces femmes',
'Cuisine'=>'Cuisine',
'top_oriental'=>'top Oriental',
'top_occidental'=>'top Occidental',
'Accessoires hommes'=>'Accessoires hommes',
'Beaute du corps hommes'=>'Beaute du corps hommes',
'Divers pour hommes'=>'Divers pour hommes'
)))
->add('contenu','textarea',array('label' => "Corps de l'article "))
->add('lien','text',array('label' => 'lien','required'  => false))
->add('media', 'file',array('label' => 'Image','required'  => false))
;
    }

   public function  getName()
   {
   return'Article';
   }
}