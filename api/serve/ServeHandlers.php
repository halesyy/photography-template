<?php
  //URL: /api/get/$ServeKey

  $Serve = [

      'like-artwork' => function ($Sunrise, $api) {
        #/api/get/like-artwork/id

          if (Router::Fourth() === false) header('Location: /latest');
          if (!is_numeric(Router::Fourth())) header('Location: /latest');

          $id  = Router::Fourth();
          $psm = $api->psm();

          // If so, has data currently for the artwork.
          if ($psm->hasdata("SELECT id FROM artwork_likes WHERE artwork_id = :id AND ip = :ip", [
            ':id' => $id,
            ':ip' => $_SERVER['REMOTE_ADDR']
          ])) {$api->JSON();}
          else {
          // Not so, will continue adding into the database.
            $psm->insert('artwork_likes', [
              'artwork_id' => $id,
              'ip' => $_SERVER['REMOTE_ADDR'],
              'timeadded' => time()
            ]);
            $api->JSON(['like' => true]);
          }


      }

  ];
