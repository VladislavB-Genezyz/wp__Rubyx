<?php

function wpRubyx_setup(){
	load_theme_textdomain( 'wpRubyx');
	add_theme_support( 'title-tag' );
	// add_theme_support( 'post-thumbnails' );
	// set_post_thumbnail_size( , $height = 0, $crop = false )os
	add_theme_support( 'html5', array(
		'search_form',
		'comment_form',
		'comment_list',
		'gallery',
		'caption'
	));

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'gallery'
	));
	register_nav_menu( 'primary', 'Primary menu' );
}
add_action('after_setup_theme', 'wpRubyx_setup');


add_filter('excerpt_more', function($more) {
	return ' ...';
});


function load_css_scripts(){
	wp_enqueue_style('style.css', get_stylesheet_uri());		
	// wp_enqueue_style('aural', get_template_directory_uri().'/css/aural.css');
	// wp_enqueue_style('print', get_template_directory_uri().'/css/print.css');
	// wp_enqueue_script( '$handle', '$src', array( 'jquery' ), false, false );
	
	
}
add_action( 'wp_enqueue_scripts', 'load_css_scripts' );

function rubyx_the_breadcrumb(){
	global $post;
	if(!is_home()){ 
	   echo '<a href="'.site_url().'">Home</a> &gt';
		if(is_single()){ // posts
		the_category(', ');
		echo "  ";
		echo '<li>';
			the_title();
		echo '';
		}
		elseif (is_page()) { // pages
			if ($post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . '<li> / </li> ';
			}
			echo the_title();
		}
		elseif (is_category()) { // category
			global $wp_query;
			$obj_cat = $wp_query->get_queried_object();
			$current_cat = $obj_cat->term_id;
			$current_cat = get_category($current_cat);
			$parent_cat = get_category($current_cat->parent);
			if ($current_cat->parent != 0) 
				echo(get_category_parents($parent_cat, TRUE, ' <li> / </li> '));
			single_cat_title();
		}
		elseif (is_search()) { // search pages
			echo 'Search results "' . get_search_query() . '"';
		}
		elseif (is_tag()) { // tags
			echo single_tag_title('', false);
		}
		elseif (is_day()) { // archive (days)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> <li> / </li> ';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> <li> / </li> ';
			echo get_the_time('d');
		}
		elseif (is_month()) { // archive (months)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> <li> / </li>';
			echo get_the_time('F');
		}
		elseif (is_year()) { // archive (years)
			echo get_the_time('Y');
		}
		elseif (is_author()) { // authors
			global $author;
			$userdata = get_userdata($author);
			echo '<li>Posted ' . $userdata->display_name . '</li>';
		} elseif (is_404()) { // if page not found
			echo '<li>Error 404</li>';
		}
	 
		if (get_query_var('paged')) // number of page
			echo ' (' . get_query_var('paged').'- page)';
	 
	} else { // home
	   $pageNum=(get_query_var('paged')) ? get_query_var('paged') : 1;
	   if($pageNum>1)
	      echo '<a href="'.site_url().'">Home</a> &gt'.$pageNum.'- page';
	   else
	      echo 'Home';
	}
}

