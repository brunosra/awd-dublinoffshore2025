<?php foreach ($field->toLayouts() as $layout): ?>
<section class="grid margin-xl" id="<?= esc($layout->id(), 'attr') ?>" style="--gutter: 1.5rem">
  <?php foreach ($layout->columns() as $column): ?>
  <div class="column" style="--columns:<?= esc($column->span(), 'css') ?>">
    <div class="text">
      <?= $column->blocks() ?>
    </div>
  </div>
  <?php endforeach ?>
</section>
<?php endforeach ?>
