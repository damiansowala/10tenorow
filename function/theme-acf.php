<?php

function register_acf_options_pages()
{
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page(array(
        'page_title' => __('Formularze kontaktowe'),
        'menu_title' => __('Formularze'),
        'menu_slug' => 'theme-general-form',
        'capability' => 'edit_posts',
        'redirect' => false,
    ));

    acf_add_options_page(array(
        'page_title' => __('Social Media'),
        'menu_title' => __('Social Media'),
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
    ));

    acf_add_options_page(array(
        'page_title' => __('Komunikaty'),
        'menu_title' => __('Komunikaty'),
        'menu_slug' => 'theme-general-info',
        'capability' => 'edit_posts',
        'redirect' => false,
    ));

}

add_action('acf/init', 'register_acf_options_pages');