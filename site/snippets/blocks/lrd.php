<?php 
  $assetManager->add('css', vite()->asset('assets/scss/snippets/blocks/lrd-app.scss'));
  $assetManager->add('js', vite()->asset('assets/js/snippets/blocks/lrd-app.js'));
?>

<iframe name="hiddenIframe" id="hiddenIframe" class="hide-this"></iframe>

<section class="lrd-app">
  <div>
    <h2><?= $block->heading() ?></h2>
  </div>
  <div>
    <?= $block->textArea() ?>
  </div>

  <div>
    <dialog id="loading">
      <h1>Loading...</h1>
    </dialog>

    <div class="kirby-form hide-this">
      <?php snippet('dreamform/form', [
        'form' => $block->form()->toPage(),
        'attr' => [
          // General attributes
          'form' => [],
          'row' => [],
          'column' => [],
          'field' => [],
          'label' => [],
          'error' => [],
          'input' => [],
          'button' => ['class' => 'primary'],

          'email' => [
            'field' => [],
            'label' => [],
            'error' => [],
            'input' => ['class' => 'input-button'],
          ],

          'success' => [], // Success message
          'inactive' => [], // Inactive message
        ]
      ]); ?>
    </div>

    <form id="identify" action="#">
      <div class="formline">
        <label for="email">Enter you email to use the calculator</label>
        <div class="input-button">
          <input type="email" name="email" id="email">
          <button class="primary" id="check-email" type="submit">Submit</button>
          <img src="/assets/images/spinner.svg" class="spinner" alt="spinner">
        </div>
        <div class="message"></div>
      </div>
    </form>
    <!-- Create input sliders -->
    <div id="sliders">
      <div class="slider-group">
        <div class="slider-title">
          <p>Diameter <span>(m)</span></p>
          <input type="text" class="slider-input" disabled id="input-LRD-dia" />
        </div>
        <div class="main-slider" data-max="5" data-min="2.5">
          <input id="LRD-dia" type="range" min="2.5" max="5" step="0.05" value="3.75" class="slider">
        </div>
      </div>
      <div class="slider-group">
        <div class="slider-title">
          <p>Length <span>(m)</span></p>
          <input type="text" class="slider-input" disabled id="input-LRD-hei" />
        </div>
        <div class="main-slider" data-min="10" data-max="22.5">
          <input id="LRD-hei" type="range" min="10" max="22.5" step="0.25" value="17.5" class="slider">
        </div>
      </div>
      <div class="slider-group">
        <div class="slider-title">
          <p>Axes horizontal offset <span>(m)</span></p>
          <input type="text" class="slider-input" disabled id="input-axes-horz-dist" />
        </div>
        <div class="main-slider" data-max="2" data-min="0">
          <input id="axes-horz-dist" type="range" min="0" max="2" step="0.1" value="1" class="slider">
        </div>
      </div>
      <div class="slider-group">
        <div class="slider-title">
          <p>Axes vertical offset <span>(m)</span></p>
          <input type="text" class="slider-input" disabled id="input-axes-vert-dist" />
        </div>
        <div class="main-slider" data-max="10" data-min="5">
          <input id="axes-vert-dist" type="range" min="5" max="10" step="0.1" value="5" class="slider">
        </div>
      </div>
      <div class="slider-group">
        <div class="slider-title">
          <p>Mooring declination from vertical <span>(deg)</span></p>
          <input type="text" class="slider-input" disabled id="input-mooring-decl" />
        </div>
        <div class="main-slider" data-max="85" data-min="30">
          <input id="mooring-decl" type="range" min="30" max="85" step="1" value="70" class="slider">
        </div>
      </div>
    </div>
    <!-- Create graph div -->
    <div class="graph-area">
      <div id="img-placeholder">
        <?php snippet('lrd-image'); ?>
      </div>
      <div id="graph"></div>
    </div>
    <div class="buttons" style="display: flex; gap: 20px; justify-content: center;">
      <button class="primary" id="download-pdf">Download Specification</button>
      <button class="primary" id="download-csv">Download Stiffness Curve</button>
    </div>
  </div>
</section>