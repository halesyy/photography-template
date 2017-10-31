<!DOCTYPE html>
<!--
	Photography Portfolio by JACK HALES
	@jeklington halesyy@gmail.com
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
  <head>
      <title>Getting Started | Macleay Photography</title>

      <meta name="identifier-url" content="https://macleayphotography.com" />
      <meta name="title" content="Getting Started | Macleay Photography" />
      <meta name="description" content="Come join our artist and photographer team by completing the enrolment process, we want to publish and recognize your artworks!" />
      <meta name="keywords" content="publish art, show off art macleay, all macleay artists, macleay artists, artwork, kempsey artwork, macleay valley, macleay valley photos, macleay valley art, kempsey photos, kempsey art, port macquarie, port macquarie photos, coffs harbour, coffs harbour art, jack hales" />
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
          background-image: url('/assets/images/dogs.jpg');
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

      <div class="Page-GetStarted Page-Static">
          <header class="header">
            <span class="branding"><a href="/">the <b>macleay</b></a></span>
          </header>

          <div class="container">
              <h1 class="title"><div>Let's get you <b>started</b></div><div class="small">So we can get you into the community</div></h1>

              <div class="row">
                <p>To start uploading your artworks to <b>Macleay Photography</b>, you need to first aquire a <b>reference</b> and <b>passphrase</b>. These are essentially your username and password, make sure you write them down!</p>
                <p>You can fill out the form below to set your reference and passphrase, but you will not be verified till I review your profile and email you back at the email supplied. This helps keep the community safe and secure.</p>
                <p class="highlight"><a href="/about" style="color: white;">What is <b>Macleay Photography</b>?</a></p>
                <p><small><b>Note:</b> Data that is collected is NEVER commercially re-used or sold, all data is used for <b>Macleay Photography</b> ONLY and EVER.</small></p>
              </div>
          </div>
          <div class="container important">

              <form method="post" enctype="multipart/form-data" class="formation">

                  <h2>Your artist profile</h2>

                  <?=($Success)?>
                  <?=($Error)?>

                  <div class="label">EMAIL FOR FUTURE CONTACT:</div>
                  <input required type="email" name="email" value="<?=(isset($_REQUEST['email']))?$_REQUEST['email']:'';?>" placeholder="(no trash mail will be sent)" />
                  <small style="width: 100%;">After you submit your artist profile, you will get an email from <strong>halesyy@gmail.com</strong> to confirm everything and make everything is good, he will also welcome you!</small>

                  <hr />

                  <div class="row">
                      <div class="col-lg-4 col-sm-12" style="margin-bottom: 20px;">
                        <div class="label">FULL NAME:</div>
                        <input required type="text" value="<?=(isset($_REQUEST['name']))?$_REQUEST['name']:'';?>" name="name" placeholder="e.g. (John Doe)" />
                      </div>
                      <div class="col-lg-4 col-sm-12" style="margin-bottom: 20px;">
                        <div class="label">REFERENCE (only letters & numbers):</div>
                        <input required type="text" value="<?=(isset($_REQUEST['reference']))?$_REQUEST['reference']:'';?>" name="reference" placeholder="(your unique username)" />
                      </div>
                      <div class="col-lg-4 col-sm-12" style="margin-bottom: 20px;">
                        <div class="label">PASSPHRASE:</div>
                        <input required type="password" value="<?=(isset($_REQUEST['passphrase']))?$_REQUEST['passphrase']:'';?>" name="passphrase" placeholder="(similar to a password, so we know it's you)" />
                      </div>
                  </div>

                  <hr />

                  <div class="label">BIO:</div>
                  <textarea name="bio" placeholder="(small piece of information about yourself, doesn't have to be much! interests, hobbies, age, what you do, etc.)"><?=(isset($_REQUEST['bio']))?$_REQUEST['bio']:'';?></textarea>

                  <hr />

                  <div class="row">
                      <div class="col-lg-4 col-sm-12" style="margin-bottom: 20px;">
                        <div class="label">FACEBOOK LINK:</div>
                        <input type="text" name="facebook" value="<?=(isset($_REQUEST['facebook']))?$_REQUEST['facebook']:'';?>" placeholder="(optional, example: link to Facebook personal OR Facebook page for your art)" />
                      </div>
                      <div class="col-lg-4 col-sm-12" style="margin-bottom: 20px;">
                        <div class="label">TWITTER LINK:</div>
                        <input type="text" name="twitter" value="<?=(isset($_REQUEST['twitter']))?$_REQUEST['twitter']:'';?>" placeholder="(optional)" />
                      </div>
                      <div class="col-lg-4 col-sm-12" style="margin-bottom: 20px;">
                        <div class="label">INSTAGRAM LINK:</div>
                        <input type="text" name="instagram" value="<?=(isset($_REQUEST['instagram']))?$_REQUEST['instagram']:'';?>" placeholder="(optional)" />
                      </div>
                  </div>

                  <hr />

                  <div class="label">PICTURE OF YOURSELF:</div>
                  <input required type="file" name="photo" />
                  <small>This is used on your artist profile, for example: <a href="https://macleayphotography.com/artist/jackhales">https://macleayphotography.com/artist/jackhales</a></small>

                  <hr />

                  <div style="text-align: center;">
                    <input type="submit" name="submit" value="Create artist profile" />
                  </div>
              </form>

          </div>

          <?=$Footer?>
      </div>

  </body>
</html>
