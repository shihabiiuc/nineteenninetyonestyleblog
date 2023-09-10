<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>

<header class="site-header">
  <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo("name"); ?></a></h1>
  <h5 class="site-tagline"><?php bloginfo("description"); ?></h5>

  <nav class="site-nav">
    <?php
      $args = array(
        "theme_location" => "primary"
      );
    ?>
    <?php wp_nav_menu( $args ); ?>
  </nav> 
</header>