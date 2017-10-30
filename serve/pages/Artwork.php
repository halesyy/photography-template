<!DOCTYPE html>
<!--
	Photography Portfolio by JACK HALES
	@jeklington halesyy@gmail.com
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
  <head>
      <title><?=(!empty($artwork['name']))?$artwork['name']:'Artwork'?> by <?=$artist['name']?> | Macleay Photography</title>

      <meta property="og:title" content="Macleay Valley Photography | Jack Hales">
      <meta property="og:description" content="<?=(!empty($artwork['description']))?$artwork['description'].' | ':'';?>Macleay Photography provides beautiful artworks of photography and creation in the Macleay Valley and surrounding areas. Providing a platform to help get local photographers and artists recognized for their works.">
      <meta property="og:image" content="https://macleayphotography.com<?=$location?>">
      <meta property="og:url" content="https://macleayphotography.com/">
      <meta name="twitter:card" content="summary_large_image">

      <meta name="identifier-url" content="https://macleayphotography.com" />
      <meta name="title" content="<?=(!empty($artwork['name']))?$artwork['name']:'Artwork'?> by <?=$artist['name']?> - Macleay Photography" />
      <meta name="description" content="'<?=(!empty($artwork['name']))?$artwork['name']:'Artwork'?>' by '<?=$artist['name']?>'" />
      <meta name="keywords" content="<?=strtolower( (!empty($artwork['name']))?$artwork['name']:'Artwork' )?>, artwork, kempsey artwork, macleay valley, macleay valley photos, macleay valley art, kempsey photos, kempsey art, port macquarie, port macquarie photos, coffs harbour, coffs harbour art, jack hales" />
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
        $(document).ready(function(){$('.row-1 .content').equalHeights();})
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

      <div class="Page-Artwork Page-Static">

          <header class="header">
            <span class="branding"><a href="/">the <b>macleay</b></a></span>
          </header>

          <section class="container" style="padding: 2px;">
            <div class="showoff">
              <img src="<?=$location?>" width="100%" />
            </div>
          </section>
          <section class="container explain">
            <div class="row">
              <div class="col-lg-9 col-sm-12">
                <h1><?=(!empty($artwork['name']))?$artwork['name']:'Unnamed Artwork';?></h1>
                <p><?=(!empty($artwork['description']))?$artwork['description']:'';?></p>
              </div>
              <div class="col-lg-3 col-sm-12">
                <!-- <img alt="<?=$artist['name']?> Profile Picture" src="/assets/artists/<?=$artist['reference']?>/profile/<?=$artist['photo']?>" width="100%" /> -->
                <p>This artwork was done by</p>
                <p><a href="/artist/<?=$artist['reference']?>"><?=$artist['name']?></a></p>
              </div>
            </div>
          </section>
          <section class="container vote">
            <div class="row">
              <div class="col-lg-2 col-sm-6 col-xs-12 vote-button-container">
                <i title="Love this artwork! Show them you care." id="like-button"
                 onclick="$.post('/api/get/like-artwork/<?=$artwork['id']?>',function(response){console.log(response);$('#like-button').addClass('liked');});" class="fa fa-heart fa-2x <?=($psm->hasdata("SELECT id FROM artwork_likes WHERE artwork_id = :id AND ip = :ip", [':id' => $artwork['id'],':ip' => $_SERVER['REMOTE_ADDR']]))?'liked':'no-liked'?>" aria-hidden="true"></i>
              </div>
              <div class="col-lg-2 col-sm-6 col-xs-12 vote-button-container">
                <i title="Flag as inappropriate. An Administrator will be notified."
                 onclick="$.post('/api/post',{type:'flag-artwork',artworkid:<?=$artwork['id']?>},function(response){console.log(response);})" class="fa fa-flag fa-2x flag" aria-hidden="true"></i>
              </div>
              <div class="col-lg-8 col-sm-12">
                <form id="note-form" class="formation" style="text-align: center;">
                  <input required type="text" id="note-ipt" name="message-artist" style="margin-top: 10px; width: 60%;" placeholder="(public note to artist about artwork)" />
                  <input type="submit" name="submit" value="Write" />
                </form>
                <script>
                $('#note-form').submit(function(event){
                  event.preventDefault();
                  $.post('/api/post', {
                    type: 'artwork-note',
                    note: $('#note-ipt').val(),
                    artworkid: '<?=$artwork['id']?>'
                  }, function(response){
                    let json = JSON.parse(response);
                    if (json.success == true) window.location.reload();
                  });
                  return false;
                });
                </script>
              </div>
            </div>
          </section>

          <?php if ($psm->hasdata("SELECT id FROM artwork_notes WHERE artwork_id = :id", [':id' => $artwork['id']])): ?>
            <section class="container notes">
              <h2>Public notes</h2>
              <div class="row">
                <?php foreach ($psm->cquery("SELECT * FROM artwork_notes WHERE artwork_id = :id ORDER BY id DESC", [':id' => $artwork['id']])->fetchAll(PDO::FETCH_ASSOC) as $note): ?>
                  <div class="col-lg-6 col-sm-12" style="padding-left: 0; padding-right: 0;">
                    <article class="note">
                      <p class="main"><?=htmlspecialchars($note['note'])?></p>
                    </article>
                  </div>
                <?php endforeach; ?>
              </div>
            </section>
          <?php endif; ?>

          <?=$Footer?>

      </div>




  </body>
</html>
