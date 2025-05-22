<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= $site->title()->esc() ?> | <?= $page->title()->esc() ?></title>

  <?php
    $template = $page->template();
  ?>
  <?= vite([
    'assets/scss/index.scss',
    '@assets/scss/templates/'.$template.'.scss',
  ]) ?>
  <link rel="shortcut icon" type="image/x-icon" href="">
  <?php snippet('seo/head'); ?>
  <?= $site->googleAnalytics() ?>
  <?= $site->headerInjection() ?>

</head>
<body class="page-<?= $template ?><?= $template != "home" ? " not-home" : "" ?>">
  <header class="header">
    <?php if ($logo = $site->logo()->toFile()): ?>
    <a class="" href="<?= $site->url() ?>">
      <img class="" src="<?= $logo->url() ?>" alt="<?= $logo->alt() ?>" width="106" height="32"/>
    </a>
    <?php endif ?>

    <nav class="menu">
      <?php foreach ($site->children()->listed() as $item): ?>
      <a <?php e($item->isOpen(), 'aria-current="page"') ?> href="<?= $item->url() ?>"><?= $item->title()->esc() ?></a>
      <?php endforeach ?>
    </nav>
  </header>

  <main class="main">
