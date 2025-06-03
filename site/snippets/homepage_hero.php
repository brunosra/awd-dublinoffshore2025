<?php
$template = $page->intendedTemplate()->name();
$assetManager->add('css', vite()->asset('assets/scss/snippets/homepage-hero.scss'));
?>


<?php if ($file = $page->background()->toFile()): ?>
  <?php if ($file->type() === 'image'): ?>


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

  <?php endif ?>
  <?php if ($file->type() === 'video'): ?>
    <video autoplay playsinline prelaod muted loop><source src="<?= $file->url() ?>" alt="<?= $file->alt() ?>" type="video/mp4"></video>
  <?php endif ?>

  <h1><?=  $page->heading() ?></h1>
  <!-- Thumbnail -->
  <?php if($image = $page->thumbnail()->toFile()): ?>
    <img src="<?= $image->resize(472)->url() ?>" alt="">
  <?php endif ?>
  <div>
  <p class="small">WATCH VIDEO</p>
  </div>
<?php endif ?>

</section>