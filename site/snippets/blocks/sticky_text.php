<section class="">
  <div>
  <?= $block->textArea() ?>
  </div>

  <?php $contentBlocks = $block->contentBlock()->toStructure(); foreach ($contentBlocks as $contentBlock): ?>
  <article class="">
    <?php if ($contentBlock->icon()->isNotEmpty()): ?>
    <div>
      <?= svg('/assets/icons/' . $page->icon()) ?>
    </div>
    <?php endif ?>
    <div>
    <?php if ($contentBlock->heading()->isNotEmpty()): ?>
    <div>
      <?= $contentBlock->heading() ?>
    </div>
    <?php endif ?>
      <?= $contentBlock->contentArea() ?>
    </div>
  </article> 
  <?php endforeach ?>


</section>