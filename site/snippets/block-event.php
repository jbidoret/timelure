<article id="annee-<?= $event->year() ?>-<?= $event->slug() ?>" class="timeline-event <?= $event->theme()->fromAutoID()->slug() ?>" >
  <a href="<?= $event->url() ?>" class="event-link">
  <h3><?= $event->title() ?></h3>
  <?php if($event->introduction()->isNotEmpty()) :?>
    <div class="introduction">
      <?= $event->introduction()->excerpt(200, false, " […]")?>
    </div>
  <?php endif ?>

  <?php if($event->cover()->isNotEmpty()) :?>
  <figure class="event-cover">
    <?php $image = $event->cover()->toFile() ?>
    <img loading="lazy" width="<?= $image->width() ?>" height="<?= $image->height() ?>" src="<?= $image->thumb('listitem')->url()?>" alt="<?= $image->alt()?>" srcset="<?= $image->srcset('default')?>">
  </figure>
  <?php endif ?>
  </a>
</article>