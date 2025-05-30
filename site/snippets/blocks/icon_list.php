<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/icon-list.scss'));
?>

<div class="icon-list">
<?php $icons = $block->iconList()->toStructure(); foreach ($icons as $icon): ?>
  <?php foreach ($icon->icon()->toFiles() as $image): ?>
  <img src="<?= $image->url() ?>">
  <?php endforeach ?>
  <h6><?= $icon->description() ?></h6>
<?php endforeach ?>
</div>