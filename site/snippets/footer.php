<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/footer.scss'));
  $assetManager->add('js', vite()->asset('assets/js/index.js'));
?>

</main>
<footer>
  <?php if ($logo = $site->logo()->toFile()): ?>
  <a class="" href="<?= $site->url() ?>">
    <img class="" src="<?= $logo->url() ?>" alt="<?= $logo->alt() ?>" width="106" height="32">
  </a>
  <?php endif ?>

  <?php
  $addresses = $site->addresses()->toStructure();
  foreach ($addresses as $address): ?>
  <address>
    <p class="small">
      <?= $address->country()->esc() ?><br>
      <?= $address->streetAddress()->esc() ?><br>
      <?= $address->city()->esc() ?>,&nbsp;<?= $address->postcode()->esc() ?>
    </p>
  </address>
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
<?php
  $template = $page->template();
?>
<?= vite([
  '@assets/js/templates/'.$template.'.js',
]); ?>
<?php snippet('seo/schemas'); ?>
</body>
</html>