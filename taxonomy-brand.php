<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>

		<h2 class="archive-title">Showing all <?php single_cat_title(); ?> Products</h2>

		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
			
			<?php if( has_post_thumbnail() ){ ?>
					<a href="<?php the_permalink(); ?>" class="thumb">
					<?php the_post_thumbnail( 'thumbnail' );  //activated this feature in functions.php ?>
					</a>
			<?php } ?>

			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>
			<div class="entry-content">
				<?php 
				//if on a single post or page, show full content
				if( is_singular() ){
					the_content();
				}else{
					the_excerpt();
				} ?>

				<span class="product-price">
					<?php echo get_post_meta( $post->ID, 'Price', true ); ?>
				</span>
			</div>
				
		</article><!-- end post -->

		<?php endwhile; ?>

		<section class="pagination">
			<?php
			//check to see if pagenavi plugin exists
			if(function_exists('wp_pagenavi')){
				wp_pagenavi();
			} else{
				//pagenavi is inactive, so do normal pagination
				previous_posts_link('&larr; Newer Posts');
				next_posts_link('Older Posts &rarr;');
			}
			 
			//single post pagination
			if(is_single()){
				previous_post_link( '%link', 'Older Post' );
				next_post_link( '%link', 'Newer Post: %title ' );
			}
			?>
		</section>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('shop'); //include sidebar-shop.php ?>
<?php get_footer(); //include footer.php ?>