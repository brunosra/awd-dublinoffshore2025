<section id="logo-strip" class="<?= $block->palette()->html() ?>">
<?php $logos =  $block->logos()->toFiles(); foreach($logos as $logo): ?>
  <div class=""><img src="<?= $logo->grayscale()->url() ?>" alt="<?= $logo->alt() ?>"></div>
<?php endforeach ?>
</section>