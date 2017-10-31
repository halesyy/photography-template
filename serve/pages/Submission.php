<!DOCTYPE html>
<!--
	Photography Portfolio by JACK HALES
	@jeklington halesyy@gmail.com
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
  <head>
      <title>Submission | Macleay Photography</title>

      <meta name="identifier-url" content="https://macleayphotography.com" />
      <meta name="title" content="Submit Artworks | Macleay Photography" />
      <meta name="description" content="If you're already part of our team, you can submit your artworks through this page. Simply add your reference and passphrase and start uploading to the Macleay Community!" />
      <meta name="keywords" content="submit art, recognize art macleay kempsey, macleay valley, macleay valley photos, macleay valley art, kempsey photos, kempsey art, port macquarie, port macquarie photos, coffs harbour, coffs harbour art, jack hales" />
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
          background-image: url('/assets/images/bridge.jpg');
          background-size: cover;
          background-position: center;
          min-height: 100vh;
          width: 100%;
        }
      </style>

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
    <div class="Page-Submission Page-Static">
      <header class="header">
        <span class="branding"><a href="/">the <b>macleay</b></a></span>
      </header>
      <div class="container">
        <h1 class="title"><div>Submit <b>your artwork</b></div> <div class="small">Show the community</div></h1>
        <div class="info-standard margin-bottom">
          If you have not yet got yourself set up with a reference and passphrase to submit work, please check the <a href="/get-started">get started</a> page to get yourself setup and good to go submitting your art! <!--If you're still skeptical, check out <a href="/why-join">why join</a> to understand the advantage.-->
        </div>
        <div class="row">
          <div class="col-lg-9 col-sm-12 left margin-bottom">
            <div class="inner">
              <form method="post" enctype="multipart/form-data" class="formation">

                <?=$Error?>
                <?=$Success?>

                <?php if (isset($_SESSION['reference']) && isset($_SESSION['passphrase'])): ?>
                  <?php
                    $leonardo = new Leonardo($psm);
                    $leonardo->feed($_SESSION['reference'], 'reference'); ?>
                  <h3>Logged in as <strong><?=$leonardo->data['name']?></strong></h3>
                <?php else: ?>
                  <div class="row">
                    <div class="col-lg-6 col-sm-12">
                      <div class="label">REFERENCE:</div>
                      <input required type="text" name="reference" value="<?=(isset($_REQUEST['reference']))?$_REQUEST['reference']:"";?>" />
                    </div>
                    <div class="col-lg-6 col-sm-12">
                      <div class="label">PASSPHRASE:</div>
                      <input required type="password" name="passphrase"  value="<?=(isset($_REQUEST['passphrase']))?$_REQUEST['passphrase']:"";?>" />
                    </div>
                  </div>
                <?php endif; ?>

                <hr />

                <div class="label">TITLE OF ARTWORK:</div>
                <input required type="text" placeholder="(basic description of artwork to catch peoples attention)" name="title" style="margin-bottom: 20px;" />

                <div class="label">DESCRIPTION:</div>
                <textarea name="description" placeholder="(optional but recommended - a back story if the artwork has one)" style="height: 100px; resize: vertical;"></textarea>

                <hr />

                <div class="label">IMAGE OF ARTWORK DESCRIBED:</div>
                <input type="file" name="image" />

                <hr />

                <div style="text-align: center;">
                  <input type="submit" name="submit" />

                </div>

              </form>
            </div>
          </div>
          <div class="col-lg-3 col-sm-12 right">
            <div class="inner">
              <p><strong><h4>How this works:</h4></strong></p>
              <ol>
                <li style="margin-bottom: 10px;">Recieve your reference and passphrase from going to <a href="/get-setup">this page</a>.</li>
                <li style="margin-bottom: 10px;">Submit your artworks under your reference and passphrase (title, description, photo, etc) to be checked <small>(to make sure it's not inappropriate or spam)</small></li>
              </ol>
            </div>
          </div>
        </div>
      </div>



      <?=$Footer?>
    </div>

  </body>
</html>
