<?php
//turn on sleeping features
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

add_theme_support( 'post-thumbnails' );

//additional image sizes
// 				 name, width, height, crop?
add_image_size( 'home-slider', 1050, 250, true );

add_theme_support( 'custom-background', array( 'default-color' => '565552' ) );

//useful for custom logo uploader. don't forget to display it in header.php
add_theme_support( 'custom-header', array( 
		'width' =>  336,
		'height' => 80,
	) );

//turns on better RSS links in the head of every page. Useful on a blog or news site
add_theme_support( 'automatic-feed-links' );

//only list the formats you plan to support in your theme. 
//these are ALL the available formats:
add_theme_support( 'post-formats', array('gallery', 'image', 'quote', 'audio', 'video', 'aside', 'chat', 'link', 'status') );

//allows you to style the post editor if you create editor-style.css
add_editor_style();


/**
 *  Make excerpts better by changing the length and [...]
 *  @since  0.1
 *  @author  melissa 
 */
function awesome_readmore(){
	return ' <a href="' . get_permalink() . '" class="readmore">Read More!</a>';
}
add_filter( 'excerpt_more', 'awesome_readmore' );

function awesome_ex_length(){
	return 25; //words
}
add_filter( 'excerpt_length', 'awesome_ex_length' );


/**
 * Add support for menu system
 * @since  0.1
 */
add_action( 'init', 'awesome_menus');
function awesome_menus(){
	register_nav_menus( array(
		'main_menu' => 'Main Navigation Menu Area',
		'utilities' => 'Utilities',
	) );
}

/**
 * Add Widget Areas (Dynamic Sidebars)
 * @since  0.1
 */
add_action( 'widgets_init', 'awesome_sidebars' );
function awesome_sidebars(){
	register_sidebar( array(
		'name' 			=> 'Blog Sidebar',
		'id'			=> 'blog-sidebar',
		'description' 	=> 'appears next to all blog and archive pages',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Footer Area',
		'id'			=> 'footer-area',
		'description' 	=> 'appears at the bottom of every page',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Home Area',
		'id'			=> 'home-area',
		'description' 	=> 'appears at the bottom of the home page',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Page Sidebar',
		'id'			=> 'page-sidebar',
		'description' 	=> 'appears beside static pages',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
}



/**
 * Custom function to display most recent products
 * @param  $number int Maximum number of posts to show. Default is 6 posts.
 * @since  0.1
 */
function awesome_latest_products( $number = 6 ){
	//custom query and loop to show latest products
	$products_query = new WP_Query( array(
		'post_type' => 'product',
		'showposts' => $number, //max number of posts (LIMIT)
	) );
	//custom loop
	if( $products_query->have_posts() ){
	?>
	 <section class="recent-products clearfix">
	 	<h2><a href="<?php echo get_post_type_archive_link( 'product' ); ?>">Newest Products:</a></h2>
	 	<ul>
	 		<?php while( $products_query->have_posts() ){
	 				$products_query->the_post(); 
	 		?>
	 		<li>
	 			<a href="<?php the_permalink(); ?>">
	 				<?php the_post_thumbnail( 'thumbnail' ); ?>
	 				<div class="product-info">
	 					<h3><?php the_title(); ?></h3>
	 					<p><?php the_excerpt(); ?></p>
	 				</div>
	 			</a>
	 		</li>
	 		<?php }//endwhile ?>
	 	</ul>
	 </section>
	 <?php } //endif custom loop
	 //clean up!
	 wp_reset_postdata();
}

//no close PHP

