<?php
  /*
   * /(root)
   * The conversion page for the application, meant
   * to persuade people to move on.
   */
  Router::Get('/', function($Sunrise, $psm){
      print $Sunrise->Mini('Landing', false, [
        'Recent' => $Sunrise->Mini('runners/Artworks-ByOrder', false, ['psm' => $psm, $limit = true]),
        'Footer' => $Sunrise->Mini('static/Footer'),
        'CommonHead' => $Sunrise->Mini('static/CommonInHead'),
      ]);
  });







  /*
   * /artists
   * Display of all artists, located from database table
   * artists.
   */
  Router::Get('artists', function($Sunrise, $psm){

      print $Sunrise->Mini('pages/Artists', false, [
        'Footer' => $Sunrise->Mini('static/Footer'),
        'CommonHead' => $Sunrise->Mini('static/CommonInHead'),
        'ArtistList' => $Sunrise->Mini('runners/Artists-ByPhotographs', false, ['psm' => $psm]),
        'psm'        => $psm
      ]);

  });







  /*
   * /artwork/{id}
   * Display an artist's work.
   */
  Router::Get('artwork', function($Sunrise, $psm){


      // 1. NO Second parameter.
      // 2. Second parameter NOT numberic.
      // 3. ARTWORK doesn't exist.
      // ANY = route to /recent to pick a real artwork.
      if (Router::Second() === false) {header('Location: /recent');} else $id = Router::Second();
      if (!is_numeric($id)) {header('Location: /recent');}
      if (!$psm->hasdata("SELECT id FROM artworks WHERE id = :id", [':id' => $id])) {header('Location: /recent');}

      // Gather artwork then artist data from artwork `by` column.
      $artwork = $psm->set("SELECT * FROM artworks WHERE id = :id", [':id' => $id]);
      $artist  = $psm->set("SELECT name,photo,reference FROM artists WHERE reference = :ref", [':ref' => $artwork['by']]);

      // Print out Artwork.
      print $Sunrise->Mini('pages/Artwork', false, [
        'Footer' => $Sunrise->Mini('static/Footer'),
        'CommonHead' => $Sunrise->Mini('static/CommonInHead'),
        'artist' => $artist,
        'artwork' => $artwork,
        'location' => "/assets/artists/{$artist['reference']}/{$artwork['location']}",
        'psm' => $psm
      ]);

  });






  /*
   * /artist/{id}
   * Display an artist's basic portfolio.
   */
  Router::Get('artist', function($Sunrise, $psm){
      // 1. NO Second parameter.
      // 2. ARTIST does not exist.
      // ANY = route to /recent to pick a real artwork.
      if (Router::Second() === false) header('Location: /artists'); else $reference = Router::Second();
      if (!$psm->hasdata("SELECT id FROM artists WHERE reference = :ref", [':ref' => $reference])) {echo "sorry, that artist doesn't exist...<script>setTimeout(function(){window.location.href='/artists';},1000);</script>";}

      // Get data for the artist.
      $leonardo = new Leonardo($psm);
      $leonardo->feed($reference, 'reference')->visited();
      $artist = $leonardo->data;

      if (Router::Third() == "all") {
        $show_all = true;
        $all_artworks = $Sunrise->Mini('runners/Artist-AllArtworks', false, [
            'psm'       => $psm,
            'reference' => $reference
        ]);
      } else $show_all = $all_artworks = false;

      print $Sunrise->Mini('pages/Artist', false, [
          'artist' => (Object) $artist,
          'photo'  => $leonardo->photo(),
          'Footer' => $Sunrise->Mini('static/Footer'),
          'CommonHead' => $Sunrise->Mini('static/CommonInHead'),

          'recent_artworks' => $Sunrise->Mini('runners/Artist-RecentArtworks', false, [
            'psm'       => $psm,
            'reference' => $reference,
            'artist'    => $artist
          ]),

          'showing_all'  => $show_all,
          'all_artworks' => $all_artworks,

          'psm'      => $psm,
          'leonardo' => $leonardo
      ]);
  });






  /*
   * /latest
   * Display's a collection of artists work that
   * has been uploaded recently.
   */
  Router::Get('latest', function($Sunrise, $psm){

      print $Sunrise->Mini('pages/Latest', false, [
        'Footer' => $Sunrise->Mini('static/Footer', false, []),

        'artworks_by_order' => $Sunrise->Mini('runners/Artworks-ByOrder', false, [
            'psm' => $psm
        ]),

        'psm' => $psm
      ]);

  });






  /*
   * /get-started
   * Conversion page for customers to community members,
   * contains information on how people can join MVP.
   */
  Router::Get('get-started', function($Sunrise, $psm){

      print $Sunrise->Mini('pages/GetStarted', false, [
        'Footer' => $Sunrise->Mini('static/Footer', false, [])
      ]);

  });







  Router::Get('about', function($Sunrise, $psm){

      print $Sunrise->Mini('pages/About', false, [
        'Footer' => $Sunrise->Mini('static/Footer', false, [])
      ]);

  });







  Router::Get('submit-artwork', function($Sunrise, $psm){

        // echo "<pre>", print_r($_FILES) ,"</pre>";
        // echo "<pre>", print_r($_REQUEST) ,"</pre>";
        /*Checking if we have a request to install a file.*/
        if (isset($_REQUEST['submit']) && isset($_FILES['image']) && isset($_REQUEST['reference']) && isset($_REQUEST['passphrase'])) {
            // Checking if the reference + passphrase are legit.
            if ($psm->hasdata("SELECT id FROM artists WHERE reference = :ref AND passphrase = :pas", [
              ':ref' => $_REQUEST['reference'],
              ':pas' => $_REQUEST['passphrase']
            ])) { $reference = $_REQUEST['reference']; $passphrase = $_REQUEST['passphrase'];
                /*will do some image manipulation and placement, then pop database record internal*/
                $image    = $_FILES['image'];
                $filename = $image['name']; /*makes name add -TIME to stop collisions*/
                $filetype = $image['type'];
                $filesize = $image['size'];
                $temploc  = $image['tmp_name']; /*temporary location in PHP*/
                $error    = $image['error'];

                /*Extension handling.*/
                $extension = explode('.', $filename);
                $extension = (count($extension) == 2)? strtolower($extension[1]): '';
                $whitelist_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array($extension, $whitelist_extensions)) { $error_message = 'Sorry, the file extension <b>'.$extension.'</b> is not allowed.'; $error = true; }

                /*Filesize handling. Greater than 20MB*/
                if ($filesize > 20000000) { $error_message = 'Sorry, the maximum filesize is 20MB, your image exceeds that!'; $error = true; }

                $filename_unique   = explode('.',$filename)[0] .'-'. uniqid('', true) .'.jpg';
                // $filename_unique_compressed   = explode('.',$filename)[0] .'-'. uniqid('', true) .'.cmp.jpg';
                $image_destination = "assets/artists/{$reference}/$filename_unique";
                // $image_destination_compressed = "assets/artists/{$reference}/$filename_unique_compressed";

                if ($error) {}
                else {
                  // Moving file into new location.
                  move_uploaded_file($temploc, $image_destination);
                  // Compressing new file.
                  if ($extension == 'png') $image_to_compress = imagecreatefrompng($image_destination);
                  else if ($extension == 'jpg' || $extension == 'jpeg') $image_to_compress = imagecreatefromjpeg($image_destination);
                  else if ($extension == 'gif') $image_to_compress = imagecreatefromgif($image_destination);
                  imagejpeg($image_to_compress, $image_destination, 50);
                  // Adding database entry for new image.
                  $psm->insert('artworks', [
                    '`by`' => $reference,
                    '`name`' => (isset($_REQUEST['title']))? $_REQUEST['title']: ' ',
                    '`description`' => (isset($_REQUEST['description']))? $_REQUEST['description']: ' ',
                    '`location`' => $filename_unique
                  ]);

                  $success_message = 'Successfully uploaded image, you can view it <a href="/artwork/'.$psm->last().'">here</a> live! Or keep uploading images. :)';
                }
            } else $error_message = 'Sorry, that reference and passphrase doesn\'t make sense to us..';
        }

        if (isset($error_message) && !empty($error_message)) $error_message = "<div class='error'>{$error_message}</div>";
        else $error_message = '';
        if (isset($success_message) && !empty($success_message)) $success_message = "<div class='success'>{$success_message}</div>";
        else $success_message = '';

        print $Sunrise->Mini('pages/Submission', false, [
          'Error' => $error_message,
          'Success' => $success_message,
          'Footer' => $Sunrise->Mini('static/Footer', false, [])
        ]);

  });
