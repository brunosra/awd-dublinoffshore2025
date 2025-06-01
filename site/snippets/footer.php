<?php
$assetManager->add('css', vite()->asset('assets/scss/snippets/footer.scss'));
$assetManager->add('js', vite()->asset('assets/js/index.js'));
?>

</main>
<footer class="footer">
  <!-- CONTACT -->
  <section class="container footer__contact">
    <div class="footer__contact-title">
      <h3>Get in touch with us today</h3>
      <h5>hello@dublinoffshore.ie</h5>
    </div>
    <form>
      <div class="footer__contact-inputs">
        <input type="text" placeholder="Full name">
        <input type="text" placeholder="Company / Organization">
        <input type="email" placeholder="Email">
        <input type="text" placeholder="Phone Number (Optional)">
        <input type="text" placeholder="Message">
      </div>

      <button class="btn-primary">Send</button>

      <p class="small footer__contact-privacy">By clicking on “Send”, you agree to our
        <a href="<?= page('privacy')->url() ?>">
          Privacy Policy
        </a>
      </p>
    </form>
  </section>

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