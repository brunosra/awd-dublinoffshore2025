<?php snippet('header') ?>
<?php snippet('page_hero') ?>
<div class="container">
  <aside>
    <div class="post-meta">
      <ul class="tag-list">
      <?php foreach ($page->tags() as $tag): ?>
        <li>
          <a href="<?= "/updates/tag:".urlencode($tag) ?>" class="btn btn-tag btn-small">
            <?= html($tag) ?>
          </a>
        </li>
      <?php endforeach ?>
      </ul>
      <p class="small"><?= $page->published()->toDate('Y') ?></p>
    </div>
    <ul class="social-icons">
      <li>
        <a class="btn btn-blue" rel="nofollow" onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?= $page->url() ?>','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)">
          <img src="<?= vite()->asset('assets/images/icon-facebook.svg') ?>" width="14px" height="14px" alt="Share on Facebook"/>
        </a>
      </li>
      <li>
        <a class="btn btn-blue" href="https://x.com/intent/tweet?<?= $page->url() ?>" target="blank" rel="noopener noreferrer nofollow">
          <img src="<?= vite()->asset('assets/images/icon-x.svg') ?>" width="14px" height="14px" alt="Share page on X"/>
        </a>
      </li>
      <li>
        <a class="btn btn-blue" href="https://www.linkedin.com/shareArticle?<?= $page->url() ?>" target="blank" rel="noopener noreferrer nofollow">
          <img src="<?= vite()->asset('assets/images/icon-linkedin.svg') ?>" width="14px" height="14px" alt="Share page on LinkedIn"/>
        </a>
      </li>
    </ul>
  </aside>
    
  <section class="post-content">
  <?php foreach ($page->postContent()->toBlocks() as $block): ?>
      <?= $block ?>
  <?php endforeach ?>
  </section>
</div>

<?php snippet('footer') ?>