/* Pagination function start */
function wp_bootstrap_pagination_rubyx( $args = array() ) {
    
    $defaults = array(
        'range'           => 4,
        'custom_query'    => FALSE,
        'previous_string' => __( 'Previous', 'text-domain' ),
        'next_string'     => __( 'Next', 'text-domain' ),
        'before_output'   => '<div class="post-nav"><ul class="pager">',
        'after_output'    => '</ul></div>'
    );
    
    $args = wp_parse_args( 
        $args, 
        apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
    );
    
    $args['range'] = (int) $args['range'] - 1;
    if ( !$args['custom_query'] )
        $args['custom_query'] = @$GLOBALS['wp_query'];
    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval( get_query_var( 'paged' ) );
    $ceil  = ceil( $args['range'] / 2 );
    
    if ( $count <= 1 )
        return FALSE;
    
    if ( !$page )
        $page = 1;
    
    if ( $count > $args['range'] ) {
        if ( $page <= $args['range'] ) {
            $min = 1;
            $max = $args['range'] + 1;
        } elseif ( $page >= ($count - $ceil) ) {
            $min = $count - $args['range'];
            $max = $count;
        } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }
    
    $echo = '';
    $previous = intval($page) - 1;
    $previous = esc_attr( get_pagenum_link($previous) );
    

    if ( $previous && (1 != $page) )
        $echo .= '<li><a href="' . $previous . '" title="' . __( 'previous', 'text-domain') . '">' . $args['previous_string'] . '</a></li>';
    
    if ( !empty($min) && !empty($max) ) {
        for( $i = $min; $i <= $max; $i++ ) {
            if ($page == $i) {
                $echo .= '<li class="active"><span class="active">' . str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) . '</span></li>';
            } else {
                $echo .= sprintf( '<li><a href="%s">%002d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
            }
        }
    }
    
    $next = intval($page) + 1;
    $next = esc_attr( get_pagenum_link($next) );
    if ($next && ($count != $page) )
        $echo .= '<li><a href="' . $next . '" title="' . __( 'next', 'text-domain') . '">' . $args['next_string'] . '</a></li>';
    
    if ( isset($echo) )
        echo $args['before_output'] . $echo . $args['after_output'];
}

/* Pagination function end */

/* Castomize start function*/
function rubyx_customize_register( $wp_customize )
{
	/* header_social title start */
   $wp_customize->add_setting('header_social', array(
   		'default' => __('Some header on footer', 'rubyx'),
   		'transport' => 'refresh',
    ));

   $wp_customize->add_section( 'social_section' , array(
    'title'      => __( 'Social settings', 'rubyx' ),
    'priority'   => 30,
	) );

	$wp_customize->add_control(
		'header_social', 
		array(
			'label'    => __( 'Social header in footer', 'rubyx' ),
			'section'  => 'social_section',
			'settings' => 'header_social',
			'type'     => 'text',
		)
	);
	/* header_social title end */
	/* facebook_social img start */
	$wp_customize->add_setting('facebook_social', array(
		'default' => __('Share you', 'rubyx'),
		'transport' => 'refresh',
	));
	$wp_customize->add_control(
		'facebook_social', 
		array(
			'label'    => __( 'Social facebook icon in footer', 'rubyx' ),
			'section'  => 'social_section',
			'settings' => 'facebook_social',
			'type'     => 'text',
		)
	);
	/* facebook_social img end */
	/*footer copyright start*/

	$wp_customize->add_setting('footer_copy', array(
		'default' => __('<p id="copyright">&copy; 2007 <a href="#">My Name</a> | RubyX by <a href="#">Ken Dahlin</a> based entirely on <a href="#">CrystalX</a></p>', 'rubyx'),
		'transport' => 'refresh',
	));
	$wp_customize->add_control(
		'footer_copy', 
		array(
			'label'    => __( 'Copyright in footer', 'rubyx' ),
			'section'  => 'social_section',
			'settings' => 'footer_copy',
			'type'     => 'text',
		)
	);
	/*footer copyright end*/
}
add_action( 'customize_register', 'rubyx_customize_register' );


/* Castomize end function*/

/*Sidebar start*/
function rubyx_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'rubyx' ),
        'id' => 'sidebar-1',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'rubyx' ),
    // 'before_widget' => '<li id="%1$s" class="widget %2$s">'
	'before_widget' => '<div id="col %1$s" class="noprint %2$s">',    
	'after_widget'  => '</div>',
	'before_title'  => '<h3><span>',
	'after_title'   => '</h3></span>',
    ) );
}
add_action( 'widgets_init', 'rubyx_widgets_init' );


/*Sidebar end*/


?>