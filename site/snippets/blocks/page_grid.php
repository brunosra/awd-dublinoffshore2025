<?php
$assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/page-grid.scss'));

$image = $block->background()->toFiles()->first();
$backgroundUrl = $image ? $image->url() : '';
?>

<section class="page-grid" style="background-image: url('<?= $backgroundUrl ?>');">
  <div class="container page-grid__container">
    <header class="page-grid__header">
      <?= $block->contentArea() ?>
    </header>
    <div class="page-grid__list">
      <?php $linkedPages = $block->linkedPages()->toStructure();
      foreach ($linkedPages as $linkedPage): ?>
        <?php foreach ($linkedPage->page()->toPages() as $servicePage): ?>
          <a href="<?= $servicePage->url() ?>" class="page-grid__card">
            <h4><?= $servicePage->title() ?></h4>
            <div class="page-grid__card-content">
              <div class="page-grid__card-paragraphs">
                <?= $servicePage->details() ?>
                <!-- TEMP: should be removed later -->
                <p>Client representation</p>
                <p>Technical oversight and support</p>
                <p>Quality assurance and control</p>
                <p>Health, Safety, and Environmental (HSE) management​</p>
              </div>
              <span class="page-grid__card-arrow"><img src="<?= vite()->asset('assets/images/arrow.svg') ?>" alt="Read More" width="10" height="10"></span>
            </div>
          </a>
        <?php endforeach ?>
      <?php endforeach ?>
    </div>
  </div>
</section>