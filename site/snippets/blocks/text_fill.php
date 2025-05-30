<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/text-fill.scss'));
  $assetManager->add('js', vite()->asset('assets/js/snippets/blocks/text-fill.js'));
?>

<section class="text-fill h3">
  <?= $block->textFill()->esc() ?>
</section>