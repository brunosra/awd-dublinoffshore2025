<?php snippet('header') ?>

<section class="pageHero text-center light-blue-theme">
  <div class="grid-center container">
      <div class="col-6" data-aos="fade-up" data-aos-duration="800">
        <h3><?= $page->headline()->html() ?></h3>
      </div>
  </div>
</section>  

<section class="tight-padding">

<div class="grid-center container">
      <div class="col-7" data-aos="fade-up" data-aos-duration="800" data-delay="300">
      <?= $page->legaltext()->kt() ?>
      </div>
  </div>

<?php snippet('footer') ?>

