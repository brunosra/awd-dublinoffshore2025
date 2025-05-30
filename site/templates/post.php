<?php snippet('header') ?>
<?php snippet('page_hero') ?>
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