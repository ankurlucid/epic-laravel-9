<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); ?>

 <style>
 
html.enhanced-interaction .vc_row.vc_row-fluid a.home-video{text-decoration: none;color: #7e7670;}
.scroll-container-horizontal .entry-content iframe {width: 92vh!important;height: 74vh!important;position: absolute!important;top:0px!important;left:0!important;max-width: 60vw;}
.single-project .topnav {position: fixed;}
.single-project .footer-grid {position: fixed; width:88%;bottom: 50px;}
.clearfix{clear: both;}
.single-project .footer span.copyright{right:0px;z-index: auto;}
body.page-template-new-home{background: #140f28;}
 html.enhanced-interaction .scroll-container-vertical {width: 100vw;height: 5000px;}	
html.enhanced-interaction .scroll-container-horizontal {position: fixed;top: 0;width: 100vw;height: 100vh;overflow: hidden;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;padding-bottom: 0;}
html.enhanced-interaction .scroll-container-touch {left: 0;display: block;position: absolute;width: 100%;height: calc(100vh - 100px);-webkit-overflow-scrolling: touch;z-index: 10;-ms-flex-item-align: end;align-self: flex-end;pointer-events: none;}	
html.enhanced-interaction .main .vc_row.visible {visibility: visible;}
html.enhanced-interaction .vc_row.vc_row-fluid {height: inherit;-webkit-box-orient: horizontal;-webkit-box-direction: normal;-ms-flex-direction: row;flex-direction: row;}
html.enhanced-interaction .vc_row.vc_row-fluid .wpb_raw_code.wpb_content_element, html.enhanced-interaction .content, html.enhanced-interaction .vc_row.vc_row-fluid, html.enhanced-interaction .wpb_column.vc_column_container {display: -webkit-box;display: -ms-flexbox;display: flex;}
.visible.vc_row.vc_row-fluid {visibility: visible;}	
html.enhanced-interaction .main {display: -webkit-box;display: -ms-flexbox;display: flex;   }
.main {position: relative;}
html.enhanced-interaction .content {height: calc(100vh - 0px);-ms-flex-item-align: end;align-self: flex-end;}
html.enhanced-interaction .vc_row.vc_row-fluid .wpb_raw_code.wpb_content_element, html.enhanced-interaction .content, html.enhanced-interaction .vc_row.vc_row-fluid, html.enhanced-interaction .wpb_column.vc_column_container {display: -webkit-box;display: -ms-flexbox;display: flex;}
html.enhanced-interaction .wpb_column.vc_column_container {position: relative;-webkit-box-orient: horizontal;-webkit-box-direction: normal;-ms-flex-direction: row;flex-direction: row;-webkit-box-align: center;-ms-flex-align: center;align-items: center;height: 80vh;max-height: 100%;-ms-flex-item-align: center;align-self: center;}
html.enhanced-interaction .vc_row.vc_row-fluid .wpb_raw_code.wpb_content_element, html.enhanced-interaction .content, html.enhanced-interaction .vc_row.vc_row-fluid, html.enhanced-interaction .wpb_column.vc_column_container {display: -webkit-box;display: -ms-flexbox;display: flex;}
.entry-content {display: flex;    }
html.enhanced-interaction .main .vc_row.visible {visibility: visible;}
html.enhanced-interaction .vc_row.vc_row-fluid {height: inherit;-webkit-box-orient: horizontal;-webkit-box-direction: normal;-ms-flex-direction: row;flex-direction: row; width:100vw;height: 82vh;}
html.enhanced-interaction .vc_row.vc_row-fluid .wpb_raw_code.wpb_content_element {-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;-webkit-box-align: center;-ms-flex-align: center;align-items: center;width: 100vw;}
.enhanced-interaction .vc_row.vc_row-fluid .image-hero.image:not(.no-scale) {max-width: 1124px;width: 108.07692vh;}
.will-change {will-change: transform;}
html.enhanced-interaction .vc_row.vc_row-fluid

.router{  -webkit-transform: translateY(50px);
    transform: translateY(50px);
    -webkit-transition: -webkit-transform 1s; 
    transition: -webkit-transform 1s;
    transition: transform 1s;
    transition: transform 1s, -webkit-transform 1s } 
#ac-globalfooter {background-color: #d2c7aa;color: #1d1d1f;position: relative;z-index: 1;margin-left:0; height:100%;}

html.enhanced-interaction .vc_row.vc_row-fluid.project-last-section {
        position: relative;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    width: 46vw;
	    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
  
}

div#content {
   
    display: flex;
}
article {
    display: flex;
   
}
ul.work-categories {
margin-right: 8.2vw; margin-left:8.2vw;}

router{}
@media screen and (min-width: 1025px) {
.prev-next-block {bottom: 50px;display: block!important;opacity:1!important;}
.next-block {bottom: 50px;display: block!important;opacity:1!important;}
.prev-block{bottom: 50px;display: block!important;opacity:1!important;}
.custom-share-block{display: inline-block!important;opacity:1!important;}
}
	 
	 /* Landscape */
@media only screen 
  and (min-width: 1024px) 
  and (max-height: 1366px) 
  and (orientation: landscape) 
  and (-webkit-min-device-pixel-ratio: 1.5) {
  html, body {
    overflow-y: hidden !important;
    overflow-x: auto !important;
		position: fixed;
  }

  html.enhanced-interaction .scroll-container-horizontal {
    overflow-x: auto !important;
    overflow-y: hidden !important;
		position: fixed;
	}
}


@media screen and (max-width: 1024px) {
article { width:100%; }
.single-project .prev-block{ display: none;}
html.enhanced-interaction .vc_row.vc_row-fluid.project-last-section {     height: auto;   width: 84%;margin: auto;clear: both;margin-bottom: 0px;display: block;}
.scroll-container-horizontal .entry-content {display: block; width:100%;}
.section {width: 84%;margin: auto;}
.section iframe {width: 100%!important;height: 48vw!important;max-width: 100%!important;position: relative!important;top: 0vh!important;}
.scroll-container-horizontal .entry-content iframe {width: 100%!important;height: 48vw!important;max-width: 100%!important;position: relative!important;top: 0vh!important; left:0px!important;}
.content.scroll-content .wpb_single_image .vc_single_image-wrapper {display: block;}
.content.scroll-content .wpb_single_image .vc_figure {display: block;}
.content.scroll-content .vc_column_container>.vc_column-inner{padding-left: 0!important;padding-right: 0!important;}
.content.scroll-content .wpb_single_image img {height: auto;max-width: 100%;vertical-align: top;width: 100%;}
.single-project .topnav {position: absolute;}

html.enhanced-interaction .wpb_column.vc_column_container{ height:100%!important; width:100%!important;}
html.enhanced-interaction .main {display: block;width: 100%;margin: auto;}
html.enhanced-interaction .scroll-container-touch{    overflow-x: visible;}
html.enhanced-interaction .scroll-container-vertical{ width:100%;     height: 100%!important;}
html.enhanced-interaction .scroll-container-horizontal {position: relative;top: 0;width: 100%!important;height: 100%!important;overflow: visible!important;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;padding-bottom: 0;}
html.enhanced-interaction .vc_row.vc_row-fluid .wpb_raw_code.wpb_content_element, html.enhanced-interaction .content, html.enhanced-interaction .vc_row.vc_row-fluid, html.enhanced-interaction .wpb_column.vc_column_container{  display: block;    width: 100%;}
.single-project .footer .menu-footer-menu-container{display:none!important; opacity:0px!important;}
.section-last-mob a {display: block; height:1px;}
html.enhanced-interaction .content {height: 100%;}
html.enhanced-interaction .scroll-container-touch{height: 100%;}
.single-project .footer-grid {position: absolute;padding: 10px 0;width: 84%;left: 0px;right: 0px;margin: 0 auto;top: 10px;}
.single-project .footer span.copyright {right: 0px;z-index: auto;top: 0;position: relative;bottom: 0;width: 100%;}
.single-project .footer {position: relative;bottom: 0;}




}
 </style>

<?php
if (isset($_REQUEST['project_category']) && !empty($_REQUEST['project_category'])) {
  $term = get_term_by('slug',$_REQUEST['project_category'],'project_category');
  $term_name = $_REQUEST['project_category'];
} 
$main_featuredID = get_post_thumbnail_id(get_the_ID());
$main_img=wp_get_attachment_image_url($main_featuredID, 'post-thumbnails');
?>
<div id="primary" class="content-area">
<div class="scroll-container-vertical" data-anim-scroll-group="" data-component-list="AutoScrollComponent AutoScrollTouchComponent ClassManager AnalyticsComponent">
<div class="scroll-container-horizontal">
<div class="scroll-container-touch" data-component-list="TouchClick">
<div class="content"></div>
</div>
<div class="content scroll-content" data-anim-scroll-group="" data-component-list="HorizontalAnimGroup ChromaManager AccessibilityComponent">
<main id="main" class="site-main main" role="main" data-page-type="overview">
	
    <div id="content" class="site-content">
   
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			//get_template_part( 'template-parts/content', 'single' );
        ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	      <header class="entry-header">
		    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	      </header><!-- .entry-header -->

	      <div class="entry-content ">
		    <?php
			  the_content();
		    ?>
		    
		
			<div class="vc_row wpb_row vc_row-fluid project-last-section">
            <?php
			  if (!isset($term) || empty($term)) {
			    $post_categories = get_the_terms(get_the_ID(), 'project_category');
			    $term = $post_categories[0];
				$term_name = $term->slug;
			  }
			  if (isset($_REQUEST['project_category']) && !empty($_REQUEST['project_category'])) {
			    $other_category_images = get_field('other_category_images', 11);
			  }
              else {			  
			    $other_category_images = get_field('other_category_images', $term);
                $selected_image = get_field('select_image', $term);
			  }	
              if ((isset($other_category_images) && !empty($other_category_images)) || (isset($selected_image) && !empty($selected_image))) {
              ?>
                <ul class="work-categories">
              <?php
                  if (isset($selected_image) && !empty($selected_image)) {
              ?>  
                    <li>
	                  <a class="work-category-term"  href="/work"><img src="<?php echo $selected_image['url']; ?>" alt=""></a>
	                </li>
              <?php 
                  }
              ?>	
              <?php 
                  if (isset($other_category_images) && !empty($other_category_images)) {    
                    foreach ($other_category_images as $key => $value) {
	                  $term_temp = get_term($value['select_category'], 'project_category');
              ?>
                      <li><a class="work-category-term"  href="<?php echo get_term_link($term_temp->slug, 'project_category') ?>"><img src="<?php echo $value['select_image']['url']; ?>" alt=""></a></li>
              <?php	  
	                }
                  }       		
              ?>
                </ul>
              <?php	
              }	  
              ?> 			
			<?php
			if (isset($_REQUEST['project_category']) && !empty($_REQUEST['project_category']) && $_REQUEST['project_category'] == 'selected') {
			  $term_name = $_REQUEST['project_category'];	
			  $posts=get_field('work',11);
              $posts_order = array();
              foreach ($posts as $key => $value) {
                $posts_order[$value->post_date] = $posts[$key];
              }	
              ksort($posts_order);
              $posts = array();
              foreach ($posts_order as $key => $value) {
                $posts[] = $value;
              }	
			}
            else { 			
			  $current_cat_id = $term->term_id;
			  $posts = get_posts(
                array(
                  'posts_per_page' => -1,
                  'post_type' => 'project',
				  'orderby'  => 'post_date',
                  'order'    => 'ASC',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'project_category',
                      'field' => 'term_id',
                      'terms' => $current_cat_id,
                    )
                  )
                )
              );
			}  
			  // get IDs of posts retrieved from get_posts
            $ids = array();
            foreach ( $posts as $thepost ) {
              $ids[] = $thepost->ID;
            }
            // get and echo previous and next post in the same category
            $thisindex = array_search( get_the_ID(), $ids );
            $nextid    = isset( $ids[ $thisindex + 1 ] ) ? $ids[ $thisindex + 1 ] : 0;
			//$next_post = get_next_post(true,'','project_category');
			if ($nextid != 0) { 
			  $featuredID = get_post_thumbnail_id($nextid);
		      $img=wp_get_attachment_image_url($featuredID,'project-post-next');
			  $img_mob=wp_get_attachment_image_url($featuredID,'project-post-next-mob');
			  if(!empty($img)) {
			?>
			    <div class="project-last-section-img"><a href="<?php echo get_the_permalink($nextid) ?>?project_category=<?php echo $term_name; ?>"><img src="<?php echo $img ?>" /></a></div>
			    <div class="section-last-mob"><a href="<?php echo get_the_permalink($nextid) ?>?project_category=<?php echo $term_name; ?>"><img src="<?php echo $img_mob ?>" /></a></div>
            <?php 			
			  }	 			  
			}
			else {
			  if (isset($_REQUEST['project_category']) && !empty($_REQUEST['project_category']) && $_REQUEST['project_category'] == 'selected') {
			    $term_name = $_REQUEST['project_category'];	
			    $posts=get_field('work',11);
                $posts_order = array();
                foreach ($posts as $key => $value) {
                  $posts_order[$value->post_date] = $posts[$key];
                }	
                ksort($posts_order);
                $posts = array();
                foreach ($posts_order as $key => $value) {
                  $posts[] = $value;
                }
                $first = $posts[0]->ID; 
			    $featuredID = get_post_thumbnail_id($first);
		        $img=wp_get_attachment_image_url($featuredID,'project-post-next');
		        $img_mob=wp_get_attachment_image_url($featuredID,'project-post-next-mob');
			    if(!empty($img)) {
			  ?>
			      <div class="project-last-section-img"><a href="<?php echo get_the_permalink($first) ?>?project_category=<?php echo $term_name; ?>"><img src="<?php echo $img ?>" /></a></div>
			      <div class="section-last-mob"><a href="<?php echo get_the_permalink($first) ?>?project_category=<?php echo $term_name; ?>"><img src="<?php echo $img_mob ?>" /></a></div>
              <?php 			
			    }				
              }
              else {			  
			    $current_cat_id = $term->term_id;
			    $loop = get_posts(
                  array(
                    'posts_per_page' => -1,
                    'post_type' => 'project',
				    'orderby'  => 'post_date',
                    'order'    => 'ASC',
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'project_category',
                        'field' => 'term_id',
                        'terms' => $current_cat_id,
                      )
                    )
                  )
                );
			  
			    $first = $loop[0]->ID; 
			    $featuredID = get_post_thumbnail_id($first);
		        $img=wp_get_attachment_image_url($featuredID,'project-post-next');
		        $img_mob=wp_get_attachment_image_url($featuredID,'project-post-next-mob');
			    if(!empty($img)) {
			  ?>
			      <div class="project-last-section-img"><a href="<?php echo get_the_permalink($first) ?>?project_category=<?php echo $term_name; ?>"><img src="<?php echo $img ?>" /></a></div>
			      <div class="section-last-mob"><a href="<?php echo get_the_permalink($first) ?>?project_category=<?php echo $term_name; ?>"><img src="<?php echo $img_mob ?>" /></a></div>
              <?php 			
			    }
			  }	
			}	
			?>
			</div>  
			
	      </div><!-- .entry-content -->
        </article>
        <?php		
			
		endwhile;
		?>
	</div>

	<div class="clearfix"></div>				
