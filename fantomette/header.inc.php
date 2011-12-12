<?php
//Obligatoire
$niveauSecu = 'log'; //Niveaux de sécurité (voir $session->authPage() )
$idPage = 155; //gestion du fil d'ariane

//$toto_session = 'bernardx';
include ('../include/config.inc');

$page = new Page();
$page->header('Système de paiement', 'buckutt');

// A retirer pour la V8
?>
<link rel="stylesheet" type="text/css" href="<?php echo $config['baseUrl']?>/buckutt/buckutt.style.css" />
<link type="text/css" href="css/flick/jquery-ui-1.8.4.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js">
</script>
<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js">
</script>
<?php 
error_reporting(E_ERROR);

//$url = 'http://buckutt.dyndns.org/server/';
$url = 'http://10.10.10.1:8080/';

// En fonction des pages, on appel ou non les wsdl utiles
$wsdlSADMIN = $url.'SADMIN.class.php?wsdl';
if ($needSBUY){
  $wsdlSBUY = $url.'SBUY.class.php?wsdl';
}
if ($needFADMIN){
  $wsdlFADMIN = $url.'FADMIN.class.php?wsdl';
}
if ($needBADMIN){
  $wsdlBADMIN = $url.'BADMIN.class.php?wsdl';
}
// Web Services Client
include_once 'lib/nusoap.php';

// La fonction str_getcsv n'existe qu'à partir de php 5.3 donc on la crée si php < 5.3
if (!function_exists('str_getcsv')){
  include_once('str_getcsv.inc.php');
}

// Affichons ce nombre au format français
function credit_format ($credit) {
  setlocale(LC_MONETARY, 'fr_FR');
  return money_format('%n', $credit / 100);
}

//TODO:enlever ca d'ici !
//Fonction a virer a la fin qui fait un trace pour el debuggage( j'en suis assez fier ;) )
$color = Array("#BBFF00", "#CCFFCC", "#FFFFCC", "#CCAACC", "#FFAA88", "#BBCCFF", "#BBFFBB", "#00FF00");
$atrib = Array();
function trace($info, $level = 10, $line = 0, $file = 0)
{
  global $color, $atrib;

  if (!in_array($file, $atrib))
  {
    $atrib[] = $file;
  }
  if ($level > 0)
  {
    echo '<pre style="background-color:'.$color[array_search($file, $atrib)].'">';
    echo "<b>At line $line on file $file</b> \n";
    print_r($info);
    echo '</pre>';
    $txt = "\n_________________________\n".date('r')."\nAt line $line on file $file\n".print_r($info, true);
    //file_put_contents("/media/gros/share/trace.log",file_get_contents("/media/gros/share/trace.log").$txt);

  }
}

?>
