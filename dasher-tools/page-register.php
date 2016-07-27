<?php
session_start();
/**
 * Template Name: Register
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$check = FALSE;
if($_SESSION['check']){
  $check = TRUE;  
}
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if($actual_link == 'http://spanishpeaksmountainclub.com/beta/register/'){
  $check = TRUE;
}
if ( is_user_logged_in() || $check == TRUE ) {
get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer();
  }
else{
  $out = 'Location: '.bloginfo('url').'/beta/wp-login.php';
   header( $out ) ;
  }?>