<?php snippet('header') ?>
  <?php foreach ($page->builder()->toBlocks() as $block): ?>
  <?= $block ?>
<?php endforeach ?>
<?php snippet('footer') ?>
