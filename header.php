<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
<!--     <link rel="stylesheet" media="screen,projection" type="text/css" href="css/main.css" />
    <link rel="stylesheet" media="print" type="text/css" href="css/print.css" />
    <link rel="stylesheet" media="aural" type="text/css" href="css/aural.css" /> -->
    <?php wp_head(); ?>
  </head>
  <body <?php body_class();?> id="www-url-cz">
    <div id="main" class="box">
      <div id="header">
        <h1 id="logo"><a href="">Ruby<strong>X</strong><span></span></a></h1>
        <hr class="noscreen" />
        <div class="noscreen noprint">
          <p><em>Quick links: <a href="#content">content</a>, <a href="#tabs">navigation</a>, <a href="#search">search</a>.</em></p>
          <hr />
        </div>
        <div id="search" class="noprint">
          <form action="" method="get">
            <fieldset>
              <legend>Search</legend>
              <label><span class="noscreen">Find:</span> <span id="search-input-out">
              <input type="text" name="" id="search-input" size="30" />
            </span></label>
            <input type="image" src="<?php echo get_template_directory_uri()?>/img/search_submit.gif" id="search-submit" value="OK" />
          </fieldset>
        </form>
      </div>
    </div>
    <div id="tabs" class="noprint">
      <h3 class="noscreen">Navigation</h3>

      <?php 
        wp_nav_menu( array(
          'theme_location'  => 'primary',
          'menu_class'      => 'box',
          'menu_id'         => '',
          'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
          'depth'           => 1
        ) );
      ?>

      <hr class="noscreen" />
    </div>