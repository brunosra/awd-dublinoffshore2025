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
<?php snippet('nav'); ?>
<main class="main">
