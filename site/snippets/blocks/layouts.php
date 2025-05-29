<!-- https://getkirby.com/docs/reference/panel/fields/layout -->

<?php foreach ($block->layout()->toLayouts() as $layout): ?>
<section class="" id="<?= $layout->id() ?>">
  <?php foreach ($layout->columns() as $column): ?>
  <div class="" style="">
    <div class="blocks">
      <?= $column->blocks() ?>
    </div>
  </div>
  <?php endforeach ?>
</section>
<?php endforeach ?>