<?php snippet('header') ?>
<?php snippet('page_hero') ?>
<section class="main-content">
  <?php foreach ($page->builder()->toBlocks() as $block): ?>
    <?= $block ?>
  <?php endforeach ?>
</section>

<?php snippet('footer') ?>