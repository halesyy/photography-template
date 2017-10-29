<?php
  Router::Get('/', function($Sunrise, $psm){
      print $Sunrise->Mini('Landing', false, [
        'Recent' => $Sunrise->Mini('runners/Recent', false, ['psm' => $psm]),
        'Footer' => $Sunrise->Mini('static/Footer', false, [])
      ]);
  });






  Router::Get('artists', function($Sunrise, $psm){

      print $Sunrise->Mini('behind/Artists', false, []);

  });


  Router::Get('lastest', function($Sunrise, $psm){

      print $Sunrise->Mini('behind/Latest', false, []);

  });



  Router::Get('get-started', function($Sunrise, $psm){

      print $Sunrise->Mini('behind/GetStarted', false, [
        'Footer' => $Sunrise->Mini('static/Footer', false, [])
      ]);

  });



  Router::Get('about', function($Sunrise, $psm){

      print $Sunrise->Mini('behind/About', false, [
        'Footer' => $Sunrise->Mini('static/Footer', false, [])
      ]);

  });



  Router::Get('submit-artwork', function($Sunrise, $psm){

        // echo "<pre>", print_r($_REQUEST) ,"</pre>";
        // echo "<pre>", print_r($_FILES) ,"</pre>";
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

                $filename_unique   = explode('.',$filename)[0] .'-'. uniqid('', true) .'.'. $extension;
                $image_destination = "assets/artists/{$reference}/$filename_unique";

                if ($error) {}
                else {
                  // Moving file into new location.
                  move_uploaded_file($temploc, $image_destination);
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

        print $Sunrise->Mini('behind/Submission', false, [
          'Error' => $error_message,
          'Success' => $success_message,
          'Footer' => $Sunrise->Mini('static/Footer', false, [])
        ]);

  });
