<?php
    // Get artists recent 6 artworks, supplied: $artist, $reference, $psm.

    $getter =
      "SELECT * FROM artworks WHERE `by` = :ref ORDER BY id DESC LIMIT 0,3";
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
