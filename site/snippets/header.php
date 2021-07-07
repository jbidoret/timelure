<!DOCTYPE html>
<html lang="<?php echo $kirby->language() ?? 'fr' ?>">
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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

  <div id="header">
    <div>
      <header >
        <h1><a href="<?= $site->url() ?>"><?= $site->title() ?></a></h1>
        <?php e($site->tagline()->isNotEmpty(), "<p>" . $site->tagline()->kti() . "</p>" ) ?>
      </header>
      
      <nav id="years-nav">
        <ul>
          <li><a href="<?= $site->url()?>#annee-1953">1953</a></li>
          <li><a href="<?= $site->url()?>#annee-1960">1960</a></li>
          <li><a href="<?= $site->url()?>#annee-1970">1970</a></li>
          <li><a href="<?= $site->url()?>#annee-1980">1980</a></li>
          <li><a href="<?= $site->url()?>#annee-1990">1990</a></li>
          <li><a href="<?= $site->url()?>#annee-2000">2000</a></li>
          <li><a href="<?= $site->url()?>#annee-2010">2010</a></li>
          <li><a href="<?= $site->url()?>#annee-2020">2020</a></li>
        </ul>
      </nav>
      <?php if($page->intendedTemplate() == "home") :?><?php endif ?>
    </div>
  </div>

    