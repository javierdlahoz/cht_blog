<?php get_header(); ?>

	<?php do_action( 'accelerate_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix container-fluid main-container">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
							if ( is_category() ) :
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								/* Queue the first post, that way we know
								 * what author we're dealing with (if that is the case).
								*/
								the_post();
								printf( __( 'Author: %s', 'accelerate' ), '<span class="vcard">' . get_the_author() . '</span>' );
								/* Since we called the_post() above, we need to
								 * rewind the loop back to the beginning that way
								 * we can run the loop properly, in full.
								 */
								rewind_posts();

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'accelerate' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'accelerate' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'accelerate' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								_e( 'Asides', 'accelerate' );

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'accelerate');

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								_e( 'Videos', 'accelerate' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								_e( 'Quotes', 'accelerate' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								_e( 'Links', 'accelerate' );

							else :
								_e( 'Archives', 'accelerate' );

							endif;
						?>
					</h1>
					<?php
						// Show an optional term description.
                        $term = get_queried_object();
                        $term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					?>
				</header><!-- .page-header -->

                <div ng-app="chtBlog" ng-controller="ArchiveController as archive" ng-init="archive.initialize('<?php echo $term->term_id ?>')">

                    <loading ng-if="archive.loading"></loading>
                    <hero-posts main-post="archive.latestPost" secondary-post="archive.secondPost" third-post="archive.thirdPost" ng-if="!archive.loading"></hero-posts>

                    <div class="row">
                        <post-card class="col-md-6 col-lg-4" post="post" ng-repeat="post in archive.posts"></post-card>
                    </div>
                </div>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	<?php accelerate_sidebar_select(); ?>

	<?php do_action( 'accelerate_after_body_content' ); ?>

<?php get_footer(); ?>