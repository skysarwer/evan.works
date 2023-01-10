<?php

class EVN_Menu_Walker extends Walker_Nav_Menu {
    /**
     * Starts the list before the elements are added.
     *
     * @see Walker::start_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );

        // Default class.
        $classes = array( 'sub-menu' );

        // ! Get parent item ID:
        $id = isset( $args->item_id ) ? ' id="submenu-' . absint( $args->item_id ) . '"' : '';

        /**
         * Filters the CSS class(es) applied to a menu list element.
         *
         * @since 4.8.0
         *
         * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
         * @param stdClass $args    An object of `wp_nav_menu()` arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        // ! Insert ID:
        $output .= "{$n}{$indent}<ul{$class_names}{$id}>{$n}";
    }
}

add_filter(
    'nav_menu_item_args',
    function( $args, $item, $depth ) {
        $args->item_id = $item->ID;

        return $args;
    },
    10,
    3
);


//Add custom dropdown filter to Primary Menu
add_filter( 'walker_nav_menu_start_el', 'evn_parent_menu_dropdown', 10, 4 );
function evn_parent_menu_dropdown( $item_output, $item, $depth, $args ) {

    if ( ! empty( $item->classes ) && in_array( 'menu-item-has-children', $item->classes ) ) {
        $stripped_item_output = preg_replace('/<a[^>]*>(.*)<\/a>/', '$1', $item_output);
        return '<span class="flex">'.$item_output . '<button class="submenu-toggle outline" aria-expanded="false" data-labelvalue="'.$stripped_item_output.'" aria-label="Expand '.$stripped_item_output.' sub-menu" aria-controls="submenu-'.$args->item_id.'">+</button></span>';
    }

    return $item_output;
}