<?php
$template = $page->intendedTemplate()->name();
$assetManager->add('css', vite()->asset('assets/scss/snippets/pageHero.scss'));
?>

<section class="page-hero<?= " ".$template ?>"> 

<?php if ($template === 'updates'): ?>
  <h1><?= $page->title()->html() ?></h1>

<?php elseif ($template === 'post'): ?>
  <h5><?= $page->parent()->title()->esc() ?></h5>
  <h1><?= $page->title()->html() ?></h1>

  <?php if ($page->cover()->isNotEmpty()): ?>
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
    <!-- no placeholder image -->
  <?php endif ?>

<?php else: ?>
  <?php if ($page->background()->isNotEmpty()): ?>
    <?php foreach ($page->background()->toFiles() as $image): ?>
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
          width="<?//= $image->resize(310)->width() ?>"
          height="<?//= $image->resize(500)->height() ?>">
      </picture>
    <?php endforeach ?>
  <?php else: ?>
    <!-- no background image -->
  <?php endif ?>
  <?php if ($page->heading()->isNotEmpty()): ?> 
    <h1><?= $page->heading()?></h1>
  <?php else: ?>
    <h1><?= $page->title()?></h1>
  <?php endif ?>

<?php endif ?>

</section>