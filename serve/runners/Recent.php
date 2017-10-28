<?php // Returns the 9 recent artworks. ?>
<?php $count = 1; foreach ($psm->cquery("SELECT * FROM artworks ORDER BY id DESC LIMIT 0,9")->fetchAll(PDO::FETCH_ASSOC) as $artwork): ?>
    <?php $artist  = $psm->artist($artwork['by']); ?>
    <?php $artwork = $artwork; ?>
    <?php $last_span = ($count == 9)?'12':'6'; ?>
    <?php $location = "assets/artists/{$artist['reference']}/{$artwork['location']}"; ?>

    <article class="col-lg-4 col-md-<?=$last_span?> col-sm-<?=$last_span?> col-xs-12">
      <div class="content">
        <div class="image" style="background-image:url('<?=$location?>');"></div>
        <div class="title"><a href="/artwork/<?=$artwork['id']?>"><?=$artwork['name']?></a></div>
        <div class="description">
          <?=$artwork['description']?>
          <hr />
          By <a href="/artists/<?=$artist['reference']?>"><?=$artist['name']?></a>
        </div>
      </div>
    </article>

<?php $count++; endforeach; ?>
