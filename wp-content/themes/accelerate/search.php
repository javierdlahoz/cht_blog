<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ThemeGrill
 * @subpackage Accelerate
 * @since Accelerate 1.0
 */
get_header(); ?>

	<?php do_action( 'accelerate_before_body_content' ); ?>

    <div ng-app="chtBlog" ng-controller="SearchController as search" ng-init="search.initialize()" ng-cloak>
        <div class="container-fluid main-container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Results for {{search.query}}</h1>
                    <loading ng-if="search.loading"></loading>
                </div>
                <post-card class="col-md-6 col-lg-4" post="post" ng-repeat="post in search.posts"></post-card>
            </div>
        </div>
    </div>

	<?php accelerate_sidebar_select(); ?>

	<?php do_action( 'accelerate_after_body_content' ); ?>

<?php get_footer(); ?>