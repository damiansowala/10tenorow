<?php
/* ========================================================================================================================
Display Logo Theme
======================================================================================================================== */
function logo()
{
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
    if (has_custom_logo()) {
        echo '<h1><img class="img-fluid" src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '"></h1>';
    } else {
        echo '<h1 class="header">' . get_bloginfo('name') . '</h1>';
    }
}

function themename_custom_logo_setup()
{
    $defaults = array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}