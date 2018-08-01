<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package    ThemeGrill
 * @subpackage Accelerate
 * @since      Accelerate 1.0
 */
?>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  -->

<?php include('inc/send-email.php')?>

<div class="container">
    <div class="row h-center">
        <div class="col-md-10 col-md-offset-1">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php do_action( 'accelerate_before_post_content' ); ?>

                <?php if ( get_post_format() ) {
                    get_template_part( 'inc/post-formats' );
                } ?>

                <header class="entry-header">
                    <h1 class="entry-title">
                        <?php the_title(); ?>
                    </h1>
                </header>

                <?php accelerate_entry_meta(); ?>

                <div class="entry-content clearfix">
                    <?php
                    the_content();

                    wp_link_pages( array(
                        'before'      => '<div style="clear: both;"></div><div class="pagination clearfix">' . __( 'Pages:', 'accelerate' ),
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) );
                    ?>
                </div>
            </article>
        </div>
    </div>
</div>

