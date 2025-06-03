<section class="">
  <h2><?= $block->heading()->esc() ?></h2>
  <?php
  $addresses = $site->addresses()->toStructure();
  foreach ($addresses as $address): ?>
    <a class="" href="<?= $address->mapLocation()->url() ?>" target="_blank" rel="noopener nofollow">
      <div>
        <?php foreach ($address->image()->toFiles() as $image): ?>
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
              width="<?= $image->resize(456)->width() ?>"
              height="<? //= $image->resize(500)->height() 
                      ?>">
          </picture>
        <?php endforeach ?>
        <p class="small"><?= $address->city()->esc() ?>,&nbsp;<?= $address->country()->esc() ?></p>
        <p class="small"><?= $address->postcode()->esc() ?></p>
      </div>
    </a>
  <?php endforeach ?>
</section>