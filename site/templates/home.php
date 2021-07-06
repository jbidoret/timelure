<?php snippet('header') ?>

  
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
      <?php foreach($themes as $theme => $events) :
        $mytheme = autoid($theme); ?>
        <div class="events <?= $mytheme->slug() ?>">
          <?php foreach($events as $event) : ?> 
            <?php snippet("block-" . $event->intendedTemplate(), ['event'=>$event])?>
          <?php endforeach ?>
        </div>
        
      <?php endforeach ?>
    </section>
    <div id="annee-<?= $year->slug() ?>-content" class="year-content"></div>
    <?php endforeach ?>
  </main>
<?php snippet('footer') ?>
