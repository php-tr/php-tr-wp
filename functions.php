<?php
    add_theme_support( 'post-thumbnails' );
    add_action('admin_head', 'php_admin_head'); 
    add_action( 'init', 'register_phptr_menus' );
    add_action("admin_menu", "setup_phpmanual_menu");
    add_action( 'add_meta_boxes', 'documentation_add_custom_box' );

    function my_custom_post_documentation() {
        $labels = array(
            'name'               => _x( 'Documentation', 'post type general name' ),
            'singular_name'      => _x( 'Documentation', 'post type singular name' ),
            'add_new'            => _x( 'Add New', 'book' ),
            'add_new_item'       => __( 'Add New Doc' ),
            'edit_item'          => __( 'Edit Doc' ),
            'new_item'           => __( 'New Doc' ),
            'all_items'          => __( 'All Docs' ),
            'view_item'          => __( 'View Doc' ),
            'search_items'       => __( 'Search Doc' ),
            'not_found'          => __( 'No Doc found' ),
            'not_found_in_trash' => __( 'No Doc found in the Trash' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'Documentation'
        );

        $args = array(
            'labels'        => $labels,
            'description'   => 'Publish documentation about your software product',
            'public'        => true,
            'menu_position' => 15,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
            'has_archive'   => true,

        );
        register_post_type( 'documentation', $args );   
    }

    add_action( 'init', 'my_custom_post_documentation' );



    function my_taxonomies_documentation() {
        $labels = array(
            'name'              => _x( 'Doc Categories', 'taxonomy general name' ),
            'singular_name'     => _x( 'Doc Category', 'taxonomy singular name' ),
            'search_items'      => __( 'Search Doc Categories' ),
            'all_items'         => __( 'All Doc Categories' ),
            'parent_item'       => __( 'Parent Doc Category' ),
            'parent_item_colon' => __( 'Parent Doc Category:' ),
            'edit_item'         => __( 'Edit Doc Category' ), 
            'update_item'       => __( 'Update Doc Category' ),
            'add_new_item'      => __( 'Add New Doc Category' ),
            'new_item_name'     => __( 'New Doc Category' ),
            'menu_name'         => __( 'Doc Categories' ),
        );
        $args = array(
            'labels' => $labels,                                            
            'hierarchical' => true,
        );
        register_taxonomy( 'doc_category', 'documentation', $args );
    }

    add_action( 'init', 'my_taxonomies_documentation', 0 );       


    function documentation_add_custom_box()
    {
        // Use nonce for verification
        wp_nonce_field( plugin_basename( __FILE__ ), 'phpmanual_noncename' );

        add_meta_box(
            'phpmanual_doc_fields',
            __( 'Documentation Fields', 'phpmanual_textdomain' ),
            'phpmanual_inner_custom_box',
            "documentation"
        );
    }


    /* Prints the box content */
    function myplugin_inner_custom_box( $post ) {

        // Use nonce for verification
        wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );

        // The actual fields for data entry
        // Use get_post_meta to retrieve an existing value from the database and use the value for the form
        $value = get_post_meta( $post->ID, '_my_meta_value_key', true );
        echo '<label for="myplugin_new_field">';
        _e("Description for this field", 'myplugin_textdomain' );
        echo '</label> ';
        echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="'.esc_attr($value).'" size="25" />';
    }    




    function register_phptr_menus() 
    {      
        register_nav_menu( 'header_menu', 'Header Menu' );
        register_nav_menu( 'footer_links', 'Footer Links' );
    }

    function php_admin_head()
    {
        echo '<style>div.wp-menu-image.php-icon{padding: 0px !important;background-image: url(\''.get_template_directory_uri().'/assets/img/php.png\');}</style>';
    }     

    function setup_phpmanual_menu() 
    {  
        add_submenu_page('themes.php',   
            'PHP Manual Menu', '<div class="wp-menu-image php-icon"></div>PHP Manual', 'manage_options',   
            'php-manual', 'phpmanual_settings');   
    }  

    function get_header_menu_items()
    {
        $locations = get_registered_nav_menus();
        $menus = wp_get_nav_menus();
        $menu_locations = get_nav_menu_locations();

        $location_id = 'header_menu';

        if (isset($menu_locations[ $location_id ])) 
        {
            foreach ($menus as $menu) 
            {
                if ($menu->term_id == $menu_locations[ $location_id ]) 
                {  
                    return wp_get_nav_menu_items($menu); 
                }
            }
        }        
    ?>
    <div class="error-message">"Header Menu" does not contain a navigation menu. Please <a href="<?php echo  get_admin_url()?>nav-menus.php">build</a> and <a href="<?php echo  get_admin_url()?>customize.php">select</a></div>
    <?php
    }   


    function get_footer_links()
    {
        $locations = get_registered_nav_menus();
        $menus = wp_get_nav_menus();
        $menu_locations = get_nav_menu_locations();

        $location_id = 'footer_links';

        if (isset($menu_locations[ $location_id ])) 
        {
            foreach ($menus as $menu) 
            {
                if ($menu->term_id == $menu_locations[ $location_id ]) 
                {  
                    return wp_get_nav_menu_items($menu); 
                }
            }
        }        
    ?>
    <div class="error-message">"Footer Links" does not contain a navigation menu. Please <a href="<?php echo  get_admin_url()?>nav-menus.php">build</a> and <a href="<?php echo  get_admin_url()?>customize.php">select</a></div>
    <?php
    }      

    function phpmanual_settings()
    {

        $categories =   get_categories(array('hide_empty'=>false));

        if(isset($_POST['save_phpmanual_settings']))
        {
            update_option('phpmanual_home_content', stripslashes(wp_filter_post_kses(addslashes($_POST['content']))));
            update_option('phpmanual_doc_categories', implode(',',$_POST['selected_categories']));
            update_option('phpmanual_google_custom_search_api_key', $_POST['google_custom_search_api_key']);
            update_option('phpmanual_release_category', $_POST['release_category']);
            update_option('phpmanual_show_release',(int) isset($_POST['show_release']));
        ?>
        <div id="message" class="updated">Settings saved</div>  
        <?php
        }      
    ?>
    <script type="text/javascript">
        function checkRelease()
        {
            if(jQuery('#show_release').is(':checked'))
                jQuery('#release_category_tr,#release_content_tr').show(); 
            else
                jQuery('#release_category_tr,#release_content_tr').hide(); 
        }                                
        jQuery(document).ready(function(){
            checkRelease();
        });
    </script>
    <div class="wrap">  
        <?php screen_icon('themes'); ?> <h2>PHP Manual Theme Settings</h2>  
        <form method="POST" action="">  
            <table class="form-table">  
                <tr valign="top" class="even">  
                    <th scope="row">  
                        <label for="num_elements">  
                            <b>Documentation Categories:</b><br />
                            <span class="small-text">Select sub categories also.</span>  
                        </label>   
                    </th>  
                    <td>  
                        <select name="selected_categories[]" multiple="multiple" size="5">
                            <?php  
                                $selected_categories =  explode(',', get_option('phpmanual_doc_categories')); 
                                foreach($categories as  $category):
                                ?>
                                <option value="<?php echo $category->cat_ID; ?>"<?php if(in_array($category->cat_ID,$selected_categories)):?> selected="selected"<?php endif; ?>><?php echo $category->cat_name; ?></option>
                                <?php endforeach; ?>
                        </select>
                    </td>  
                </tr>
                <tr><th><label for="show_release"><b>Show Release (Downloades) Section</b></label></th><td><input type="checkbox" id="show_release" name="show_release" onchange="checkRelease()" <?php if(get_option('phpmanual_show_release') == "1"):?> checked="checked"<?php endif;?>/></td></tr>
                <tr id="release_category_tr" style="display: none;" valign="top" class="odd">  
                    <th scope="row">  
                        <label for="release_category">  
                            <b>Release Posts Category:</b><br />
                        </label>   
                    </th>  
                    <td>  
                        <select name="release_category">
                            <?php  
                                $release_category =   get_option('phpmanual_release_category'); 
                                foreach($categories as  $category):
                                ?>
                                <option value="<?php echo $category->cat_ID; ?>"<?php if($category->cat_ID == $release_category):?> selected="selected"<?php endif; ?>><?php echo $category->cat_name; ?></option>
                                <?php endforeach; ?>
                        </select>
                    </td>  
                </tr>
                <tr id="release_content_tr" style="display: none;" ><td colspan="2">
                        <h3><label for="content">Content to show on release section:</label></h3>
                        <textarea name="content" cols="100" rows="6"><?php echo html_entity_decode( get_option('phpmanual_home_content')); ?></textarea>
                    </td></tr>
                <tr>
                    <th><label for="google_custom_search_api_key">Google Custom Search Api Key</label></th>
                    <td><input type="text" name="google_custom_search_api_key" size="53" id="google_custom_search_api_key" value="<?php echo get_option('phpmanual_google_custom_search_api_key'); ?>"/></td>
                </tr>
                <tr valign="top">  
                    <td colspan="2">  
                        <input type="submit" name="save_phpmanual_settings" class="button-primary" value="Save Changes"/>
                    </td>  
                </tr> 
            </table>  
        </form>  
    </div>  

    <?php 
}