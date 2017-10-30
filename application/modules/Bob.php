<?php


    class Bob extends TheBuilder {


        /*
         * Bob is the construction tool that we use to help recycle our code!
         * Bob is beautiful since he's a static machine, making him accessable
         * everywhere in the codebase.
         * Bob was built to stop copy+pasting with the development team, this
         * helps in every way since recycleable code is the future. (what)
         * --
         * Coupled with psm, Bob is a brilliant builder.
         */

         // *************************************************************************




         // *************************************************************************


         public static function Artwork($artwork, $artist, $psm) {

            $location = "/assets/artists/{$artist['reference']}/{$artwork['location']}";

            ?>
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="padding-left: 0; padding-right: 0;">
                <article class="col-12 row-1">
                  <div class="content">
                    <div class="image" style="background-image:url('<?=$location?>');"></div>
                    <div class="persist">
                      <div class="title"><a href="/artwork/<?=$artwork['id']?>"><?=$artwork['name']?></a></div>
                      <div class="description">
                        <div class="main"><?=$artwork['description']?></div>
                      </div>
                    </div>
                    <div class="by">
                      <hr />
                      By <a href="/artist/<?=$artist['reference']?>"><?=$artist['name']?></a>
                      <?php if ($psm->hasdata("SELECT id FROM artwork_likes WHERE artwork_id = :id", [':id' => $artwork['id']])): ?>
                        <span title="How many people love this image!" class="likes"><?=$psm->rows("SELECT id FROM artwork_likes WHERE artwork_id = :id", [':id' => $artwork['id']])?> <i class="fa fa-heart" aria-hidden="true"></i></span>
                      <?php endif; ?>
                    </div>
                  </div>
                </article>
              </div>
            <?php

         }

         public static function ArtistPreview($artist) {

            $photo = "/assets/artists/{$artist['reference']}/profile/{$artist['photo']}";

            ?>
              <div class="equalizer col-lg-6 col-sm-12">
                <div class="artist">
                  <div class="row">
                    <div class="col-lg-4 col-sm-12 artist-image">
                      <img src="<?=$photo?>" width="100%" />
                    </div>
                    <div class="col-lg-8 col-sm-12 artist-content">
                      <h2 class="artist-name"><a href="/artist/<?=$artist['reference']?>"><?=$artist['name']?></a></h2>
                      <p class="artist-bio"><?=$artist['bio']?></p>
                    </div>
                  </div>
                </div>
              </div>
            <?php

         }

    }
