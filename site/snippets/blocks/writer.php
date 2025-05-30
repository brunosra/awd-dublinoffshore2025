<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/writer.scss'));
?>

<div class="writer">
  <?= $block->contentArea() ?>
</div>