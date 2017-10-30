<!DOCTYPE html>
<!--
	Photography Portfolio by JACK HALES
	@jeklington halesyy@gmail.com
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
  <head>
      <title><?=$artist->name?> | Macleay Photography</title>

      <meta name="identifier-url" content="https://macleayphotography.com" />
      <meta name="title" content="<?=$artist->name?> Artist - Macleay Photography" />
      <meta name="description" content="The artwork of <?=$artist->name?> on Macleay Photography." />
      <meta name="keywords" content="<?=strtolower($artist->name)?>, macleay valley, macleay valley photos, macleay valley art, kempsey photos, kempsey art, port macquarie, port macquarie photos, coffs harbour, coffs harbour art, jack hales" />
      <meta name="author" content="Jack Hales" />
      <meta name="revisit-after" content="2 days" />
      <meta name="language" content="EN" />
      <meta name="copyright" content="© 2017 Macleay Photography" />
      <meta name="robots" content="All" />

      <link rel="stylesheet" type="text/css" href="/assets/css/all.min.css" />
      <link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Pacifico|Courgette" rel="stylesheet">
      <script src="https://use.fontawesome.com/2880f76714.js"></script>
  		<meta charset="utf-8" />
  		<meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <script src="/assets/js/equalheights.min.js"></script>
      <style>
        body {
          background-image: url('/assets/images/yellowflower.jpg');
          background-size: cover;
          background-position: center;
          min-height: 100vh;
          width: 100%;
        }
      </style>
      <script>
        $(document).ready(function(){$('.row-1 .persist').equalHeights();})
      </script>

      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108822305-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-108822305-1');
      </script>


  </head>
  <body>
      <div class="Page-Artist Page-Static">

          <header class="header">
            <span class="branding"><a href="/">the <b>macleay</b></a></span>
          </header>

          <div class="container-fluid" style="background: rgba(255, 255, 255, 0.7);">

              <!-- <h1 class="title"><div>Let's get you <b>started</b></div><div class="small">So we can get you into the community.</div></h1> -->
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <div class="container-fluid white" style="margin-top: 0;">
                    <img class="artist-image" alt="<?=$artist->name?> Profile Picture" src="<?=$photo?>" width="100%" style="margin-bottom: 20px;" />
                    <hr />
                    <h2 class="artist-title"><?=$artist->name?></h2>
                    <p class="artist-bio"><?=$artist->bio?></p>
                    <?php if (!empty($artist->facebook) || !empty($artist->twitter) || !empty($artist->instagram)): ?>
                      <hr />
                      <p class="color"><b>Follow this artist on:</b></p>
                      <?php if (!empty($artist->facebook)): ?>
                        <i class="fa about-fa fa-facebook" aria-hidden="true" onclick="window.open('<?=$artist->facebook?>', '_artist-facebook');"></i>
                      <?php endif; ?>
                      <?php if (!empty($artist->twitter)): ?>
                        <i class="fa about-fa fa-twitter" aria-hidden="true" onclick="window.open('<?=$artist->twitter?>', '_artist-twitter');"></i>
                      <?php endif; ?>
                      <?php if (!empty($artist->instagram)): ?>
                        <i class="fa about-fa fa-instagram" aria-hidden="true" onclick="window.open('<?=$artist->instagram?>', '_artist-instagram');"></i>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                  <div class="container-fluid white" style="margin-top: 40px; margin-bottom: 40px;">
                    <h2 class="artist-title">Statistics</h2>
                    <hr />
                    <div class="row">
                      <div class="col-lg-6 col-xs-12">
                        Profile Views
                      </div>
                      <div class="col-lg-6 col-xs-12">
                        <?=$leonardo->views()?>
                      </div>
                      <div class="col-lg-6 col-xs-12">
                        Photos
                      </div>
                      <div class="col-lg-6 col-xs-12">
                        <?=$leonardo->total_artworks_uploaded()?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                  <div class='container-fluid white' style="margin-top: 0;">
                    <h2 class="boxed-title no-margin" style="margin-top: 0;">Recent Artworks</h2>

                    <div class="row">
                      <?php if ($showing_all): ?>
                        <?=($all_artworks)?>
                      <?php else: ?>
                        <?=($recent_artworks)?>
                      <?php endif; ?>

                    </div>
                  </div>

                  <div class="container-fluid white" style="margin-top: 40px;">
                    <?php if ($showing_all): ?>
                      <div class="switcher"><a href="/artist/<?=$artist->reference?>"><b>Show recent works</b></a></div>
                    <?php else: ?>
                      <div class="switcher"><a href="/artist/<?=$artist->reference?>/all"><b>Show all works</b></a></div>
                    <?php endif; ?>
                  </div>

                </div>
              </div>

          </div>


          <?=$Footer?>

      </div>




  </body>
</html>
