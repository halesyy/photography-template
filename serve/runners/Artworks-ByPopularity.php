<?php

    // Will print a list of artists that refers to pages/_artists.scss
    $getter =
      "SELECT * FROM artworks a ORDER BY (
          SELECT COUNT(*)
          FROM artwork_likes r
          WHERE r.artwork_id = a.id
      ) DESC";
    if (isset($limit) && $limit) $getter .= " LIMIT 0,6";

    // Outputting HTML.
    foreach ( $psm->cquery($getter)->fetchAll() as $artwork ):

        $leonardo = new Leonardo($psm);
        $leonardo->feed($artwork['by'], 'reference');

        Bob::Artwork($artwork, $leonardo->data/*artist*/, $psm);

    endforeach;

?>
