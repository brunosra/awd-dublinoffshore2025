<?php

use Kirby\Toolkit\Str;

$assetManager->add('css', vite()->asset('assets/scss/snippets/contact_block.scss'));
$template = $page->intendedTemplate()->name();
?>

<section class="contact-block <?= $template === 'contact' ? 'contact-page' : '' ?>">
  <div class="container contact-block__container">
    <div class="contact-block__title">
      <?php if ($page->contactBlockArea()->isNotEmpty()): ?>
        <?= $block->contactBlockArea() ?>
      <?php else: ?>
        <h3>Get in touch with us today</h3>
      <?php endif; ?>
      <a href="mailto:<?= Str::encode($site->mainEmail()) ?>" class="h5">
        <?= Str::encode($site->mainEmail()) ?>
      </a>
    </div>
    <form>
      <div class="contact-block__inputs">
        <input type="text" placeholder="Full name">
        <input type="text" placeholder="Company / Organization">
        <input type="email" placeholder="Email">
        <input type="text" placeholder="Phone Number (Optional)">
        <input type="text" placeholder="Message">
      </div>

      <button class="btn-primary">Send</button>

      <p class="small contact-block__privacy">By clicking on "Send", you agree to our
        <a href="<?= page('privacy')->url() ?>">
          Privacy Policy
        </a>
      </p>
    </form>
  </div>
</section>