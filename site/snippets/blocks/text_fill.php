<?php
$assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/text-fill.scss'));
$assetManager->add('js', vite()->asset('assets/js/snippets/blocks/text-fill.js'), ['type' => 'module']);
?>

<section class="text-fill">
  <div class="container text-fill__container">
    <div class="text-fill__content">
      <h3><?= $block->textFill() ?></h3>
    </div>
  </div>
</section>