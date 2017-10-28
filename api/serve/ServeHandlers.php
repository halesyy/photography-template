<?php
  //URL: /api/get/$ServeKey

  $Serve = [

      'parent-guardians' => function($Sunrise) {

          $Sunrise->Render('Pages/Parent_Guardians', [

          ], '..');

      },

      'students' => function($Sunrise) {

          $Sunrise->Render('Pages/Students', [

          ], '..');

      }

  ];

  $Serve_Pieces = [

      'fillout' => function($Sunrise, $api) {
        #/api/get/fillout/{student/parent-guardians}
        if (!in_array(Router::Fourth(), array_keys($api->conversion_s))) $api->error('Reference not in converter as key.');
        else $type = Router::Fourth();

        if (count($_SESSION[ $api->conversion_s[$type] ]) != 0) {
          $forms = [];
          foreach ($_SESSION[ $api->conversion_s[$type] ] as $index => $Object) {
            array_push($forms, [ 'id'   => $Object['id'],
              'body' => $Sunrise->Mini("Page_Pieces/{$api->conversion_f[$type]}", '..', [
                'id' => $Object['id'],
                'data' => $Object['data']
              ])
            ]);
          }//
          $api->JSON([ 'forms' => $forms ]);
        }

        else {
          $r = $api->create_new_object($Sunrise, $type);
          $api->JSON(['forms' => [
            ['id' => $r['id'], 'body' => $r['form']]
          ]]);
        }
      },

      'new' => functioN($Sunrise, $api) {
        if (!in_array(Router::Fourth(), array_keys($api->conversion_s))) $api->error('Reference not in converter as key.');
        else $type = Router::Fourth();

        $r = $api->create_new_object($Sunrise, $type);
        $api->JSON([
          'forms' => [[
            'id'   => $r['id'],
            'body' => $r['form']
          ]]
        ]);
      }



  ];

  $Serve = array_merge($Serve, $Serve_Pieces);