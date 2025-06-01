<?php
$assetManager->add('css', vite()->asset('assets/scss/snippets/footer.scss'));
$assetManager->add('js', vite()->asset('assets/js/index.js'));
$template = $page->intendedTemplate()->name();
?>

</main>
<footer class="footer">
  <?php if ($template !== 'contact'): ?>
  <?php snippet('contact_block') ?>
  <?php endif ?>

  <!-- WAVE -->
  <div class="footer__wave"></div>

  <!-- ADDRESSES -->
  <section class="container footer__addresses">
    <?php snippet('logo') ?>
    <div class="footer__addresses-list">
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
    </div>
  </section>

  <!-- LINKS -->
  <section class="container footer__links">
    <div class="footer__social">
      <a class="" href="<?= $site->twitterLink()->url() ?>" target="_blank" rel="noopener nofollow"><img class="" src="<?= vite()->asset('assets/images/icon-x.svg') ?>" alt="Twitter"></a>
      <a class="" href="<?= $site->linkedinLink()->url() ?>" target="_blank" rel="noopener nofollow"><img class="" src="<?= vite()->asset('assets/images/icon-linkedin.svg') ?>" alt="LinkedIn"></a>
    </div>
    <div class="footer__copyright">
      <p class="small">© <?= date("Y"); ?> — All rights reserved — <a href="https://anywherestudio.ie" target="_blank" rel="noopener nofollow">Site&nbsp;Credits </a></p>
    </div>
    <div class="footer__legal">
      <ul>
        <li>
          <a href="<?= page('privacy')->url() ?>">
            <p class="small">Privacy</p>
          </a>
        </li>
        <li>
          <a href="<?= page('terms-and-conditions')->url() ?>">
            <p class="small">Terms & Conditions</p>
          </a>
        </li>
      </ul>
    </div>
  </section>
  
</footer>

<?= $site->footerInjection() ?>
<?php
$template = $page->template();
?>
<?= vite([
  '@assets/js/templates/' . $template . '.js',
]); ?>
<?php snippet('seo/schemas'); ?>
</body>

</html>