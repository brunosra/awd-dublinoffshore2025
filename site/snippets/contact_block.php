<section class="container footer__contact">
  <div class="footer__contact-title">
    <?php if ($page->contactBlockArea()->isNotEmpty()): ?>
      <?= $block->contactBlockArea() ?>
      <?php else: ?>
    <h3>Get in touch with us today</h3>
    <? endif ?>
    <a href="mailto:<?= Str::encode($site->mainEmail()) ?>" class="h5">
      <?= Str::encode($site->mainEmail()) ?>
    </a>
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