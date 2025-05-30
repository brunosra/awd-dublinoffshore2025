<?php snippet('header') ?>
<?php snippet('page_hero') ?>
<?php foreach ($page->builder()->toBlocks() as $block): ?>
  <?= $block ?>
<?php endforeach ?>
<?php snippet('footer') ?>