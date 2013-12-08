<?php
/* 
Template Name: Archives
*/
?>
<?php
get_header(); ?>
<?php get_sidebar(); ?>
<div id="container">
    <div id="content" role="main">

        <?php the_post(); ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
    
        <h2>Archives by Month:</h2>
        <ul>
            <?php wp_get_archives('type=monthly'); ?>
        </ul>
        
        <h2>Archives by Subject:</h2>
        <ul>
             <?php wp_list_categories(); ?>
        </ul>

    </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>