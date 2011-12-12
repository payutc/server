<?php

set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/Object.class.php';
/*
echo '<h2>objet sans requete</h2>';
$Object = new Object(1, 'frites', 'product', 0, 1, 0, 0, 1);
echo $Object->getId();
echo $Object->getName();
echo $Object->getType();
echo $Object->getStock();
echo $Object->getSingle();
echo $Object->getImgId();
echo $Object->getFunId();
echo $Object->getState();
*/


$Object = new Object(2);
echo $Object->setStock(-1);


/*
echo '<h2>Création objet</h2>';
$Object = new Object(0, 'frites', 'product', 500, 1);
echo $Object->getId();
echo $Object->getName();
echo $Object->getType();
echo $Object->getStock();
echo $Object->getSingle();
echo $Object->getImgId();
echo $Object->getFunId();
echo $Object->getState();
*/

/*
ATTENTION : ça pose pas de pb ça
echo '<h2>Objet sans type</h2>';
$Object = new Object(0, 'frites', 'productfzefze', 500, 1);
*/

//echo '<h2>Lecture et modifs</h2>';

//$Object4 = new Object(4);
//echo $Object4->setName('fanta');
//echo $Object4->setType('product');
//$Object4->clearParent();
/*
echo '<pre>';
print_r($Object4->getParent());
echo '</pre>';
echo '<pre>';
print_r($Object4->getChild());
echo '</pre>';
*/
//$Object = new Object(2);
//echo $Object->setName('canettes');
//echo $Object->setType('promotion');
//echo $Object->setStock(-100);
//echo $Object->addChild($Object4->getId());

//$Object->clearChild();
/*
echo '<pre>';
print_r($Object->getParent());
echo '</pre>';
echo '<pre>';
print_r($Object->getChild());
echo '</pre>';
*/
//$Object3 = new Object(3);
//echo $Object3->setName('coca');
//echo $Object3->addParent($Object->getId());
//echo $Object3->addPromoChild($Object4->getId(), 1);
//echo $Object3->addPromoChild($Object->getId(), 2);

//$Object3->removeParent($Object->getId());
//$Object3->removeChild(4);


/*
echo '<pre>';
print_r($Object3->getParent());
echo '</pre>';
echo '<pre>';
print_r($Object3->getChild());
echo '</pre>';
*/

/*
echo '<pre>';
print_r($Object->getDetailsLight());
echo '</pre>';
echo '<pre>';
print_r($Object->getDetails());
echo '</pre>';
*/
?>