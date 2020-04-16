<?php
/* ========================================================================================================================
Custome Post Type
======================================================================================================================== */

function ctp()
{
    wpFn::cptCreate('road', 'Miasta', 'trasa-koncertowa', 'dashicons-book-alt');
    wpFn::cptCreate('tenors', 'Tenorzy', 'sklad-tenorow', 'dashicons-microphone');
    wpFn::cptCreate('gallery', 'Galeria', 'koncert-10-tenorow', 'dashicons-microphone');
    wpFn::cptCreate('albums', 'Płyty', 'plyta-10-tenorow', 'dashicons-microphone');
    wpFn::cptCreate('media', 'Materiały promocyjne', 'materialy-promocyjne', 'dashicons-microphone');
}

function road_category()
{
    register_taxonomy(
        'road-category',
        'road',
        array(
            'label' => __('Trasy koncertowe'),
            'rewrite' => array('slug' => 'trasy-koncertowe'),
            'hierarchical' => true,
        )
    );
}

add_action('init', 'ctp');
add_action('init', 'road_category');

// AIzaSyD7hUGh__LGCHINuhwO1Nv2-58LJNtvO5I