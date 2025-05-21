<?php snippet('header') ?>

<section class="pageHero text-center light-blue-theme">
  <div class="grid-center container">
    <div class="col-6_lg-8_md-10_sm-12" data-aos="fade-up" data-aos-duration="800">
      <h3><?= $page->headline() ?></h3>
      <p class="intro"><?= $page->intro() ?></p>
    </div>
  </div>
</section>

<section class="white-theme">
  <div class="container tight-padding" data-aos="fade-up" data-aos-duration="800" data-delay="300">
    <div class="posts">
      <aside class="sidebar pb-8">
        <h3>Filter by type</h3>

         <ul class="tags">
         <li class="tag">
            <a href="<?= $page->url() ?>">All</a>
          </li>
          <?php foreach($tags as $tag): ?>
          <li class="tag">
            <a href="<?= url($page->url(), ['params' => ['tag' => urlencode($tag)]]) ?>">
              <?= html($tag) ?>
            </a>
          </li>
          <?php endforeach ?>
        </ul>
      </aside>
      <div class="postsGridArea">
        <?php foreach($articles as $article): ?>
          <article data-aos="fade-up" data-aos-duration="800">
            <a class="no-decoration" href="<?= $article->url() ?>">
              <h4 class=""><?= $article->title()->html() ?></h4>
            </a>
            <p class="date"><?= $article->published()->toDate('Y') ?></p>
            <p><?= $article->postContent()->toBlocks()->excerpt(200) ?></p>
            <a class="inlinelink" href="<?= $article->url() ?>">Read more...</a>
            <?php foreach ($article->tags() as $tag): ?>
            <span class="tag" style="float: right; margin-top: -10px"><?= $tag ?></span>
            <?php endforeach ?>
          </article>
        <?php endforeach ?>
      </div>
    </div>
    <!-- pagination -->
    <nav class="pagination">
      <?php if($pagination->hasPrevPage()): ?>
        <strong><a style="flaot:left;" href="<?= $pagination->prevPageUrl() ?>">&lsaquo; Newer posts</a></strong>
      <?php endif ?>
      <?php if($pagination->hasNextPage()): ?>
        <strong><a style="float: right;" href="<?= $pagination->nextPageUrl() ?>">Older posts &rsaquo;</a></strong>
      <?php endif ?>
    </nav>
    <!-- padgination end -->
  </div>
</section>

<?php snippet('footer') ?>
