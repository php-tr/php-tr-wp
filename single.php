<?php get_header(); ?>

<section class="layout-content ">   
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="newsItem hentry vevent">
            <?php 
                if(has_post_thumbnail()): 
                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                    $medium_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
                ?>
                <div class="newsImage"><a href="<?php echo $large_image_url[0];?>"><img src="<?php  echo $medium_image_url[0]; ?>" alt="<?php echo the_title_attribute('echo=0'); ?>" width="350" style="float: right;"></a></div>
                <?php endif; ?>
            <h2 class="summary entry-title"><a name="post_<?php the_ID(); ?>" id="post_<?php the_ID(); ?>" rel="bookmark" class="bookmark"><?php the_title(); ?></a></h2>
            <div class="entry-content description">
                <abbr class="published newsdate" title="<?php echo the_date_xml(); ?>"><?php echo the_date(); ?></abbr>
                <div> 

                    <?php the_content(); ?>
                </div>

            </div>
        </div>
        <?php endwhile; // end of the loop. ?>

    <?php comments_template( '', true ); ?>
    </section><!-- layout-content -->
<?php get_footer(); ?>