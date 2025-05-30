<?php snippet('header') ?>
<?php snippet('pageHero') ?>
  <div class="container">
    <div style="grid-column: 1 / 13;">
      <h1 style="margin: 2rem 0;">Design System</h1>
      <h2 class="h3" style="margin: 1rem 0;">Typography</h2>
      <h1>Heading 1</h1>
      <h2>Heading 2</h2>
      <h3>Heading 3</h3>
      <h4>Heading 4</h4>
      <h5>Heading 5</h5>
      <h6>Heading 6</h6>
      <p>Paragraph</p>
      <p class="small">small</p>
      <p class="nav">nav</p>
      <hr style="margin: 1rem 0;">
    </div>
    <div style="grid-column: 1 / 13;">  
      <h2 class="h3" style="margin: 1rem 0;">Lists</h2>
      <ul>
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3 - <a href="#">Lorem ipsum dolor sit amet</a>, consectetur adipiscing elit. Nam a placerat orci. Vivamus dictum mi vel sapien accumsan, in finibus lacus faucibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla eget pellentesque justo, ac tempus erat. Maecenas placerat lorem ut risus ullamcorper consectetur. Aenean venenatis sapien in nunc maximus venenatis. Quisque vel porta elit, vitae viverra purus.</li>
        <li>Item 4</li>
        <li>Item 5</li>
      </ul>
      
      <hr style="margin: 1rem 0;">
    </div>
    <div style="grid-column: 1 / 13;">
      <h2 class="h3" style="margin: 1rem 0;">Buttons</h2>
    </div>
    <div style="grid-column: 1 / 4; margin-bottom: 2rem;">
      <a href="#" class="btn btn-primary">Primary Button</a><br>
      <a href="#" class="btn btn-primary btn-small">Primary Button</a>
    </div>
    <div style="grid-column: 4 / 7; margin-bottom: 2rem;">
      <a href="#" class="btn btn-ghost">Ghost Button</a><br>
      <a href="#" class="btn btn-ghost btn-small">Ghost Button</a>
    </div>
    <div style="grid-column: 7 / 10; margin-bottom: 2rem;">
      <a href="#" class="btn btn-tag">Tag Button</a><br>
      <a href="#" class="btn btn-tag btn-small">Tag Button</a>
    </div>
    <div style="grid-column: 10 / 13; margin-bottom: 2rem;">
      <a href="#" class="btn btn-invisible">Invisible Button</a><br>
      <a href="#" class="btn btn-invisible btn-small">Invisible Button</a>
    </div>
  </div>
  <?php foreach ($page->builder()->toBlocks() as $block): ?>
  <?= $block ?>
<?php endforeach ?>
<?php snippet('footer') ?>
