<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AnnonceBnCoinForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder
->add('type','choice',array('label' => 'type','choices'=> array(
'Offre' => 'Offre', 
'Demande' => 'Demande')))
->add('nature','choice',array('label' => 'Nature','choices'=> array(
''=>'Toutes cat�gories',
'--MULTIMEDIA--'=>'MULTIMEDIA',
'Informatique'=>'Informatique',
'Consoles &amp; Jeux vid�o'=>'Consoles &amp; Jeux vid�o',
'Image &amp; Son'=>'Image &amp; Son',
'T�l�phonie'=>'T�l�phonie',
'-- MAISON --'=>'-- MAISON --',
'Ameublement'=>'Ameublement',
'Electrom�nager'=>'Electrom�nager',
'Arts de la table'=>'Arts de la table',
'D�coration'=>'D�coration',
'Linge de maison'=>'Linge de maison',
'Bricolage / Jardinage'=>'Bricolage / Jardinage',
'V�tements'=>'V�tements',
'Accessoires &amp; Bagagerie'=>'Accessoires &amp; Bagagerie',
'Montres &amp; Bijoux'=>'Montres &amp; Bijoux',
'Equipement b�b�'=>'Equipement b�b�',
'--LOISIRS --'=>'--LOISIRS --',
'DVD / Films'=>'DVD / Films',
 'CD / Musique'=>'CD / Musique',
 'Livres'=>'Livres',
 'Animaux'=>'Animaux',
'Sports &amp; Hobbies'=>'Sports &amp; Hobbies',
'Instruments de musique'=>'Instruments de musique',
'Collection'=>'Collection',
'Jeux &amp; Jouets'=>'Jeux &amp; Jouets',
'Autres'=>'Autres')))
->add('titre','text',array('label' => "Titre de l'annonce"))
->add('prix','number',array('label' => 'Prix'))

->add('tel','number',array('label' => 'Telephone'))
->add('email','email',array('label' => 'E-mail'))
->add('govern','choice',array('label' => 'Gouvernorat','choices'=> array
(
'Ariana'=>'Ariana',
'Beja'=>'Beja',
'Ben Arous'=>'Ben Arous',
'Bizerte'=>'Bizerte',
'Gabes'=>'Gabes',
'Gafsa'=>'Gafsa',
'Jendouba'=>'Jendouba',
'Kairouan'>'Kairouan',
'Kasserine'=>'Kasserine',
'Kebili'=>'Kebili',
'Manouba'=>'Manouba',
'Le Kef'=>'Le Kef',
'Mahdia'=>'Mahdia',
'Medenine'=>'Medenine',
'Monastir'=>'Monastir',
'Nabeul'=>'Nabeul',
'Sfax'=>'Sfax',
'Sidi Bouzid'=>'Sidi Bouzid',
'Siliana'=>'Siliana',
'Sousse'=>'Sousse',
'Tataouine'=>'Tataouine',
'Tozeur'=>'Tozeur',
'Tunis'=>'Tunis',
'Zaghouan'=>'Zaghouan')))
->add('deleg','choice',array('label' => 'Delegation','choices'=> array
(
'Ariana Ville'=>'Ariana Ville',
'Ettadhamen'=>'Ettadhamen',
'Kalaat El Andalous'=>'Kalaat El Andalous',
'La Soukra'=>'La Soukra',
'Mnihla'=>'Mnihla',
'Raoued">Raoued',
'Sidi Thabet'=>'Sidi Thabet'
)))

->add('photo', 'file',array('label' => 'photo','required' => false))

->add('descri','textarea',array('label' => 'Description'));
    }

   public function  getName()
   {
   return'AnnonceImbl';
   }
}