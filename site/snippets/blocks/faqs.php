<section>
  <?php
    $items = $block->faqs()->toStructure();
    foreach ($items as $item): ?>
      <div class="item">
      <div class="question">
        <h4><?= $item->question() ?></h4>
        <div class="plusminus"></div>
      </div>
      <div class="answer">
        <?= $item->answer()->kt() ?>
      </div>
      </div>
    <?php endforeach ?>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const faqs = document.querySelectorAll('.item');

    faqs.forEach(faq => {
      const question = faq.querySelector('.question');

      question.addEventListener('click', () => {
        faq.classList.toggle('active');
      });
    });
  });
</script>
