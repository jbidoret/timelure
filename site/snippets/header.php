<!DOCTYPE html>
<html lang="<?php echo $kirby->language() ?? 'fr' ?>">
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <script>document.getElementsByTagName('html')[0].className = 'js'</script>
  
  <?php snippet("header.metas") ?>

  <?php
    if ( option('environment') == 'local' ) :
      foreach ( option('basic-devkit.assets.styles', array()) as $style):
        echo css($style.'?version='.md5(uniqid(rand(), true)));
      endforeach;
    else:
      echo css('assets/production/all.min.css');
    endif
  ?>

  <style>
<?php $i=1; foreach(page('themes')->children() as $theme):?>
  .year span:nth-of-type(<?= $i ?>),
  .<?= $theme->slug() ?> .event h3,
  .<?= $theme->slug() ?> {
    --color: <?= $theme->color() ?>;
  }
<?php $i++; endforeach ?>

  </style>

</head>
<body
   data-login="<?php e($kirby->user(),'true', 'false') ?>"
   data-template="<?php echo $page->template() ?>"
   data-intended-template="<?php echo $page->intendedTemplate() ?>">

  <header id="header">
    <h1><a href="<?= $site->url() ?>"><?= $site->title() ?></a></h1>
    <?php e($site->tagline()->isNotEmpty(), "<p>" . $site->tagline()->kti() . "</p>" ) ?>
  </header>