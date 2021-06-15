<?php snippet('header') ?>
  <main>
    <article class="event-detail <?= $page->theme()->fromAutoID()->slug() ?>">
      <header>
        <h2><?= $page->year()->html() ?></h2>
        <h1><?= $page->title()->html() ?></h1>
      </header>
      <div class="event-text">
        <?php if($page->introduction()->isNotEmpty()) :?>
          <div class="introduction">
            <?= $page->introduction()->kt()?>
          </div>
        <?php endif ?>

        <?php if($page->text()->isNotEmpty()) :?>
          <div class="text">
            <?= $page->text()->kt()?>
          </div>
        <?php endif ?>
      </div>

      <?php if($page->details()->isNotEmpty()) :?>
        <aside class="event-details">
          <?= $page->details()->kt()?>
        </aside>
      <?php endif ?>
    
    </article>



    <?php
    $gallery = $page->gallery()->filter(function($image) use($page){
      return $image != $page->cover()->toFile();
    })->sortBy('sort')->toFiles();
     if($gallery->count()) :?>
      <div class="gallery">
        <?php foreach($gallery as $image) : ?>     
        <figure class="<?= $image->layout() ?>">
          <a href="<?= $image->url() ?>">
            <img loading="lazy" width="<?= $image->width() ?>" height="<?= $image->height() ?>" src="<?= $image->thumb('listitem')->url()?>" alt="<?= $image->alt()?>" srcset="<?= $image->srcset('default')?>">
          </a>
          <?php if($image->caption()->isNotEmpty()) :?>
            <figcaption>
              <?= $image->caption()->kt()?>
            </figcaption>
          <?php endif ?>
        </figure>
        <?php endforeach ?>
      </div>
    <?php endif ?>

  </main>
<?php snippet('footer') ?>
