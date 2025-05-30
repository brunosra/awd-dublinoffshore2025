<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/nav.scss'));
  $assetManager->add('js', vite()->asset('assets/js/snippets/nav.js'));
?>

<?php $items = $pages->listed(); ?>

<header class="header">
  <nav class="menu">
    <?php snippet('logo') ?>
    <div class="expander">
      <ul>
        <?php foreach($items as $item): ?>
          <?php $children = $item->children()->listed(); ?>
          <li class="<?php if($children->isNotEmpty()){ echo ' has-children'; } ?>">
            <a<?php e($item->isActive(), ' aria-current="page"') ?> href="<?php if($children->isNotEmpty()){ echo '#'; }else{ echo $item->url(); } ?>"><?= $item->title()->html() ?></a>
            <?php if($children->isNotEmpty()): ?>
              <div class="expander-sub">
                <ul>
                  <?php foreach($children as $child): ?>
                  <li>
                    <a<?php e($child->isActive(), ' aria-current="page"') ?> href="<?= $child->url() ?>">
                      <?= $child->title()->html() ?>
                    </a>
                  </li>
                  <?php endforeach ?>
                </ul>
              </div>
            <?php endif ?>
          </li>
        <?php endforeach ?>
      </ul>
    </div>
    <a href="#" class="burger">
      <div id="burger1"></div>
      <div id="burger2"></div>
      <div id="burger3"></div>
    </a>
  </nav>
</header>