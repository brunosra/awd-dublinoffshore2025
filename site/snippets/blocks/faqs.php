<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/faqs.scss'));
  $assetManager->add('js', vite()->asset('assets/js/snippets/blocks/faqs.js'));
?>

<section class="faqs">
  <div class="container">
    <?php
      $items = $block->faqs()->toStructure();
      foreach ($items as $item): ?>
        <div class="item">
          <div class="question">
            <h5><?= $item->question() ?></h5>
            <a href="#" class="plus">
              <div id="plus1"></div>
              <div id="plus2"></div>
            </a>
          </div>
          <div class="answer h6">
            <div class="content">
              <?= $item->answer()->kt() ?>
            </div>
          </div>
        </div>
        <hr />
      <?php endforeach ?>
  </div>
</section>
