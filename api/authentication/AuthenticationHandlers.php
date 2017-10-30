<?php
  $Authentication = [

      'artwork-note' => function($Sunrise, $api) {
          $post   = (Object) $_POST;
          $psm    = $api->psm();

          $note = htmlspecialchars($post->note);
          if (!is_numeric($post->artworkid)
          || !$psm->hasdata("SELECT id FROM artworks WHERE id = :id", [':id' => $post->artworkid])) die;

          $psm->insert('artwork_notes', [
            'artwork_id' => $post->artworkid,
            'note' => $note,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'timeadded' => time()
          ]);

          $api->JSON();
      },


      'flag-artwork' => function($Sunrise, $api) {
          $post   = (Object) $_POST;
          $psm    = $api->psm();

          if (!is_numeric($post->artworkid)
          || $psm->hasdata("SELECT id FROM flags WHERE artwork_id = :id", [':id' => $post->artworkid])
          || !$psm->hasdata("SELECT id FROM artworks WHERE id = :id", [':id' => $post->artworkid])) die;

          $psm->insert('flags', [
            'artwork_id' => $post->artworkid,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'timeadded' => time()
          ]);

          $api->JSON();
      },

  ];
