<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/page-grid.scss'));
?>

<section class="">
  <?= $block->contentArea() ?>

  <?php $linkedPages = $block->linkedPages()->toStructure(); foreach ($linkedPages as $linkedPage): ?>
      <?php foreach ($linkedPage->page()->toPages() as $servicePage): ?>
        <a href="<?= $servicePage->url() ?>">
          <h4><?= $servicePage->title() ?></h4>
          <?= $servicePage->details() ?>
      </a>
      <?php endforeach ?>
  <?php endforeach ?>

  <?php foreach ($block->background()->toFiles() as $image): ?>
    <?php
    $sizes = "(min-width: 1200px) 50vw,
              (min-width: 900px) 33vw,
              (min-width: 600px) 50vw,
              100vw";
    ?>
    <picture>
      <source srcset="<?= $image->srcset('webp') ?>" sizes="<?= $sizes ?>" type="image/webp">
      <img
          class=""
          alt="<?= $image->alt() ?>"
          data-src="<?= $image->resize(300)->url() ?>"
          data-srcset="<?= $image->srcset() ?>"
          sizes="<?= $sizes ?>"
          width="<?= $image->resize(346)->width() ?>"
          height="<?//= $image->resize(500)->height() ?>">
    </picture>
  <?php endforeach ?>

</section>