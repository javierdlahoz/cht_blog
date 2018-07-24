<?php 
/**
 * home.php for our theme.
 *
 * @package ThemeGrill
 * @subpackage Accelerate
 * @since Accelerate 1.0
 */
get_header(); ?>
	<?php do_action( 'accelerate_before_body_content' ); ?>
	<div ng-app="chtBlog" ng-controller="HomeController as home" ng-init="home.initialize()" ng-cloak>

        <loading ng-if="home.loading"></loading>

		<div id="content" class="clearfix featured-posts container-fluid main-container" ng-if="!home.loading">
            <hero-posts main-post="home.latestPost" secondary-post="home.secondPost"></hero-posts>
        </div>
        <div class="container-fluid main-container">
            <div class="row">
                <post-card class="col-md-6 col-lg-4" post="post" ng-repeat="post in home.posts"></post-card>
            </div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>