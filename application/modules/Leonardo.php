<?php
  class Leonardo {

      /*
       * Leonardo is a class dedicated to the fine arts
       * that need precision and safety to be executed,
       * so why not give the job to the most intilectual
       * and caring being that has ever lived?
       */

      // ***********************************************************

        public $data;
        public $psm;

      // ***********************************************************

      public function __construct($psm) {

            $this->psm = $psm;

      }

      public function feed($artist_get, $by = 'id') {

            $psm    = $this->psm;
            $artist = $psm->set("SELECT * FROM artists WHERE $by = :by", [':by' => $artist_get]);
            $this->data = $artist;
            return $this;

      }

      public function photo() {

          return "/assets/artists/{$this->data['reference']}/profile/{$this->data['photo']}";

      }


      public function views() {

            return $this->psm->rows("SELECT id FROM artist_views WHERE artist_id = :id", [':id' => $this->data['id']]);

      }

      public function total_artworks_uploaded() {

          return $this->psm->rows("SELECT id FROM artworks WHERE `by` = :ref", [':ref' => $this->data['reference']]);


      }


      /*
       * --
       * Called to check if the checking user has
       * visited this profile, if not or is late,
       * will insert into database.
       */
      public function visited() {
            // Checking if there's no data in the database - if not, will insert the new view.
            if (!$this->psm->hasdata("SELECT id FROM artist_views WHERE artist_id = :ref AND ip = :ip",[
              ':ref' => $this->data['id'],
              ':ip'  => $_SERVER['REMOTE_ADDR']
            ])) {
                $view = true;
            }

            // But if not, we must check if it was more than 2 minutes ago or not - if so, we can add! Vice versa.
            else {
                $set = $this->psm->set("SELECT timeadded FROM artist_views WHERE artist_id = :ref AND ip = :ip ORDER BY id DESC LIMIT 1",[
                  ':ref' => $this->data['id'],
                  ':ip'  => $_SERVER['REMOTE_ADDR']
                ]);
                $view = ((time()-$set['timeadded'])/60 > 2)?true:false;
            }

            // Finally, if we have decided there's need for the view to be added, execute!
            if ($view) {
              $this->psm->insert('artist_views', [
                'artist_id' => $this->data['id'],
                'ip' => $_SERVER['REMOTE_ADDR'],
                'timeadded' => time()
              ]);
            }
      }


  }
