<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/icon-list.scss'));
?>

<div class="icon-list">
<?php $icons = $block->iconList()->toStructure(); foreach ($icons as $icon): ?>
  <div class="icon-list-item">
    <?php foreach ($icon->icon()->toFiles() as $image): ?>
    <img src="<?= $image->url() ?>">
    <?php endforeach ?>
    <p class="h6"><?= $icon->description() ?></p>
  </div>
<?php endforeach ?>
</div>