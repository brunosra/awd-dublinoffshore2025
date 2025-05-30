<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/logo-strip.scss'));
?>

<section class="logo-strip">
<?php $logos =  $site->logos()->toFiles(); foreach($logos as $logo): ?>
  <div class=""><img src="<?= $logo->url() ?>" alt="<?= $logo->alt() ?>"></div>
<?php endforeach ?>
</section>