<?php

    add_action( 'init', 'create_team_member' );

    function create_team_member() {
        register_post_type( 'team_members',
            array(
                'labels' => array(
                    'name' => 'Team Members',
                    'singular_name' => 'Team Member',
                    'add_new' => 'Add New',
                    'add_new_item' => 'Add New Team Member',
                    'edit' => 'Edit',
                    'edit_item' => 'Edit Team Member',
                    'new_item' => 'New Team Member',
                    'view' => 'View',
                    'view_item' => 'View Team Member',
                    'search_items' => 'Search Team Members',
                    'not_found' => 'No Team Members found',
                    'not_found_in_trash' => 'No Team Members found in Trash',
                    'parent' => 'Parent Team Member'
                ),
    
                'public' => true,
                'menu_position' => 15,
                'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
                'taxonomies' => array( '' ),
                'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
                'has_archive' => true
            )
        );
    }

?>