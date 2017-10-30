<!DOCTYPE html>
<!--
	Photography Portfolio by JACK HALES
	@jeklington halesyy@gmail.com
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
  <head>
      <title>Artists | Macleay Photography</title>

      <meta name="identifier-url" content="https://macleayphotography.com" />
      <meta name="title" content="Artists on Macleay Photography" />
      <meta name="description" content="Our artist team in the Macleay Photography community who produce the artworks." />
      <meta name="keywords" content="artists, all macleay artists, macleay artists, artwork, kempsey artwork, macleay valley, macleay valley photos, macleay valley art, kempsey photos, kempsey art, port macquarie, port macquarie photos, coffs harbour, coffs harbour art, jack hales" />
      <meta name="author" content="Jack Hales" />
      <meta name="revisit-after" content="2 days" />
      <meta name="language" content="EN" />
      <meta name="copyright" content="© 2017 Macleay Photography" />
      <meta name="robots" content="All" />

      <link rel="stylesheet" type="text/css" href="assets/css/all.min.css" />
      <link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Pacifico|Courgette" rel="stylesheet">
      <script src="https://use.fontawesome.com/2880f76714.js"></script>
  		<meta charset="utf-8" />
  		<meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <script src="/assets/js/equalheights.min.js"></script>
      <style>
        body {
          background-image: url('/assets/images/flowerpink2.jpg');
          background-size: cover;
          background-position: center;
          min-height: 100vh;
          width: 100%;
        }
      </style>

      <script>
        $(document).ready(function(){$('.artist-image > img').equalHeights();})
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
    <div class="Page-Artists Page-Static">
      <header class="header">
        <span class="branding"><a href="/">the <b>macleay</b></a></span>
      </header>

      <div class="container-fluid">
        <h1 class="title" style="letter-spacing: normal;"><div>All <b>Artists</b></div><div class="small">Sorted by total photos contributed</div></h1>
        <div class="row">

            <?=$ArtistList?>

        </div>
      </div>

      <?=$Footer?>
    </div>

  </body>
</html>
