<?php
add_image_size('project-post-next', 187, 554, true);
add_image_size('project-post-next-mob', 872, 212, true);

function filter_plugin_updates( $value ) {
	if(isset($value->response['advanced-custom-fields-pro/acf.php'])){
	unset( $value->response['advanced-custom-fields-pro/acf.php'] );
	}
    return $value;
}
add_filter('site_transient_update_plugins', 'filter_plugin_updates' );

function remove_core_updates(){
global $wp_version;
return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}

add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');

function register_custom_menu() {
  add_menu_page(
    null, // not an actual page, so title is irrelevant
    'Work',
    'edit_posts', // or whatever capability required for this object
    '/post.php?post=11&action=edit&classic-editor',
    null,
    '',
    30
  );
  /*add_menu_page(
    null, // not an actual page, so title is irrelevant
    'Studio',
    'edit_posts', // or whatever capability required for this object
    '/post.php?post=254&action=edit&classic-editor',
    null,
    '',
    30
  );*/
  add_menu_page(
    null, // not an actual page, so title is irrelevant
    'Theme settings',
    'edit_posts', // or whatever capability required for this object
    '/post.php?post=463&action=edit&classic-editor',
    null,
    '',
    30
  );
 /* add_menu_page(
    null, // not an actual page, so title is irrelevant
    'Work with us',
    'edit_posts', // or whatever capability required for this object
    '/post.php?post=660&action=edit&classic-editor',
    null,
    '',
    30
  );*/
  add_menu_page(
    null, // not an actual page, so title is irrelevant
    'Contact',
    'edit_posts', // or whatever capability required for this object
    '/post.php?post=662&action=edit&classic-editor',
    null,
    '',
    30
  );
}
add_action('admin_menu', 'register_custom_menu');

/*------------create submenu page in default page area---------------*/ 
 add_submenu_page('edit.php?post_type=studio','Purpose', 'Purpose', 'manage_options', '/post.php?post=254&action=edit&classic-editor');
 add_submenu_page('edit.php?post_type=studio','Approach', 'Approach', 'manage_options', '/post.php?post=477&action=edit&classic-editor');
 add_submenu_page('edit.php?post_type=studio','People', 'People', 'manage_options', '/post.php?post=480&action=edit&classic-editor');
 add_submenu_page('edit.php?post_type=studio','Awards', 'Awards', 'manage_options', '/post.php?post=482&action=edit&classic-editor');

function be_submenu_items_in_secondary( $menu_items, $args ) {
	
	if( 'secondary' !== $args->theme_location )
		return $menu_items;
	
	$active_section = false;
	foreach( $menu_items as $menu_item ) {
		if( ! $menu_item->menu_item_parent && array_intersect( array( 'current-menu-item', 'current-menu-ancestor' ), $menu_item->classes ) )
			$active_section = $menu_item->ID;
	}
	if( ! $active_section )
		return false;
	
	$sub_menu = array();
	$section_ids = array( $active_section );
	foreach( $menu_items as $menu_item ) {
		if( in_array( $menu_item->menu_item_parent, $section_ids ) ) {
			$sub_menu[] = $menu_item;
			$section_ids[] = $menu_item->ID;
		}
	}
	return $sub_menu;
}
add_filter( 'wp_nav_menu_objects', 'be_submenu_items_in_secondary', 10, 2 );

function get_all_peoples() {
  $query = new WP_Query(array(
    'post_type' => 'people',
    'post_status' => 'publish',
	'posts_per_page' => -1,
  ));
  $people_array = array();
  while ($query->have_posts()) {
    $query->the_post();
    $post_id = get_the_ID();
	$people_array[] = array('id' => $post_id, 'title' => get_the_title());
  }
  wp_reset_query();
  return $people_array; 
}

add_action('admin_head', 'my_custom_css');

function my_custom_css() { 
  echo '<style>
    #wpbody #wpbody-content{overflow: hidden!important;}
    } 
  </style>';
}	


add_action('wp_footer', 'ktr_script_to_footer');
function ktr_script_to_footer() {
 
	if(is_single( 2602 )){
		$val=11500*(-1);
	}else{
		$val=2500*(-1);
	}
  if( is_home() || is_front_page() || is_singular( 'project' ) )
    echo "<script>
jQuery(document).ready(function(){
    console.log('sdfdsf');
    var currentX,lastT;
    var lastX,scrolled = 0;
    var is_iPad = navigator.userAgent.match(/iPad/i) != null;
    jQuery(document).bind('touchmove', function(e)
    {
        if(is_iPad==true && is_iPad!='undefined'){
                // If still moving clear last setTimeout
                clearTimeout(lastT);
                var resou = jQuery('.entry-content').width();
				//console.log('width'+resou);
                //resou = resou-1200;
                
                currentX = e.originalEvent.touches[0].clientX;
				//console.log('currentx',currentX);
                // After stoping or first moving
                if(lastX == 0)
                {
                    lastX = currentX;
                }
                if(currentX < lastX)
                {
                    // Left to right
                    //console.log('Left to right');
                    resou = resou-1200;
                    //console.log(resou);
                    if(scrolled != ". $val .")
                    {
                        scrolled = scrolled - 25;
                    }else{
                        scrolled = ". $val .";
                    }
                    //console.log('changed'+scrolled);
                    jQuery('.scroll-content').css('transform', 'translateX('+scrolled+'px)');
                }
                else if(currentX > lastX)
                {
                    // Right to left
                    //console.log('Right to left');
                    if(scrolled != 0)
                    {
                        scrolled = scrolled + 25;
                    }
                    //console.log(scrolled);
                    jQuery('.scroll-content').css('transform', 'translateX('+scrolled+'px)');
                }
                lastX = currentX;
        }
    });
});
    </script>";
}