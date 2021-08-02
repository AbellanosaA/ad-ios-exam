<?php
/*
Plugin Name: Todo
Description: Declares a plugin that will create a custom post type displaying todo.
*/

add_action( 'init', 'create_todo' );
function create_todo() {
    register_post_type( 'todo',
        array(
            'labels' => array(
                'name' => 'Todo',
                'singular_name' => 'Todo',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Todo',
                'edit' => 'Edit',
                'edit_item' => 'Edit Todo',
                'new_item' => 'New Todo',
                'view' => 'View',
                'view_item' => 'View Todo',
                'search_items' => 'Search Todos',
                'not_found' => 'No Todos found',
                'not_found_in_trash' => 'No Todos found in Trash',
                'parent' => 'Parent Todo'
            ),
 
            'public' => true,            
            'rewrite' => array('slug' => 'todo'),
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail' ),
            'taxonomies' => array( '' ),            
            'has_archive' => false
        )
    );
}
add_action( 'admin_init', 'my_admin' );
function my_admin() {
    add_meta_box( 'todo_meta_box',
        'Todo Details',
        'display_todo_meta_box',
        'todo', 'normal', 'high'
    );
}

function display_todo_meta_box( $todo ) {    
    $todo_custom_field = esc_html( get_post_meta( $todo->ID, 'todo_custom_field', true ) );    
    ?>
    <table>
        <tr>
            <td style="width: 100%">Todo Custom Field</td>
            <td><input type="text" size="80" name="todo_custom_field" value="<?php echo $todo_custom_field; ?>" /></td>
        </tr>        
    </table>
    <?php
}


add_action( 'save_post', 'add_todo_fields', 10, 2 );
function add_todo_fields( $todo_id, $todo ) {    
    if ( $todo->post_type == 'todo' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['todo_custom_field'] ) && $_POST['todo_custom_field'] != '' ) {
            update_post_meta( $todo_id, 'todo_custom_field', $_POST['todo_custom_field'] );
        }
    }
}

add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template_path ) {
    if ( get_post_type() == 'todo' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-todo.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-todo.php';
            }
        }
    }
    return $template_path;
}
?>