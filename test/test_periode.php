<?php

set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/Period.class.php';

/*
echo '<h2>Création</h2>';
$Period = new Period(0, 1, 'periode2', 1796440219, 1996440219);
echo $Period->getState();
*/

echo '<h2>Accès</h2>';
$Period = new Period(2);
echo $Period->getState();
echo $Period->getIdFundation();
echo $Period->getName();
echo $Period->getDateStart();
echo $Period->getDateEnd();

?>