<?php snippet('header') ?>

<section class="postTitle container">
  <div class="grid-spaceBetween">
    <div class="col">
      <h4>Updates</h4>
    </div>
    <div class="col">
      <a href="<?= $page->parent()->url() ?>" class="inlinelink align-text-bottom">&larr; Back to Updates</a>
    </div>
  </div>
</section>

<section>
  
  <div class="container tight-padding">
    <div class="post">
      <div class="sidebar">
        <h4><?= $page->title() ?></h4>
        <div class="col-12 data">
          <?php foreach ($page->tags() as $tag): ?>
          <p class="tag"><?= $tag ?></p>
          <?php endforeach ?>
          <p class="date"><?= $page->published()->toDate('Y') ?></p>
          <hr />
          <p>Share</p>
          <ul class="social-share">
            <li>
              <a width="24px" height="24px" rel="nofollow" onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?= $page->url() ?>','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)">
                <img src="<?= url('assets/images/facebook.png') ?>" width="22px" height="22px" alt="Share on Facebook"/>
              </a>
            </li>
            <li>
              <a width="24px" height="20px" href="https://twitter.com/intent/tweet?<?= $page->url() ?>" target="blank" rel="noopener noreferrer nofollow">
                <img src="<?= url('assets/images/twitter.png') ?>"alt="Share Page on Twitter"/>
              </a>
            </li>
            <li>
              <a width="24px" height="24px" href="https://www.linkedin.com/shareArticle?<?= $page->url() ?>" target="blank" rel="noopener noreferrer nofollow">
                <img src="<?= url('assets/images/linkedin.png') ?>" alt="Share Page on LinkedIn"/></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="main responsive">
        <?php foreach ($page->postContent()->toBlocks() as $block): ?>
        <div class="block">
          <?= $block ?>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>

</section>

<?php snippet('footer') ?>
