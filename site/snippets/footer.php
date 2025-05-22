</main>
<footer>
  <?php if ($logo = $site->logo()->toFile()): ?>
  <a class="" href="<?= $site->url() ?>">
    <img class="" src="<?= $logo->url() ?>" alt="<?= $logo->alt() ?>" width="106" height="32"/>
  </a>
  <?php endif ?>

  <?php
  $addresses = $site->addresses()->toStructure();
  foreach ($addresses as $address): ?>
  <div>
    <p class="small"><?= $address->country()->esc() ?></p>
    <p class="small"><?= $address->streetAddress()->esc() ?></p>
    <p class="small"><?= $address->city()->esc() ?>,&nbsp;<?= $address->postcode()->esc() ?></p>
  </div>
  <?php endforeach ?>

  <div class="">
        <a class="" href="<?= $site->twitterLink()->url() ?>" target="_blank" rel="noopener nofollow"><img class="" src="<?= url('assets/images/#') ?>" alt="Twitter"></a>
        <a class="" href="<?= $site->linkedinLink()->url() ?>" target="_blank" rel="noopener nofollow" ><img class="" src="<?= url('assets/images/#') ?>" alt="LinkedIn"></a> 
  </div>
  <div class="" >
    <p class="small">© <?= date("Y"); ?> — All rights reserved — <a href="https://anywherestudio.ie" target="_blank" rel="noopener nofollow" >Site&nbsp;Credits </a></p>
  </div>
  <div >
    <ul>
      <li><a href="<?= page('privacy')->url() ?>"><p class="small">Privacy</p></a></li>
      <li><a href="<?= page('terms-and-conditions')->url() ?>"><p class="small">Terms & Conditions</p></a></li>
    </ul>   
  </div>
</footer>

<?= $site->footerInjection() ?>
<?php snippet('seo/schemas'); ?>
</body>
</html>