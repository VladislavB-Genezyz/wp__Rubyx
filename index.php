<?php get_header();?>
<div id="page" class="box">
  <div id="page-in" class="box">

    <?php get_template_part('template__parts/breadcrumbs');?>

    <div id="content">
      
      <?php
      if ( have_posts() ) {
      while ( have_posts() ) {
      the_post(); ?>
      <div class="article">
        <h2><span><a href="#"><?php the_title();?></a></span></h2>
        <p class="info noprint">
          <span class="date"><?php the_time('Y-d-d'); ?> @ <?php the_time('g:i a'); ?></span>
          <span class="noscreen">,</span>
          <span class="cat">
            <a href="#"><?php the_category(',')?></a>
          </span>
          <span class="noscreen">,</span>
          <span class="user">
            <a href="#"><?php the_author_posts_link();?></a>
          </span>
          <span class="noscreen">,</span>
          <span class="comments">
            <a href="#">Comments</a>
          </span>
        </p>
          <?php
            the_excerpt();
          ?>
        <p class="btn-more box noprint">
          <strong>
          <a href="<?php the_permalink();?>">Read more</a>
          </strong>
        </p>
      </div>
      <hr class="noscreen" />
      <?php } // end while
      } // end if
      ?>
      <?php wp_bootstrap_pagination_rubyx();?>
    </div>
    <!--sidebar here -->
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>