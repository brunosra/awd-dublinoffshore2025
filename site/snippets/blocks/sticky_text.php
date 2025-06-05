<?php
$assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/sticky-text.scss'));
?>

<section class="sticky-text">
  <div class="sticky-text__container container">
    <div class="sticky-text__content">
      <?= $block->textArea() ?>
    </div>
    <div class="sticky-text__articles">
      <?php $contentBlocks = $block->contentBlock()->toStructure();
      foreach ($contentBlocks as $contentBlock): ?>
        <article class="sticky-text__article">
          <?php if ($contentBlock->icon()->isNotEmpty()): ?>
            <span class="sticky-text__article-icon">
              <?php foreach ($contentBlock->icon()->toFiles() as $image): ?>
                <img src="<?= $image->url() ?>">
              <?php endforeach ?>
            </span>
          <?php endif ?>

          <div class="sticky-text__article-content">
            <?php if ($contentBlock->heading()->isNotEmpty()): ?>
              <h3>
                <?= strip_tags($contentBlock->heading()) ?>
              </h3>
            <?php endif ?>
            <?= $contentBlock->contentArea() ?>
          </div>
        </article>
      <?php endforeach ?>
    </div>
  </div>
</section>