</main>
<div class="clearfix"></div>
<div class="router will-change">
					<footer id="ac-globalfooter" class="no-js" lang="en-US" dir="ltr" data-analytics-region="global footer" role="contentinfo" aria-labelledby="ac-gf-label">




					</footer>
				</div>
				 
				
				
				
	<div class="clearfix"></div>	
</div>
	<div class="clearfix"></div>	
</div>
	<div class="clearfix"></div>	
	

</div>
<div class="clearfix"></div>
<?php
if (!isset($term) || empty($term)) {
  $post_categories = get_the_terms(get_the_ID(), 'project_category');
  $term = $post_categories[0];
  $term_name = $term->slug;
}
if (isset($_REQUEST['project_category']) && !empty($_REQUEST['project_category']) && $_REQUEST['project_category'] == 'selected') {
  $term_name = $_REQUEST['project_category'];	
  $posts=get_field('work',11);
  $posts_order = array();
  foreach ($posts as $key => $value) {
    $posts_order[$value->post_date] = $posts[$key];
  }	
  ksort($posts_order);
  $posts = array();
  foreach ($posts_order as $key => $value) {
    $posts[] = $value;
  }	
}
else {
  $current_cat_id = $term->term_id;
  $posts = get_posts(
    array(
      'posts_per_page' => -1,
      'post_type' => 'project',
	  'orderby'  => 'post_date',
      'order'    => 'ASC',
      'tax_query' => array(
        array(
          'taxonomy' => 'project_category',
          'field' => 'term_id',
          'terms' => $current_cat_id,
        )
      )
    )
  );
}  
// get IDs of posts retrieved from get_posts
$ids = array();
foreach ( $posts as $thepost ) {
  $ids[] = $thepost->ID;
}
// get and echo previous and next post in the same category
$thisindex = array_search( get_the_ID(), $ids );
$previd    = isset( $ids[ $thisindex - 1 ] ) ? $ids[ $thisindex - 1 ] : 0;
$nextid    = isset( $ids[ $thisindex + 1 ] ) ? $ids[ $thisindex + 1 ] : 0;
if ($previd != 0 && $nextid != 0) { 
?>
  <div class="prev-next-block">
    <nav class="navigation post-navigation" role="navigation">
      <div class="nav-links">
	    <div class="nav-previous">
	      <a href="<?php echo get_permalink($previd) ?>?project_category=<?php echo $term_name; ?>" rel="prev">
		    <span class="meta-nav" aria-hidden="true">previous</span>  /
		  </a>
        </div>
	    <div class="nav-next">
	      <a href="<?php echo get_permalink($nextid) ?>?project_category=<?php echo $term_name; ?>" rel="next">
		    <span class="meta-nav" aria-hidden="true">next </span>
		  </a>
	    </div>
	  </div>
    </nav>
    <div class="custom-share-block">
      <a href="javascript:void(0)" class="custom-share-link">/ share</a>
    </div> 
  </div>	
<?php  
}
elseif ($previd == 0 && $nextid != 0) {
?>	
  <div class="next-block">
    <nav class="navigation post-navigation" role="navigation">
      <div class="nav-links">
	    <div class="nav-next">
	      <a href="<?php echo get_permalink($nextid) ?>?project_category=<?php echo $term_name; ?>" rel="next">
		    <span class="meta-nav" aria-hidden="true">next </span>
		  </a>
	    </div>
	  </div>
    </nav>
    <div class="custom-share-block">
      <a href="javascript:void(0)" class="custom-share-link">/ share</a>
    </div> 
  </div>	
<?php  
}	
elseif ($previd != 0 && $nextid == 0) {
?>
  <div class="prev-block">
    <nav class="navigation post-navigation" role="navigation">
      <div class="nav-links">
	    <div class="nav-previous">
	      <a href="<?php echo get_permalink($previd) ?>?project_category=<?php echo $term_name; ?>" rel="prev">
		    <span class="meta-nav" aria-hidden="true">previous </span>
		  </a>
        </div>
	  </div>
    </nav>
	<div class="custom-share-block">
      <a href="javascript:void(0)" class="custom-share-link">/ share</a>
    </div> 
  </div> 
<?php	
}
?>	
<?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_jsdq"]') ?>
<script>
jQuery(".at-below-post .addthis_tool").remove()

  jQuery("body").on("click",".custom-share-link",function(event){
	    event.stopPropagation();
	    jQuery(this).toggleClass("custom-share-link-open");
		jQuery(".addthis_tool").toggleClass("addthis_tool_open");
		jQuery('body').toggleClass('custom-share-open-body');
	});  
  jQuery("body").on("click",".at4-visually-hidden",function(event){
		event.stopPropagation();
		jQuery(".custom-share-link").toggleClass("custom-share-link-open");
		jQuery(".addthis_tool").toggleClass("addthis_tool_open");
		jQuery('body').toggleClass('custom-share-open-body');
	}); 
  jQuery("body").on("click",function(){  
		jQuery(".custom-share-link").removeClass("custom-share-link-open");
		jQuery(".addthis_tool").removeClass("addthis_tool_open");
		jQuery('body').removeClass('custom-share-open-body');
	});
 
</script>


<script type="text/javascript">
var addthis_share =
{
   media: "<?php echo $main_img; ?>"
}
</script>
<?php get_footer(); ?>
