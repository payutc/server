<?php
/*
 * Fonction qui permet de ressortir des traces en mode debug.
 * Il suffit de faire un require_once de ce fichier pour l'utiliser ailleurs.
 */
$color = Array("#BBFF00", "#CCFFCC", "#FFFFCC", "#CCAACC", "#FFAA88", "#BBCCFF", "#BBFFBB", "#00FF00");
$atrib = Array();

function trace($info, $level = 10, $line = 0, $file = 0) {
    global $color,$atrib;
    
    if (!in_array($file, $atrib)) {
        $atrib[] = $file;
    }
    if ($level > 0) {
        echo '<pre style="background-color:'.$color[array_search($file, $atrib)].'">';
        echo "<b>At line $line on file $file</b> \n";
        print_r($info);
        echo '</pre>';
        $txt = "\n_________________________\n".date('r')."\nAt line $line on file $file\n".print_r($info, true);
        //file_put_contents("/media/gros/share/trace.log",file_get_contents("/media/gros/share/trace.log").$txt);
    }
}

?>