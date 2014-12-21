<?php

namespace Site\PortailBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AnnonceAutoForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
  $builder
->add('nature','choice',array('label' => 'Nature','choices'=> array(
'Vente' => 'Vente', 
'Location' => 'Location')))
->add('type','choice',array('label' => 'type','choices'=> array(
'Offre' => 'Offre', 
'Demande' => 'Demande')))
->add('marque','choice',array('label' => 'Marque','choices'=> array
(
'Volkswagen'=>'Volkswagen',
'Renault'=>'Renault',
'Peugeot'=>'Peugeo',
'Fiat'=>'Fiat',
'Mercedes'=>'Mercedes',
'Citroen'=>'Citroen',
'Bmw'=>'Bmw',
'Opel'=>'Opel',
'Ford'=>'Ford',
'Audi'=>'Audi',
'Mitsubishi'=>'Mitsubishi',
'Toyota'=>'Toyota',
'Nissan'=>'Nissan',
'Isuzu'=>'Isuzu',
'Kia'=>'Kia',
'Iveco'=>'Iveco',
'Jeep'=>'Jeep',
'Chevrolet'=>'Chevrolet',
'Alfaromeo'=>'Alfaromeo',
'Mazda'=>'Mazda',
'Hyundai'=>'Hyundai',
'Suzuki'=>'Suzuki',
'Land-Rover'=>'Land-Rover',
'Porsche'=>'Porsche',
'Daewoo'=>'Daewoo',
'Seat'=>'Seat',
'Rover'=>'Rover',
'Volvo'=>'Volvo',
'Chrysler'=>'Chrysler',
'Honda'=>'Honda',
'Hummer'=>'Hummer',
'RenaultTrucks'=>'RenaultTrucks',
'Dodge'=>'Dodge',
'Jaguar'=>'Jaguar',
'Daihatsu'=>'Daihatsu',
'Cadillac'=>'Cadillac',
'Alpine-Renault'=>'Alpine-Renault',
'Peugeot'=>'Peugeot',
'autre'=>'Autre'),'required'  => false))
->add('modele','text',array('label' => 'Modele'))
->add('annee','choice',array('label' => 'Annees','choices'=> array(
'2012'=>'2012',
'2011'=>'2011',
'2010'=>'2010',
'2009'=>'2009',
'2008'=>'2008',
'2007'=>'2007',
'2006'=>'2006',
'2005'=>'2005',
'2004'=>'2004',
'2003'=>'2003',
'2002'=>'2002',
'2001'=>'2001',
'2000'=>'2000',
'1999'=>'1999',
'1998'=>'1998',
'1997'=>'1997',
'1996'=>'1996',
'1995'=>'1995',
'1994'=>'1994',
'1993'=>'1993',
'1992'=>'1992',
'1991'=>'1991',
'1990'=>'1990',
'1989'=>'1989',
'1988'=>'1988',
'1987'=>'1987',
'1986'=>'1986',
'1985'=>'1985',
'1984'=>'1984',
'1983'=>'1983',
'1982'=>'1982',
'1981'=>'1981',
'1980'=>'1980',
'1979'=>'1979',
'1978'=>'1978',
'1977'=>'1977',
'1976'=>'1976',
'1975'=>'1975',
'1974'=>'1974',
'1973'=>'1973',
'1972'=>'1972',
'1971'=>'1971',
'1970'=>'1970',
'1969'=>'1969',
'1968'=>'1968',
'1967'=>'1967',
'1966'=>'1966',
'1965'=>'1965',
'1964'=>'1964',
'1963'=>'1963',
'1962'=>'1962',
'1961'=>'1961',
'1960'=>'1960',
'1959'=>'1959',
'1958'=>'1958',
'1957'=>'1957',
'1956'=>'1956',
'1955'=>'1955',
'1954'=>'1954',
'1953'=>'1953',
'1952'=>'1952',
'1951'=>'1951',
'1950'=>'1950')))
->add('energie','choice',array('label' => 'Energie','choices'=> array(
'Diesel'=>'Diesel',
'Essence'=>'Essence',
'GPL'=>'GPL',
'Bioethanol'=>'Bioethanol',
'Electrique'=>'Electrique',
'Hybride'=>'Hybride')))

->add('kilometrage','number',array('label' => 'Kilometrage'))
->add('prix','number',array('label' => 'Prix'))
->add('tel','number',array('label' => 'Telephone'))
->add('email','email',array('label' => 'E-mail'))
->add('photo', 'file',array('label' => 'photo','required' => false))

->add('description','textarea',array('label' => 'Description'));
    }

   public function  getName()
   {
   return'AnnonceAuto';
   }
}