<?php get_header(); ?>

<section class="row">
  <div class="small-12 columns text-center">
    <div class="leader">
    <?php

	$args = array(
		'post_type' => 'post'
		

	);
	
	$query = new WP_Query( $args );

?>

	<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?> 
    
      <article <?php post_class('post'); ?>>
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <h2><?php echo strip_tags( get_the_excerpt() ); ?></h2>
                <ul class="post-meta no-bullet">
                  <li class="author">
                      <span class="wpt-avatar small">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?>
                      </span>
                      by <?php the_author_posts_link(); ?>                    
                  </li>
                  <li class="cat">in <?php the_category( ', ' ); ?></li>
                  <li class="date">on <?php the_time('F j, Y'); ?></li>
                </ul>    
                <?php if( get_the_post_thumbnail() ) : ?>
                <div class="img-container">
                  <?php the_post_thumbnail('large'); ?>
                </div>  
                <?php endif; ?>          	
              </article>   

	  <?php endwhile; endif; ?>
    
    </div>
  </div>
</section>

<?php get_template_part('content', 'portfolio'); ?>

<?php get_footer(); ?>