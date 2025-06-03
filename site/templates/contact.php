<?php snippet('header') ?>
<?php snippet('contact_block') ?>

<section>
  <?php $addresses = $site->addresses()->toStructure();
  foreach ($addresses as $address): ?>

    <a href="<?= $address->mapLocation()->url() ?>">
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
      <h5><?= $address->city() ?>, <?= $address->country() ?></h5>
      <h5><?= $address->postcode() ?></h5>
    </a>
  <?php endforeach ?>
</section>

<?php snippet('footer') ?>