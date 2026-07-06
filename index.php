<?php
/**
 * Main fallback template.
 *
 * @package Usmani
 */

get_header();
?>

<main class="section-padding page-fade-in">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<article <?php post_class(); ?>>
					<h1 class="section-title"><?php the_title(); ?></h1>
					<div class="gold-line" style="margin:16px 0 24px"></div>
					<div class="about-text">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php esc_html_e( 'No content found.', 'usmani' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
