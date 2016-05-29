<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Azkaban
 */
global $azkaban_options;
?>
<?php
if ( is_single() ) :
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('grid-100 grid-parent az-postwrapper'); ?>>

    <?php if( $azkaban_options['enable_featuredimage'] ) { ?>
        <div class="grid-100 tablet-grid-100 mobile-grid-100 grid-parent az-featuredimg">
            <a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php cb_get_thumb('medium-featured', 'az-thumbnail'); ?></a>
        </div> <!-- end of az-featuredimg -->
    <?php } ?>

    <div class="grid-100 tablet-grid-100 mobile-grid-100 grid-parent az-posttitle">
        <?php the_title( '<h1>', '</h1>' ); ?>
    </div> <!-- end of az-posttitle -->
            
    <div class="grid-100 tablet-grid-100 mobile-grid-100 grid-parent az-postcontent">
    <?php
        the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'azkaban' ) );
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'azkaban' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ));
    ?>
    </div> <!-- End of az-postcontent -->
    <?php 
        if( $azkaban_options['enable_tags'] ) {
            the_tags( '<div class="grid-100 tablet-grid-100 mobile-grid-100 grid-parent az-posttags"><span class="tag-links">Tags: ', ', ', '</span></div>' );
        }
    ?>
    <div class="grid-100 tablet-grid-100 mobile-grid-100 grid-parent az-postmeta">
    <?php
        if( $azkaban_options[enable_author] ) {
            printf( 'By <span class="az-byline"><span class="az-author vcard"><a href="%1$s" rel="author">%2$s</a></span></span>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
            );
        }

        if( $azkaban_options[enable_postdate] ) {
            printf( ' On <span class="az-entrydate"><a href="%1$s" rel="bookmark"><time datetime="%2$s">%3$s</time></a></span>',
                esc_url( get_permalink() ),
                esc_attr( get_the_date( 'c' )),
                esc_html( get_the_date() )
            );
        }
            
        if( $azkaban_options[enable_postcategory] ) { 
    ?>
        <span class="az-categorylink">In <?php the_category(', '); ?></span>
    <?php
        }
        if( !post_password_required() && (comments_open() || get_comments_number()) ) :
    ?>
        <span class="az-commentslink"><?php comments_popup_link( __( 'Leave a comment', 'azkaban' ), __( '1 Comment', 'azkaban' ), __( '% Comments', 'azkaban' ) ); ?></span>
    <?php
        endif;
        echo '<a href="'.get_permalink().'" title="'.$azkaban_options['readmore_text'].'" class="az-readmoreright">'.$azkaban_options['readmore_text'].'</a>';
    ?>
    </div> <!-- end of az-postmeta -->

    <?php if( $azkaban_options['enable_prevnext'] ) { ?>
    <div class="grid-100 tablet-grid-100 mobile-grid-100 grid-parent" id="az-prevnextwrap">
        <div class="grid-50 tablet-grid-50 mobile-grid-100 grid-parent az-previouspost">
            <?php previous_post_link('<span>Previous Post</span><br>%link'); ?>
        </div>
        <div class="grid-50 tablet-grid-50 mobile-grid-100 grid-parent az-nextpost">
            <?php next_post_link('<span>Next Post</span><br>%link'); ?>
        </div>
    </div> <!-- end of az-prevnextwrap -->
    <?php } ?>
    <?php if( $azkaban_options['enable_author_details'] ) { ?>
        <div class="grid-100 tablet-grid-100 mobile-grid-100 grid-parent" id="az-authorbio">
            <div class="az-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 96 ); ?></div>
            <h3>About the author</h3>
            <p class="az-authorname"><?php echo azkaban_get_author_page_link(); ?></p>
            <p class="az-authorbio"><?php echo the_author_meta('description'); ?></p>
        </div> <!-- end of az-authorbio -->
    <?php } ?>

</div>
<?php else : ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('grid-33 tablet-grid-50 mobile-grid-100 az-postwrapper'); ?>>

    <?php if( $azkaban_options['enable_featuredimage'] ) { ?>
    <div class="grid-100 tablet-grid-100 mobile-grid-100 grid-parent az-featuredimg">
        <a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php cb_get_thumb('square-thumbnail', 'az-thumbnail'); ?></a>
    </div> <!-- end of az-featuredimg -->
    <?php } ?>

    <div class="grid-100 tablet-grid-100 mobile-grid-100 grid-parent az-posttitle">
        <?php the_title( '<h2><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">', '</a></h2>' ); ?>
    </div> <!-- end of az-posttitle -->

    <div class="grid-100 tablet-grid-100 mobile-grid-100 grid-parent az-postcontent">
    <?php
        if( $azkaban_options['enable_excerpt'] ) {
            az_excerpt('az_archive', 'az_excerptmore');
        }
        else {
            the_content(__('Read more', 'azkaban'));
        }
    ?>
    </div>

</div>
<?php endif; ?>
