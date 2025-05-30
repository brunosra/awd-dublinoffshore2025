<section id="logo-strip" class="">
<?php $logos =  $site->logos()->toFiles(); foreach($logos as $logo): ?>
  <div class=""><img src="<?= $logo->url() ?>" alt="<?= $logo->alt() ?>"></div>
<?php endforeach ?>
</section>