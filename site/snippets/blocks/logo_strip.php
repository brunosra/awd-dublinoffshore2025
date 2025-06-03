<?php
$assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/logo-strip.scss'));
$assetManager->add('js', vite()->asset('assets/js/snippets/blocks/logo-strip.js'), ['type' => 'module']);
?>

<section class="logo-strip">
  <div class="container logo-strip__container">
    <div class="logo-strip__fade logo-strip__fade-start"></div>
    <div class="logo-strip__fade logo-strip__fade-end"></div>
    <div class="logo-strip__logos">
      <?php $logos =  $site->logos()->toFiles();
      foreach ($logos as $logo): ?>
        <img src="<?= $logo->url() ?>" alt="<?= $logo->alt() ?>">
      <?php endforeach ?>
    </div>
  </div>
</section>