<?php
  Router::Get('/', function($Sunrise, $psm){
      $Recent = $Sunrise->Mini('runners/Recent', false, ['psm' => $psm]);
      print $Sunrise->Mini('Landing', false, [
        'Recent'=>$Recent
      ]);
  });

  Router::Get('artists', function($Sunrise, $psm){
      $Sunrise->Render('Artists', []);
  });
