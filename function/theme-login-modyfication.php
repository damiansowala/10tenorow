<?php
/* ========================================================================================================================
Custom login modyfication
======================================================================================================================== */
function my_custom_login()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/custom-login-style.css" />';
}

function my_login_logo_url()
{
    return get_bloginfo('url');
}

function my_login_logo_url_title()
{
    $name = get_bloginfo('name');
    return $name;
}