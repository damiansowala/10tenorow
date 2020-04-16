<?php
    function menu_page_removal() {
        global $menu;
        $menu[5][0] = __('Blog','textdomain');
    }
    add_action( 'admin_menu', 'menu_page_removal');