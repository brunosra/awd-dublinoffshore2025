<?php snippet('header') ?>

<section class="">
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
<!-- is empty, no placeholder image -->
<?php endif ?>
</section>

<aside>
  <?php foreach ($page->tags() as $tag): ?>
    <p class="small"><?= $tag ?></p>
  <?php endforeach ?>
    <p class="small"><?= $page->published()->toDate('Y') ?></p>
    <ul class="">
      <li>
        <a width="38px" height="38px" rel="nofollow" onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?= $page->url() ?>','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)">
          <img src="<?= url('assets/images/facebook.png') ?>" width="22px" height="22px" alt="Share on Facebook"/>
        </a>
      </li>
      <li>
        <a width="38px" height="38x" href="https://x.com/intent/tweet?<?= $page->url() ?>" target="blank" rel="noopener noreferrer nofollow">
          <img src="<?= url('assets/images/twitter.png') ?>"alt="Share Page on X"/>
        </a>
      </li>
      <li>
        <a width="38x" height="38px" href="https://www.linkedin.com/shareArticle?<?= $page->url() ?>" target="blank" rel="noopener noreferrer nofollow">
          <img src="<?= url('assets/images/linkedin.png') ?>" alt="Share Page on LinkedIn"/></a>
      </li>
    </ul>
</aside>
  
<section>
<?php foreach ($page->postContent()->toBlocks() as $block): ?>
    <?= $block ?>
<?php endforeach ?>
</section>

<?php snippet('footer') ?>


<section>
  <h5><?= $page->parent()->title()->esc() ?></h5>
  <h5><a><?= $page->parent()->url() ?></a></h5>

  <?php
    $sizes = "(min-width: 1200px) 25vw,
              (min-width: 900px) 33vw,
              (min-width: 600px) 50vw,
              100vw";

    $related = $page->related()->toPages();
    foreach($related as $post): ?>
    <article>
      <a class="" href="<?= $post->url() ?>">
          <?php if ($post->cover()->isNotEmpty()): ?>
            <?php foreach ($post->cover()->toFiles() as $image): ?>
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
                    width="<?= $image->resize(430)->width() ?>"
                    height="<?//= $image->resize(500)->height() ?>">
              </picture>
            <?php endforeach ?>
          <?php else: ?>
          <!-- Hard coded location of placeholder image here  <?//= url('assets/images/#.webp') ?>-->
          <?php endif ?>
          <p class="small"><?= $post->published()->toDate('Y') ?></p>
          <?php foreach ($post->tags() as $tag): ?>
            <p class="small"><?= $tag ?></p>
          <?php endforeach ?>
          <h6 class=""><?= $post->title()->esc() ?></h6>
      </a>  
    </article>
  <?php endforeach ?>
</section>