<?php
    /*
    * If the current post is protected by a password and
    * the visitor has not yet entered the password we will
    * return early without loading the comments.
    */
    if ( post_password_required() )
        return;


    if ( ! function_exists( 'phpmanual_comment' ) ) :
        function phpmanual_comment( $comment, $args, $depth ) {
            $GLOBALS['comment'] = $comment;
            switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
            ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php _e( 'Pingback:', 'phpmanual' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'phpmanual' ), '<span class="edit-link">', '</span>' ); ?></p>
            <?php
                break;
            default :
                // Proceed with normal comments.
                global $post;
            ?>
           
            <a name="<?php comment_ID(); ?>"></a>
            <div <?php comment_class('note');?>>  <div class="votes">
                    <div id="Vu<?php comment_ID(); ?>">
                        <a href="javascript:alert('we have no comment voting system')" title="Vote up!" class="usernotes-voteu">up</a>
                    </div>
                    <div id="Vd<?php comment_ID(); ?>">
                        <a href="javascript:alert('we have no comment voting system')" title="Vote down!" class="usernotes-voted">down</a>
                    </div>
                    <div class="tally" id="V<?php comment_ID(); ?>" title="60% like this...">
                        17
                    </div>
                </div>
                <a href="#<?php comment_ID(); ?>" class="name">
                    <strong class="user"><?php
                        printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'phpmanual' ) . '</span>' : ''
                        );
                    ?></strong></a><a class="genanchor" href="#<?php comment_ID(); ?>"> ¶</a><div class="date" title="<?php echo get_comment_date();?> <?php echo get_comment_time();?>"><strong>7 years ago</strong></div>
                <div class="text" id="Hcom<?php comment_ID(); ?>">
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'phpmanual' ); ?></p>
                        <?php endif; ?>

                    <?php edit_comment_link( __( 'Edit', 'phpmanual' ), '<span class="edit-link" style="float:right">', '</span>' ); ?>

                    <?php comment_text(); ?>

                    <div class="reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'phpmanual' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div><!-- .reply -->

                </div>
            </div>
            <!--  PHP Manual Tempalte -->



            <?php
                break;
                endswitch; // end comment_type check
        }
        endif;
?>
<div style="clear: both;"></div>
<section id="usernotes">
    <div class="head">
        <span class="action"><a href="#respond"><img src="http://static.php.net/www.php.net/images/notes-add.gif" alt="add a note" width="13" height="13" class="middle"></a> <small><a href="#respond">add a note</a></small></span>
        <h3 class="title"><?php
            printf( _n( 'User Contributed Notes <span class="count"><strong>%1$s note</strong></span>', 'User Contributed Notes <span class="count"><strong>%1$s notes</strong></span>', get_comments_number(), 'phpmanual' ),
                number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
        ?></h3>
    </div>
    <?php // You can start editing here -- including this comment! ?>

    <?php if ( have_comments() ) : ?>
        <div id="allnotes">
            <?php wp_list_comments( array( 'callback' => 'phpmanual_comment', 'style' => 'ol' ) ); ?>
        </div>   

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
                <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'phpmanual' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'phpmanual' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'phpmanual' ) ); ?></div>
            </nav>
            <?php endif; // check for comment navigation ?>

        <?php

            if ( ! comments_open() && get_comments_number() ) : ?>
            <p class="nocomments"><?php _e( 'Comments are closed.' , 'phpmanual' ); ?></p>
            <?php endif; ?>

        <?php endif; // have_comments() ?>

    <?php comment_form(); ?>
    <div class="foot"><a href="#respond"><img src="http://static.php.net/www.php.net/images/notes-add.gif" alt="add a note" width="13" height="13" class="middle"></a> <small><a href="#respond">add a note</a></small></div>
</section>