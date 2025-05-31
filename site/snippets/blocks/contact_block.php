<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/writer.scss'));
?>

<div class="writer">
  <?= $block->contentArea()->kt() ?>
</div>

<div>
    <?php snippet('dreamform/form', ['form' => $block->form()->toPage()]); ?>
</div>