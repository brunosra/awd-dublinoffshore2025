<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/full-width-video.scss'));
?>

<section class="full-width-video">

  <?= $block->textOverlay() ?>

  <?php
  use Kirby\Cms\Html;

  /** @var \Kirby\Cms\Block $block */

  if (
      $block->location() == 'kirby' &&
      $video = $block->video()->toFile()
  ) {
      $url   = $video->url();
      $attrs = array_filter([
          'autoplay'    => $block->autoplay()->toBool(true),
          'controls'    => $block->controls()->toBool(false),
          'loop'        => $block->loop()->toBool(true),
          'muted'       => $block->muted()->toBool(true) || $block->autoplay()->toBool(true),
          'playsinline' => $block->autoplay()->toBool(true),
          'poster'      => $block->poster()->toFile()?->url(),
          'preload'     => $block->preload()->value(true),
      ]);
  } else {
      $url = $block->url();
  }
  ?>
  <?php if ($video = Html::video($url, [], $attrs ?? [])): ?>
  <figure>
    <?= $video ?>
  </figure>
  <?php endif ?>
</section>  