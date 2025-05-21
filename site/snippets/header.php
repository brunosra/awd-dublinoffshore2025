<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title><?= $page->meta_title()->or($page->title()) ?> - <?= $site->title() ?></title>
    <link rel="canonical" href="<?= html($page->url()) ?>" />
    <?php if ($favicon = $site->favicon()->toFile()): ?>
      <link rel="shortcut icon" href="<?= $favicon->url() ?>" >
    <?php endif ?>
    <?php snippet('seo/head'); ?>
    <?= $site->googleAnalytics() ?>
    
    <?= css(['assets/css/styles.css','assets/css/aos.css']) ?>
    <?= css('@auto') ?>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2.2.1/dist/flickity.min.css">
    <link rel="stylesheet" href="https://use.typekit.net/mdu3cgi.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>"/>
    <script src="https://unpkg.com/scroll-out/dist/scroll-out.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>

    <!-- needed for timelines -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- END needed for timelines -->
    <!-- Include Plotly.js library -->
    <script src="https://cdn.plot.ly/plotly-2.31.1.min.js" charset="utf-8"></script>
    
    <?= $site->headerInjection() ?>
  </head>

  <body class="<?= $page->slug() ?>">
    <nav class="navbar" data-scroll>
      <span class="navbar-toggle" id="js-navbar-toggle">
        <i class="fas fa-bars"></i>
      </span>
      <div>
        <?php if ($colorLogo = $site->colorLogo()->toFile()): ?>
        <a class="logo" href="<?= $site->url() ?>">
          <img class="logoimg" src="<?= $colorLogo->url() ?>" alt="<?= $colorLogo->alt() ?>"/>
        </a>
        <?php endif ?>
        <ul class="main-nav" id="js-menu">
          <?php foreach ($site->children()->listed() as $item): ?>
          <li>
            <a class="nav-links" <?php e($item->isOpen(), 'aria-current ') ?> href="<?= $item->url() ?>"><?= $item->title()->html()?></a>
          </li>
          <?php endforeach ?>

        </ul>
      </div>
    </nav>

    <main class="page">