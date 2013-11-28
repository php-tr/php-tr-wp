<?php get_header(); ?>                             
<section class="layout-content home"> 
    <?php if ( have_posts() ) : ?> 
        <?php get_sidebar(); ?>
        <div class='home-content'> 
            <div id='recentNewsEntries'>
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class='newsItem hentry'>
                        <div class='newsImage'></div>
                        <h2 class='summary entry-title'><a name='id<?php echo the_ID(); ?>' id='id<?php echo the_ID(); ?>' href='<?php the_permalink(); ?>' rel='bookmark' class='bookmark'><?php echo the_title(); ?></a></h2>
                        <div eclass='entry-content description'>
                            <abbr class='published newsdate' title='<?php the_date_xml(); ?>'><?php the_date(); ?></abbr>
                            <div>
                                <?php the_content( __( 'More <span class="meta-nav">&rarr;</span>', 'phpmanual' ) ); ?>
                            </div>

                        </div>
                    </div>
                    <?php endwhile; ?>
                <p class='newsArchive'><a href='/archive/'>More news &raquo;</a></p>
            </div>
        </div>
        <?php else: ?>
        <?php get_template_part('google-search'); ?>
        <?php endif; ?>
    </section>
<?php get_footer(); ?>