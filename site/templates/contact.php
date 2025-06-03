<?php snippet('header') ?>
<?php snippet('contact_block') ?>

<section class="contact__offices">
  <div class="container contact__offices-container">
    <h2 class="contact__offices-heading">Our offices</h2>
    <ul class="contact__offices-list">
      <?php
      $addresses = $site->addresses()->toStructure();
      foreach ($addresses as $address): ?>
        <li class="contact__offices-item">
          <a class="" href="<?= $address->mapLocation()->url() ?>" target="_blank" rel="noopener nofollow">
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
            <div class="contact__offices-item-content">
              <h6 class="small"><?= $address->city()->esc() ?>,&nbsp;<?= $address->country()->esc() ?></h6>
              <h6 class="small"><?= $address->postcode()->esc() ?></h6>
            </div>
          </a>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
</section>

<?php snippet('footer') ?>