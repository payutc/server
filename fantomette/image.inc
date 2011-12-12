<?php
/***************************************************************************
 *                                 image.inc
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Saturday, Dec 19, 2009
 *   Copyright        : (C) 2005 UTT Net Group
 *   Licence		     : GNU GPL
 *   Email            : ung@utt.fr
 *   Version		     : 7.0
 *
 *
 ***************************************************************************/

 
 /***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License as
 *   published by the Free Software Foundation; either version 2 of the
 *   License, or (at your option) any later version.
 *
 *   ---------------------------------------------------
 *
 *   http://www.gnu.org/copyleft/gpl.html
 *
 ***************************************************************************/

 
 /***************************************************************************
 *
 *   Log de modification
 *
 *   -----------------------------------------------------------------------
 *
 *   Nom			Date 			Commentaire
 *
 *
 *
 *
 *
 ***************************************************************************/

//TODO: Gérer les différentes extensions

// On verifie si l'image est déjà dans le cache
/*if (file_exists('images/'.$id_image.'.jpg')) {
  echo '<img src="images/'.$id_image.'.jpg" alt="'.$name_object.'" />';
} else {
  $allImageCSV = $SADMIN->getImage($id_image);
  foreach (str_getcsv($allImageCSV, ',') as $allImage) {
    $id_image = $allImage[0];
    $mime = $allImage[1];
    $width = $allImage[2];
    $height = $allImage[3];
    $image = base64_decode($allImage[4]);
  }
  $im = imagecreatefromstring($image);
  if ($im !== false) {
    // Calcul des nouvelles dimensions
    $oldwidth = imagesx($im);
    $oldheight = imagesy($im);

    // 	Chargement
    $thumb = imagecreatetruecolor($width, $height);

    // Redimensionnement
    imagecopyresized($thumb, $im, 0, 0, 0, 0, $width, $height, $oldwidth, $oldheight);

  	// Sauvegarde de l'image
    imagejpeg($thumb, 'images/'.$id_image.'.jpg');
    // On donne les bons droits
    chmod('images/'.$id_image.'.jpg', 0755);
    
    // Libération de la mémoire
    imagedestroy($im);
    imagedestroy($thumb);

  }
  else {
    echo '402';
  }
  echo '<img src="images/'.$id_image.'.jpg" width="'.$width.'" height="'.$height.'" alt="'.$name_object.'" />';
}*/
?>
