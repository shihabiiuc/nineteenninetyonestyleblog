<?php get_header(); ?>

<?php 

if (have_posts()) :
  while (have_posts()) : the_post(); ?>

  <article class="post">
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
    <?php the_excerpt(); ?>
    <a class="readmore" href="<?php the_permalink(); ?>">Read More &raquo;</a>
  </article>

  <?php endwhile;

  else :
    echo '<p>No content found.</p>';
  endif;
?>

<!-- pagination -->
<?php
  if(paginate_links()) { ?>
    <nav class="shihabiiucblogi-pagination">
      <?php echo paginate_links(); ?>
    </nav>
  <?php }
?>


<?php get_footer(); ?>