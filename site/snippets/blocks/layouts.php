<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/layouts.scss'));
?>

<!-- https://getkirby.com/docs/reference/panel/fields/layout -->

<?php foreach ($block->layout()->toLayouts() as $layout): ?>
<section class="layouts<?= $layout->paddingTop() ? '' : ' no-padding-top' ?><?= $layout->paddingBottom() ? '' : ' no-padding-bottom' ?>" id="<?= $layout->id() ?>">
  <div class="container">
    <?php foreach ($layout->columns() as $column): ?>
    <div class="blocks">
      <?= $column->blocks() ?>
    </div>
    <?php endforeach ?>
  </div>
</section>
<?php endforeach ?>