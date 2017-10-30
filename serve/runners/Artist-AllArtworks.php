<?php

    // Will print a list of artists that refers to pages/_artists.scss
    $getter =
      "SELECT * FROM artworks WHERE `by` = :ref ORDER BY id DESC";
    $checker =
      [
        ':ref' => $reference
      ];

    foreach ( $psm->cquery($getter, $checker)->fetchAll() as $artwork ):

        $leonardo = new Leonardo($psm);
        $leonardo->feed($artwork['by'], 'reference');

        Bob::Artwork($artwork, $leonardo->data/*artist*/, $psm);

    endforeach;

?>
