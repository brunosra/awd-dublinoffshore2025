<section class="">
  <?php if ($page->parent('updates')): ?>
  <h5><?= $page->parent()->title()->esc() ?></h5>
  <?php endif ?>
  <h1><?= $page->title()->html() ?></h1>
  <?php if ($page->parent('updates') && $page->cover()->isNotEmpty()): ?>
  <?php foreach ($page->cover()->toFiles() as $image): ?>
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
          width="<?= $image->resize(310)->width() ?>"
          height="<?//= $image->resize(500)->height() ?>">
    </picture>
  <?php endforeach ?>
<?php else: ?>
<!-- is empty, no placeholder image -->
<?php endif ?>
</section>