<?php
  class Kim extends Kardashian {


      public static function Extension($image) {

          $extension = explode('.', $image['name']);
          return (count($extension) == 2)? strtolower($extension[1]): '';

      }

      public static function Safe($image) {

          $safe_extensions = ['jpg', 'jpeg', 'png', 'gif'];

          if (!in_array( self::Extension($image), $safe_extensions )) return "Sorry, the file extension <b>".Kim::Extension($image)."</b> is not allowed.";

          if ($image['size'] > 20000000) return "Sorry, the maximum file size is 20MB, your image is massive! It exceeds that! Please email me for larger image uploads at <b>halesyy@gmail.com</b>.";

          return 'safe';

      }

      public static function Process($image, $reference, $path) {

        $unique_name = explode('.',$image['name'])[0] .'-'. uniqid('', true) .'.jpg';
        $destinations = ['profile' => "assets/artists/$reference/profile/$unique_name", 'artwork' => "assets/artists/$reference/$unique_name"];

        $image_destination = $destinations[$path];

        move_uploaded_file($image['tmp_name'], $image_destination);


        if (Kim::Extension($image) == 'png')
          $image_to_compress = imagecreatefrompng($image_destination);
        else if (Kim::Extension($image) == 'jpg' || Kim::Extension($image) == 'jpeg')
          $image_to_compress = imagecreatefromjpeg($image_destination);
        else if (Kim::Extension($image) == 'gif')
          $image_to_compress = imagecreatefromgif($image_destination);

        imagejpeg($image_to_compress, $image_destination, 50);

        return $unique_name; /*HOPE IT WORKED!*/

      }


  }
