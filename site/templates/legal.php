<?php snippet('header') ?>
<?php snippet('page_hero') ?>

<section class="legal">
  <div class="container legal__container">
    <div class="legal__content">
      <?= $page->legaltext()->kt() ?>
    </div>
  </div>
</section>

<?php snippet('footer') ?>