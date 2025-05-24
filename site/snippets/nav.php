<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/nav.scss'));
?>

<header class="header">
  <nav class="menu">
    <?php snippet('logo') ?>
    <ul>
      <?php foreach ($site->children()->listed() as $item): ?>
        <li><a <?php e($item->isOpen(), 'aria-current="page"') ?> href="<?= $item->url() ?>"><?= $item->title()->esc() ?></a></li>
      <?php endforeach ?>
      </ul>
  </nav>
</header>