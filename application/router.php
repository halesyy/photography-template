<?php
  /*
   * /(root)
   * The conversion page for the application, meant
   * to persuade people to move on.
   */
  Router::Get('/', function($Sunrise, $psm){
      print $Sunrise->Mini('Landing', false, [
        'Recent' => $Sunrise->Mini('runners/Artworks-ByPopularity', false, ['psm' => $psm, 'limit' => true]),
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



  Router::Get('about', function($Sunrise, $psm){

    print $Sunrise->Mini('pages/About', false, [
      'Footer' => $Sunrise->Mini('static/Footer', false, [])
    ]);

  });



  /*
   * /get-started
   * Conversion page for customers to community members,
   * contains information on how people can join MVP.
   */
  Router::Get('get-started', function($Sunrise, $psm){

      /*
       * Check for install file.
       */
      //  echo "<pre>", print_r($_REQUEST) ,"</pre>";
      //  echo "<pre>", print_r($_FILES) ,"</pre>";

      if (isset($_REQUEST['submit']) && isset($_REQUEST['email']) && isset($_REQUEST['name']) && isset($_REQUEST['reference']) && isset($_REQUEST['passphrase']) && isset($_FILES['photo'])) {
          $error = false;
          $req = (Object) ($_REQUEST);
          $email = $req->email; $name = ucwords($req->name); $reference  = $req->reference; $passphrase = $req->passphrase;

          $leonardo = new Leonardo($psm);
          if ($leonardo->exists($reference, 'reference')) {$error = true;$error_message='Sorry, the reference <strong>"'.$reference.'"</strong> is already in use.';}
          if ($leonardo->exists($email, 'email')) {$error = true;$error_message='Sorry, the email <strong>"'.$email.'"</strong> is currently in use.';}
          if (!$leonardo->safe_reference($reference)) {$error = true;$error_message='Sorry, the reference "'.$reference.'" is not allowed, you can only use letters and numbers.';}

          $image = $_FILES['photo'];

          if (Kim::Safe($image) !== 'safe') {
            $error_message = Kim::Safe($image);
            $error         = true;
          }
          if (!$error) {
            mkdir("assets/artists/{$reference}");
            mkdir("assets/artists/{$reference}/profile");
            $location = Kim::Process($image, $reference, 'profile');
            // Insert into database.
            $psm->insert('artists', [
              'name'       => htmlspecialchars($name),
              'passphrase' => $passphrase,
              'email'      => $email,
              'reference'  => $reference,
              'photo'      => $location,
              'bio'        => htmlspecialchars($_REQUEST['bio']),
              'verified'   => '0',
              'ip'         => $_SERVER['REMOTE_ADDR'],
              'facebook'   => htmlspecialchars($_REQUEST['facebook']),
              'twitter'    => htmlspecialchars($_REQUEST['twitter']),
              'instagram'  => htmlspecialchars($_REQUEST['instagram'])
            ]); $id = $psm->last();
            $psm->insert('pending_verify', [
              'artist_id'  => $id,
              'name'       => htmlspecialchars($name),
              'email'      => $email,
              'ip'         => $_SERVER['REMOTE_ADDR'],
              'reference'  => $reference,
              'bio'        => htmlspecialchars($_REQUEST['bio']),
              'facebook'   => htmlspecialchars($_REQUEST['facebook']),
              'twitter'    => htmlspecialchars($_REQUEST['twitter']),
              'instagram'  => htmlspecialchars($_REQUEST['instagram'])
            ]);
            $success_message = "<p>Welcome to <b>Macleay Photography, {$name}!</b></p>
            <p>Jack will be in contact with you soon to get you verified! For now, you can use your details for <a href='/submit-artwork' target='_submit-artwork'>artwork submission</a> or check your <a href='/artist/{$reference}' target='_personal-profile'>artist profile</a>.</p>
            <p><b>NOTE:</b> your account and artworks you submit under these details will not be viewable untill you get verified which shoudln't take long - that's the email you will recieve in the coming days.</p>";
          }
      }

      print $Sunrise->Mini('pages/GetStarted', false, [
        'Footer' => $Sunrise->Mini('static/Footer', false, []),

        'Success' => (isset($success_message) && !empty($success_message))?"<div class='success'>{$success_message}</div>":'',
        'Error' => (isset($error_message) && !empty($error_message))?"<div class='error'>{$error_message}</div>":''
      ]);

  });













  /*
   * Action of submitting an artwork.
   */
  Router::Get('submit-artwork', function($Sunrise, $psm){

        // echo "<pre>", print_r($_FILES) ,"</pre>";
        // echo "<pre>", print_r($_REQUEST) ,"</pre>";

        if (isset($_REQUEST['submit']) && isset($_FILES['image'])) {
            $error = false;
            $leonardo = new Leonardo($psm);

            $details = $leonardo->authenticate();
            if ($details['error'] === true) {$error = true; $error_message = $details['message'];}

            $reference  = $details['reference'];
            $passphrase = $details['passphrase'];

            $image = $_FILES['image'];

            if (Kim::Safe($image) !== 'safe') {
              $error_message = Kim::Safe($image);
              $error         = true;
            }

            if (!$error) {
              $location = Kim::Process($image, $reference, 'artwork');
              $psm->insert('artworks', [
                '`by`' => $reference,
                '`name`' => (isset($_REQUEST['title']))? $_REQUEST['title']: ' ',
                '`description`' => (isset($_REQUEST['description']))? $_REQUEST['description']: ' ',
                '`location`' => $location
              ]);
              $success_message = "Successfully uploaded image, you can view it <a href='/artwork/{$psm->last()}'>here</a> live! Or keep uploading images. :)";
            }
        }

      print $Sunrise->Mini('pages/Submission', false, [
        'Success' => (isset($success_message) && !empty($success_message))?"<div class='success'>{$success_message}</div>":'',
        'Error' => (isset($error_message) && !empty($error_message))?"<div class='error'>{$error_message}</div>":'',
        'Footer'  => $Sunrise->Mini('static/Footer', false, []),
        'psm' => $psm
      ]);

  });
