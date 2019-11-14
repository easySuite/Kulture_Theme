<?php

/**
 * @file
 * Cultur implementation to present a Panels layout.
 */
?>
<div id="page<?php print $css_id ? " $css_id" : ''; ?>" class="<?php print $classes; ?> kultur-wrapper">
  <?php if (!empty($content['branding']) || !empty($content['header']) || !empty($content['navigation'])): ?>
    <header class="site-header">
      <nav class="main-menu-wrapper navbar navbar-expand-lg navbar-light container <?php print $classes; ?>" <?php print $id; ?>>
        <?php if (!empty($content['branding'])): ?>
          <!-- <section class="topbar"> -->
            <!-- <div class="topbar-inner"> -->
              <?php print render($content['branding']); ?>
            <!-- </div> -->
          <!-- </section> -->
        <?php endif; ?>

        <?php if (!empty($content['header'])): ?>
          <!-- <section class="header-wrapper"> -->
            <!-- <div class="header-inner"> -->
              <?php print render($content['header']); ?>
            <!-- </div> -->
          <!-- </section> -->
        <?php endif; ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenuContent" aria-controls="navbarMenuContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenuContent">
          <?php if (!empty($content['navigation'])): ?>
            <!-- <section class="navigation-wrapper js-topbar-menu"> -->
              <!-- <div class="navigation-inner"> -->
                <?php print render($content['navigation']); ?>
              <!-- </div> -->
            <!-- </section> -->
          <?php endif; ?>
        </div>  
      </nav>  
    </header>
  <?php endif; ?>

  <div class="content-wrapper js-content-wrapper">
    <div class="content-inner">
      <?php print render($content['content']); ?>
    </div>
  </div>

  <?php if (!empty($content['footer'])): ?>
    <footer class="footer">
      <?php if (!empty($content['bottom'])): ?>
      <div class="bottom btn">
        <?php print render($content['bottom']); ?>
      </div>
      <?php endif; ?> 

      <div class="footer-inner">
        <?php print render($content['footer']); ?>
      </div>
    </footer>
  <?php endif; ?>
</div>
