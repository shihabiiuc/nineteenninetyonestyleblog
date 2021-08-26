<?php get_header(); ?>

<?php 

if (have_posts()) :
  while (have_posts()) : the_post(); ?>

  <article class="post">
    <h1><?php the_title(); ?></h1>
    <?php the_post_thumbnail( 'full' ); ?>
    <?php the_content(); ?>
  </article>

  <?php endwhile;
  else :
    echo '<p>No content found.</p>';
  endif;
?>


<?php get_footer(); ?>