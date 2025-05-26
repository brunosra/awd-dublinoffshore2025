<?php snippet('header') ?>
<?php snippet('pageHero') ?>
<?php foreach ($page->builder()->toBlocks() as $block): ?>
  <?= $block ?>
<?php endforeach ?>
<?php snippet('footer') ?>