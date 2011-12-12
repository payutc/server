<?php 
/**
 * Implémentation de la fonction str_getcsv
 * @return Array $array0
 * @param String $string_csv
 * @param String $pattern
 */
function str_getcsv($string_csv, $pattern) {
  if (!empty($string_csv) && is_string($string_csv)) {
    $array0 = explode(";\n", $string_csv, -1);
    foreach ($array0 as $i=>$array1) {
      $array2 = substr($array1, 1, -1);
      $array0[$i] = explode('"'.$pattern.'"', $array2);
      foreach ($array0[$i] as $j=>$array3) {
        $array0[$i][$j] = $array3;
      }
    }
    return $array0;
  } else { return 400; }
}
?>
