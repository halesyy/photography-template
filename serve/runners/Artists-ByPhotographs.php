<?php

    // Will print a list of artists that refers to pages/_artists.scss
    $getter =
      "SELECT reference,bio,name,photo FROM artists a ORDER BY (
          SELECT COUNT(*)
          FROM artworks r
          WHERE r.`by` = a.reference
      ) DESC";

    // Outputting HTML.
    foreach ( $psm->cquery($getter)->fetchAll() as $artist ):

        Bob::ArtistPreview($artist);

    endforeach;

?>
