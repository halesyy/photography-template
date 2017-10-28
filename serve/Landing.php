<!DOCTYPE html>
<!--
	Photography Portfolio by JACK HALES
	@jeklington halesyy@gmail.com
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
  <head>
      <title>Macleay Photography | Jack Hales</title>
      <link rel="stylesheet" type="text/css" href="assets/css/all.min.css" />
      <link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Pacifico" rel="stylesheet">
      <script src="https://use.fontawesome.com/2880f76714.js"></script>
  		<meta charset="utf-8" />
  		<meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <script src="/assets/js/equalheights.min.js"></script>
      <script>
        var next_banner = 2; setInterval(function(){
          $('.visible').removeClass('visible');
          $('.banner-'+next_banner).addClass('visible');
          next_banner++;
          if (next_banner > $('.banner > article').length) next_banner = 1;
        }, 10000);
      </script>
      <script>
        function open_socials() {
          $('.hidden-socials').slideToggle(500);
        }
      </script>
      <script>
        $(window).on('load',function(){$('.content').equalHeights();$('.love-site').fadeIn(500);})
      </script>
      <script>
        $(document).scroll(function(){
          $('.banner > article').css({
            backgroundPosition:'center '+($(window).scrollTop()/2)+'px'
          });
        });
      </script>
  </head>
  <body>
    <div class="page-container">
      <section class="banner whole">
        <header class="header">
          <div class="hidden-socials">
            <span>Why not <b>share</b> them <b>around</b>?</span>
            <i class="fa fa-facebook" aria-hidden="true"></i>
            <i class="fa fa-twitter" aria-hidden="true"></i>
            <i class="fa fa-instagram" aria-hidden="true"></i>
            <i class="fa fa-google-plus" aria-hidden="true"></i>
            <i class="fa fa-pinterest-p" aria-hidden="true"></i>

          </div>
          <div class="branding">
            <span>the <b>macleay</b></span>
          </div>
          <div class="love-site" onclick="open_socials();">
            <span><i class="fa fa-heart-o" aria-hidden="true"></i> photos?</span>
          </div>
        </header>
        <article class="banner-1 whole visible"><h1><b>Macleay Valley</b> Photography<br/><small>By <b>Jack Hales</b></small></h1></article>
        <article class="banner-2 whole"><h1>Get <b>closer</b> to the <b>community</b></h1></article>
        <article class="banner-3 whole"><h1>At a <b>microscopic</b> level</h1></article>
        <article class="banner-4 whole"><h1></h1></article>
        <article class="banner-5 whole"><h1>Yet <b>macroscopic</b> and <b>astonishing</b></h1></article>
        <article class="banner-6 whole"><h1></h1></article>
        <article class="banner-7 whole"><h1></h1></article>
      </section>
      <section class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-sm-12">
              <div class="row">
                <h1 class="boxed-title">Recent Photos</h1>
                  <?=$Recent?>
                <div style="clear: both;"></div>
              </div>
            </div>
            <div class="col-lg-3 hidden-sm-down">
              <h1 class="boxed-title no-margin">About</h1>
              <aside class="aside">
                <!-- <h1>About</h1> -->
                <p><b>Macleay Photography</b> was made by <b>Jack Hales</b> to show the beauty of the Macleay Valley country and community.</p>
                <p>I've lived here for almost my entire life, which makes me naturally want to show off this beautiful location to the world.</p>
                <p>I set this project up so that local photographers and artists can submit their photos / artworks to get them recognized and appreciated.</p>
                <p>To glance at our talent, click <a href="/artists"><b>here</b></a> to view a list of our current photographers and artists.</p>
              </aside>
            </div>

        </div><!--end row-->
      </section>
      <footer class="footer">
        <p>Website designed by <b>Jack Hales</b>, you can find my developer career on <a href="https://www.github.com/halesyy" target="_social-github">GitHub</a> or <a href="https://stackoverflow.com/users/5782416/jek?tab=profile" target="_social-stackoverflow">StackOverflow</a>. </p>
        <div class="socials">
          <i class="fa fa-facebook" aria-hidden="true"></i>
          <i class="fa fa-twitter" aria-hidden="true"></i>
          <i class="fa fa-instagram" aria-hidden="true"></i>
          <i class="fa fa-google-plus" aria-hidden="true"></i>
          <i class="fa fa-pinterest-p" aria-hidden="true"></i>
        </div>
      </footer>
    </div>
  </body>
</html>
