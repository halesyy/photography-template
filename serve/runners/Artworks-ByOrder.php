<?php

    // Will print a list of artists that refers to pages/_artists.scss
    $getter =
      "SELECT * FROM artworks ORDER BY id DESC";
    if (isset($limit) && $limit) $getter .= " LIMIT 0,12";

    // Outputting HTML.
    foreach ( $psm->cquery($getter)->fetchAll() as $artwork ):

        $leonardo = new Leonardo($psm);
        $leonardo->feed($artwork['by'], 'reference');

        Bob::Artwork($artwork, $leonardo->data/*artist*/, $psm);

    endforeach;

?>
