<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AnnonceImmoblForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder
->add('type','choice',array('label' => 'type','choices'=> array(
'Offre' => 'Offre', 
'Demande' => 'Demande')))
->add('nature','choice',array('label' => 'Nature','choices'=> array(
'Vente' => 'Vente', 
'Location' => 'Location',
'Location vacances'=>'Location vacances',
'Vente'=>'Vente',
'Terrain'=>'Terrain',
'Bureaux & Commerces'=>'Bureaux & Commerces',
'Partage'=>'Partage')))
->add('prix','number',array('label' => 'Prix'))
->add('surface','number',array('label' => 'Surface'))
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