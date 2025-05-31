<?php
$assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/team.scss'));
?>

<section class="team">
  <div class="team__container container">
    <h2><?= $block->heading()->esc() ?></h2>
    <div class="team__members">
      <?php $members = $block->teamMembers()->toStructure();
      foreach ($members as $member): ?>
        <article class="team__member">
          <?php foreach ($member->image()->toFiles() as $image): ?>
            <?php
            $sizes = "(min-width: 1200px) 50vw,
                  (min-width: 900px) 33vw,
                  (min-width: 600px) 50vw,
                  100vw";
            ?>
            <picture>
              <source srcset="<?= $image->srcset('webp') ?>" sizes="<?= $sizes ?>" type="image/webp">
              <img
                alt="<?= $image->alt() ?>"
                data-src="<?= $image->resize(300)->url() ?>"
                data-srcset="<?= $image->srcset() ?>"
                sizes="<?= $sizes ?>"
                width="<?= $image->resize(346)->width() ?>"
                height="<? //= $image->resize(500)->height() 
                        ?>">
            </picture>
          <?php endforeach ?>
          <div class="team__member-info">
            <h6><?= $member->memberName() ?></h6>
            <p class="small"><?= $member->position() ?></p>
          </div>
          <p class="small"><?= $member->bio() ?></p>
        </article>
      <?php endforeach ?>
    </div>
  </div>
</section>