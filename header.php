<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>

    <title><?php
        /*
        * Print the <title> tag based on what is being viewed.
        */
        global $page, $paged;

        wp_title( '|', true, 'right' );

        // Add the blog name.
        bloginfo( 'name' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | {$site_description}";

        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
            echo ' | ' . sprintf( __( 'Page %s', 'phpmanual' ), max( $paged, $page ) );

    ?></title>

    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon.ico" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="alternate" type="application/atom+xml" href="<?php echo get_bloginfo('atom_url');?>" title="PHP Release feed" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="all" />



    <!--[if lte IE 7]>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/styles/workarounds.ie7.css" media="screen" />
    <![endif]-->

    <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/styles/workarounds.ie9.css" media="screen" />
    <![endif]-->

    <!--[if IE]>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
    <![endif]-->

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js"></script>
    <script type="text/javascript">
        if (typeof jQuery == 'undefined') {
            document.write('<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-1.7.2.min.js"><' + '/script>');
            document.write('<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-ui-1.8.7.min.js"><' + '/script>');
        }
    </script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.ui.totop.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/common.js?v=1376049384"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/usernotes.js"></script>
     <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
    // $selected_menu =  get_option('phpmanual_header_menu'); 
    $menu_items = get_header_menu_items();//wp_get_nav_menu_items($selected_menu,array());
?>
<nav id="headnav">

    <ul id="headmenu">
        <?php get_search_form(); ?>

        <li id="headhome" class="parent current">
            <a href="/" rel="home" class="menu-link">Home</a>
            <?php if(is_home() && get_option('phpmanual_show_release') == "1" ):?>
                <div class="children downloads">
                    <div class="children-1">
                        <div class="children-2">
                            <div class="download">
                                <h2>Download PHP</h2>
                                <ul class="download-list">
                                    <li rel="/downloads.php#v5.5.1">
                                        <a href="/downloads.php#v5.5.1" class="version" title="Download PHP">PHP 5.5.1</a>
                                        <a href="/ChangeLog-5.php#5.5.1" title="Release Notes for 5.5.1">Release Notes</a>
                                        <!-- (size) should go here, but it's not in version.inc at present -->
                                    </li>
                                    <li rel="/downloads.php#v5.4.17">
                                        <a href="/downloads.php#v5.4.17" class="version" title="Download PHP">PHP 5.4.17</a>
                                        <a href="/ChangeLog-5.php#5.4.17" title="Release Notes for 5.4.17">Release Notes</a>
                                        <!-- (size) should go here, but it's not in version.inc at present -->
                                    </li>
                                    <li rel="/downloads.php#v5.3.27">
                                        <a href="/downloads.php#v5.3.27" class="version" title="Download PHP">PHP 5.3.27</a>
                                        <a href="/ChangeLog-5.php#5.3.27" title="Release Notes for 5.3.27">Release Notes</a>
                                        <!-- (size) should go here, but it's not in version.inc at present -->
                                    </li>
                                </ul>
                            </div>
                            <div class="children-left">
                                <div class="what-is-php-container">
                                    <div class="what-is-php downloads-">
                                        <?php echo get_option('phpmanual_home_content') ;  ?>
                                    </div>
                                </div>
                            </div>
                            <br style="clear: both;" />
                        </div>
                    </div>
                </div>
                <?php endif; ?>
        </li>
        <?php foreach($menu_items as $menu_item): if($menu_item->menu_item_parent != 0) continue; ?>
            <li class="parent ">
                <a href="<?php echo $menu_item->url; ?>" class="menu-link"><?php echo $menu_item->title; ?></a>
                <div class="children" id="menu_<?php echo $menu_item->ID; ?>">
                    <div class="children-1">
                        <div class="children-2">
                            <?php foreach($menu_items as $menu_sub_item): if($menu_sub_item->menu_item_parent != $menu_item->ID) continue; ?>
                                <dl>
                                    <?php if(empty($menu_sub_item->url) || trim($menu_sub_item->url) == "#"):?>
                                        <dt><?php echo $menu_sub_item->title; ?></dt>
                                        <?php else:?>
                                        <dt><a href="<?php echo $menu_sub_item->url; ?>" title="<?php echo $menu_sub_item->title; ?>"><?php echo $menu_sub_item->title; ?></a></dt>
                                        <?php endif;?>
                                    <?php foreach($menu_items as $menu_sub_sub_item): if($menu_sub_sub_item->menu_item_parent != $menu_sub_item->ID) continue; ?>
                                        <dd><a href="<?php echo $menu_sub_sub_item->url; ?>" title="<?php echo $menu_sub_sub_item->title; ?>"><?php echo $menu_sub_sub_item->title; ?></a></dd>
                                        <?php endforeach; ?>
                                </dl>
                                <?php endforeach; ?>
                            <br style="clear: both;" />

                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach;?>

    </ul>
    <br style="clear: both;" />
</nav>

<div id='mega-drop-down'>
    <div id='menu-container'>
    </div>
</div>

<div id="layout"> 