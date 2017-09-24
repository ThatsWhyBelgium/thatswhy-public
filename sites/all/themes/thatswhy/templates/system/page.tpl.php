<div class="f-d-c">
  <?php if ($page['nav']): ?>
    <header id="header" role="banner" class="fl-c nav-wr">
      <div class="nr fd nav-ct">
        <div class="c4 logo">
          <a href="<?php print $front_page; ?>" title="<?php print t('Return to our startpage'); ?>">
            <picture>
              <!--[if IE 9]><video style="display: none;"><![endif]-->
              <!-- <source srcset="<?php print $logo; ?>" media="(min-width: 0px)" /> -->
              <source srcset="<?php print $logo_mob; ?>" media="(max-width: 1024px) and (orientation: landscape)" />
              <source srcset="<?php print $logo_mob_svg; ?>" media="(max-width: 1024px) and (orientation: landscape)" type="image/svg+xml" />
              <source srcset="<?php print $logo_svg; ?>" type="image/svg+xml" viewbox="0 0 604 170"/>
              <!--[if lt IE 9]>
                <img src="<?php print $logo; ?>" alt="<?php print t('The @name logo', array('@name' => $site_name)); ?>" title="<?php print  $site_slogan . ' | ' . $site_name ; ?>" />
              <![endif]-->
              <!--[if IE 9]></video><![endif]-->
              <img srcset="<?php print $logo; ?>" alt="<?php print t('The @name logo', array('@name' => $site_name)); ?>" />
            </picture>
          </a>
        </div>
        <a href="#" title="<?php print t('Go to the menu'); ?>" class="mob-only menu-clicker">Menu</a>
        <nav role="navigation" class="nav c8 l">
          <a href="#" class="mob-only menu-closer" title="<?php print t('Close the menu'); ?>" rel="nofollow"><?php print t('Close the menu'); ?></a>
          <?php print render($page['nav']); ?>
        </nav>
      </div>
    </header>
  <?php endif; ?>
  <?php if ($map) : ?>
    <div class="maps-wr fl-c">
      <div id="map">
      </div>
    </div>
  <?php endif; ?>
  <?php if ($page['header']): ?>
    <div class="fl-c header-wr">
      <?php print render($page['header']); ?>
    </div>
  <?php endif; ?>
  <div id="main" class="fl-c main-wr">
  <?php if ($needs_wrapper): ?>
    <div class="nr fd main">
  <?php endif; ?>
      <?php if ($title && $needs_title): ?>
        <h1><?php print $title; ?></h1>
      <?php endif; ?>
      <?php if ($messages): ?>
        <?php print $messages; ?>
      <?php endif; ?>
      <?php if ($tabs): ?>
        <?php if (!$tabs['#primary'] == ''): ?>
          <div class="tabs-container">
            <ul class="tabs">
              <?php print render($tabs); ?>
            </ul>
          </div>
        <?php endif; ?>
      <?php endif; ?>

      <?php print render($page['content']); ?>
  <?php if ($needs_wrapper): ?>
    </div>
  <?php endif; ?>
  </div>
  <footer id="footer" class="fl-c footer-wr">
    <div class="nr fd footer">
      <div class="c8 info">
        <div class="c4 logo">
          <a href="<?php print $front_page; ?>" title="<?php print t('Return to our startpage'); ?>">
            <picture>
              <!--[if IE 9]><video style="display: none;"><![endif]-->
              <!-- <source srcset="<?php print $logo; ?>" media="(min-width: 0px)" /> -->
              <source srcset="<?php print $logo_svg; ?>" type="image/svg+xml" viewbox="0 0 604 170"/>
              <!--[if lt IE 9]>
                <img src="<?php print $logo; ?>" alt="<?php print t('The @name logo', array('@name' => $site_name)); ?>" title="<?php print  $site_slogan . ' | ' . $site_name ; ?>" />
              <![endif]-->
              <!--[if IE 9]></video><![endif]-->
              <img srcset="<?php print $logo; ?>" alt="<?php print t('The @name logo', array('@name' => $site_name)); ?>" />
            </picture>
          </a>
        </div>
      </div>
      <div class="c4 l social">
        <p>
          <a href="mailto:info@thatswhy.be" title="<?php echo t("Contact That's Why via e-mail to @email", array('@email' => variable_get('site_mail', ''))); ?>" class="icon mail-icon" target="_blank">info@thatswhy.be</a>
          <a href="https://www.facebook.com/pages/Thats-Why/369416879925115" title="<?php echo t("Go to our facebook page"); ?>" class="icon fb-icon" target="_blank"><?php echo t("That's Why on Facebook") ?></a>
          <a href="https://www.linkedin.com/company/9387221" title="<?php echo t("Go to the That's Why linkedin page"); ?>" class="icon linkedin-icon" target="_blank"><?php echo t("That's Why on linkedin"); ?></a>
        </p>
      </div>
      <?php if ($page['footer']): ?>
        <div class="c12 footer-c">
          <?php echo render($page['footer']); ?>
        </div>
      <?php endif; ?>
    </div>
  </footer>
</div>
