<?php get_header();?>
<div id="page" class="box">
  <div id="page-in" class="box">
    <?php get_template_part('template__parts/breadcrumbs');?>

    <div id="content">
      <!-- Post here -->
      <?php 
        get_template_part('template__parts/content','single');?>
      <?php
        if(comments_open() || get_comments_number()){
          comments_template();
        }
      ?>
      <!-- Pagination here -->
      <?php wp_bootstrap_pagination_rubyx();?>
    </div>
    <!--sidebar here -->
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>