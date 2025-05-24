<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/nav.scss'));
  $assetManager->add('js', vite()->asset('assets/js/snippets/nav.js'));
?>

<header class="header">
  <nav class="menu">
    <?php snippet('logo') ?>
    <div class="expander">
      <ul>
        <?php foreach ($site->children()->listed() as $item): ?>
          <li><a <?php e($item->isOpen(), 'aria-current="page"') ?> href="<?= $item->url() ?>"><?= $item->title()->esc() ?></a></li>
        <?php endforeach ?>
      </ul>
    </div>
    <a href="#" class="burger">
      <div id="burger1"></div>
      <div id="burger2"></div>
      <div id="burger3"></div>
    </a>
  </nav>
</header>