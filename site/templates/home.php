<?php snippet('header') ?>

  <nav id="years-nav">
    <ul>
    <li><a href="#annee-1953">1953</a></li>
    <li><a href="#annee-1960">1960</a></li>
    <li><a href="#annee-1970">1970</a></li>
    <li><a href="#annee-1980">1980</a></li>
    <li><a href="#annee-1990">1990</a></li>
    <li><a href="#annee-2000">2000</a></li>
    <li><a href="#annee-2010">2010</a></li>
    <li><a href="#annee-2020">2020</a></li>
    </ul>
  </nav>
  <main id="home">
    <header>
      <?php foreach(page('themes')->children() as $theme) :?>
        <div class="<?= $theme->slug() ?>">
          <h2><?= $theme->title() ?></h2>
          <?php e($theme->introduction()->isNotEmpty(), '<div class="introduction">' . $theme->introduction()->kt() . '</div>') ?>
        </div>
      <?php endforeach ?>
    </header>
    <?php 
      $years = page('annees')->children()->listed();
      foreach($years as $year) :
      $themes = page('chronologie')->children()->listed()->filterBy('year', $year->title())->groupBy('theme');
    ?>
    <section id="annee-<?= $year->slug() ?>" class="year">
      <h2><?= $year->title() ?></h2>
      <!-- so sorry -->
      <span></span><span></span><span></span>
      <!-- / so sorry -->
      <?php foreach($themes as $theme => $events) :
        $mytheme = autoid($theme); ?>
        <div class="events <?= $mytheme->slug() ?>">
          <?php foreach($events as $event) : ?> 
          <article id="event-<?= $event->slug() ?>" class="timeline-event <?= $event->theme()->fromAutoID()->slug() ?>">
            <a href="<?= $event->url() ?>">
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
          <?php endforeach ?>
        </div>
      <?php endforeach ?>
    </section>
    <?php endforeach ?>
  </main>
<?php snippet('footer') ?>
