<?php
/*
========================================================================================================================
Class Wordpress Function
========================================================================================================================
 */
class wpFn
{

    public static function term_id_prefixed()
    {
        $queried_object = get_queried_object();
        $taxonomy = $queried_object->taxonomy;
        $term_id = $queried_object->term_id;

        $term_id_prefixed = $taxonomy . '_' . $term_id;

        return $term_id_prefixed;

    }

    public static function print_a($a)
    {
        print('
        <pre>');
        print_r($a, true);
        print('</pre>');
    }
    public static function get_template_parts($parts = array())
    {
        foreach ($parts as $part) {
            get_template_part($part);
        };
    }
    public static function get_page_id_from_path($path)
    {
        $page = get_page_by_path($path);
        if ($page) {
            return $page->ID;
        } else {
            return null;
        };
    }
    public static function add_slug_to_body_class($classes)
    {
        global $post;
        if (is_home()) {
            $key = array_search('blog', $classes);
            if ($key > -1) {
                unset($classes[$key]);
            };
        } elseif (is_page()) {
            $classes[] = sanitize_html_class($post->post_name);
        } elseif (is_singular()) {
            $classes[] = sanitize_html_class($post->post_name);
        };
        return $classes;
    }
    public static function get_category_id($cat_name)
    {
        $term = get_term_by('name', $cat_name, 'category');
        return $term->term_id;
    }
    public static function pagination_bar()
    {
        global $wp_query;
        $total_pages = $wp_query->max_num_pages;
        if ($total_pages > 1) {
            $current_page = max(1, get_query_var('paged'));

            echo paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => '/page/%#%',
                'current' => $current_page,
                'total' => $total_pages,
                'prev_text' => __('<i class="fas fa-angle-left"></i>'), 'next_text' => __('<i class="fas fa-angle-right"></i>'),
            ));

        }
    }
    public static function getPostCategory($postType, $catID, $numberPosts)
    {
        $args = array(
            'post_type' => $postType,
            'category' => $catID,
            'post_status' => 'publish',
            'orderby' => 'rand',
            'posts_per_page' => $numberPosts,
        );
        return $args;
    }
    public static function getPostBlog($postType, $numberPosts)
    {
        $args = array(
            'post_type' => $postType,
            'post_status' => 'publish',
            'orderby' => 'rand',
            'order' => 'ASC',
            'posts_per_page' => $numberPosts,
        );
        return $args;
    }

    public static function getPostEvent()
    {
        $args = array(
            'post_type' => 'events',
            'post_status' => 'publish',
            'posts_per_page' => 24,
        );
        return $args;
    }

    public static function getPostBlogACF($postType, $numberPosts)
    {
        $args = array(
            'post_type' => $postType,
            'post_status' => 'publish',
            'posts_per_page' => $numberPosts,
            'meta_query' => array(
                'relation' => 'AND',
                'start' => array(
                    'key' => 'kiedy_$_data',
                    'value' => '01/12/2019',
                    'compare' => '>',
                ),
                'stop' => array(
                    'key' => 'kiedy_$_data',
                    'value' => '31/12/2019',
                    'compare' => '<',
                ),
            ),
        );
        return $args;
    }
    public static function getCategory($name)
    {
        $args = array(
            'orderby' => $name,
            'show_count' => true,
            'title_li' => '',
            'hierarchical' => 1,
            'exclude' => array(10),
        );
        return $args;
    }

    public static function cptCreateSubMenu($type, $name, $slug, $menu)
    {
        register_post_type($type,
            array(
                'labels' => array(
                    'name' => esc_attr__($name),
                    'singular_name' => esc_attr__($name),
                ),
                'public' => false,
                'show_ui' => true,
                'show_in_menus' => $menu,
                'rewrite' => array('slug' => $slug),
                'supports' => array('title', 'thumbnail', 'editor', 'page-attributes'),
            )
        );
    }

    public static function cptCreate($type, $name, $slug, $icons)
    {
        register_post_type($type,
            array(
                'labels' => array(
                    'name' => esc_attr__($name),
                    'singular_name' => esc_attr__($name),
                    'archives' => __(esc_attr__($name)),
                    'add_new' => esc_attr__('Dodaj'),
                    'add_new_item' => esc_attr__('Dodaj'),

                ),
                'menu_icon' => $icons,
                'public' => true,
                'has_archive' => true,
                'hierarchical' => false,
                'show_in_nav_menus' => true,
                'rewrite' => array('slug' => $slug),
                'supports' => array('title', 'thumbnail', 'editor', 'page-attributes'),
            )
        );
    }
    public static function excerpt($limit)
    {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt) . '...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
        return $excerpt;
    }

    public static function content($limit)
    {
        $content = explode(' ', get_the_content(), $limit);
        if (count($content) >= $limit) {
            array_pop($content);
            $content = implode(" ", $content) . '...';
        } else {
            $content = implode(" ", $content);
        }
        $content = preg_replace('/[.+]/', '', $content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]>', $content);
        return $content;
    }
}

class myacf
{
    public static function social_media()
    {
        if (have_rows('media', 'option')):
            while (have_rows('media', 'option')): the_row();
                if (get_sub_field('facebook')) {
                    echo '<li><a class="facebook" target="_blank" href="' . get_sub_field('facebook') . '"><i class="fab fa-facebook-f"></i></a></li>';
                }
                if (get_sub_field('instagram')) {
                    echo '<li><a class="instagram" target="_blank" href="' . get_sub_field('instagram') . '"><i class="fab fa-instagram"></i></a></li>';
                }
                if (get_sub_field('youtube')) {
                    echo '<li><a class="youtube" target="_blank" href="' . get_sub_field('youtube') . '"><i class="fab fa-youtube"></i></a></li>';
                }
                if (get_sub_field('twitter')) {
                    echo '<li><a class="twitter" target="_blank" href="' . get_sub_field('twitter') . '"><i class="fab fa-twitter"></i></a></li>';
                }
                if (get_sub_field('pinterest')) {
                    echo '<li><a class="youtube" target="_blank" href="' . get_sub_field('pinterest') . '"><i class="fab fa-pinterest-p"></i></a></li>';
                }
                if (get_sub_field('snapchat')) {
                    echo '<li><a class="snapchat" target="_blank" href="' . get_sub_field('snapchat') . '"><i class="fab fa-snapchat-ghost"></i></a></li>';
                }
                if (get_sub_field('linkedin')) {
                    echo '<li><a class="linkedin" target="_blank" href="' . get_sub_field('snapchat') . '"><i class="fab fa-linkedin-ghost"></i></a></li>';
                }
            endwhile;
        endif;
    }
}

class ticets
{

    public static function showLogoTicets($name, $link, $event)
    {
        if ('' == $name):
        elseif ('kupbileci.pl' == $name):
            echo '<a href="' . $link . '" title="Kup bilet na ' . $name . '"><img class="img-fluid" src="' . get_template_directory_uri() . '/images/kupbilecik.png" alt="agencja brussa, ' . $name . ', ' . $event . '"></a>';
        elseif ('kupbilet.pl' == $name):
            echo '<a href="' . $link . '" title="Kup bilet na ' . $name . '"><img class="img-fluid" src="' . get_template_directory_uri() . '/images/kupbilet.png" alt="agencja brussa, ' . $name . ', ' . $event . '"></a>';
        elseif ('empikbilety.pl' == $name):
            echo '<a href="' . $link . '" title="Kup bilet na ' . $name . '"><img class="img-fluid" src="' . get_template_directory_uri() . '/images/empikbilety.png" alt="agencja brussa, ' . $name . ', ' . $event . '"></a>';
        elseif ('eventim.pl' == $name):
            echo '<a href="' . $link . '" title="Kup bilet na ' . $name . '"><img class="img-fluid" src="' . get_template_directory_uri() . '/images/eventim.png" alt="agencja brussa, ' . $name . ', ' . $event . '"></a>';
        elseif ('biletyna.pl' == $name):
            echo '<a href="' . $link . '" title="Kup bilet na ' . $name . '"><img class="img-fluid" src="' . get_template_directory_uri() . '/images/biletyna.png" alt="agencja brussa, ' . $name . ', ' . $event . '"></a>';
        elseif ('ebilet.pl' == $name):
            echo '<a href="' . $link . '" title="Kup bilet na ' . $name . '"><img class="img-fluid" src="' . get_template_directory_uri() . '/images/ebilet.png" alt="agencja brussa, ' . $name . ', ' . $event . '"></a>';
        elseif ('bilety24.pl' == $name):
            echo '<a href="' . $link . '" title="Kup bilet na ' . $name . '"><img class="img-fluid" src="' . get_template_diarectory_uri() . '/images/bilety24.png" alt="agencja brussa, ' . $name . ', ' . $event . '"></a>';
        elseif ('ticketmaster.pl' == $name):
            echo '<a href="' . $link . '" title="Kup bilet na ' . $name . '"><img class="img-fluid" src="' . get_template_directory_uri() . '/images/ticketmaster.png" alt="agencja brussa, ' . $name . ', ' . $event . '"></a>';
        elseif ('abilet.pl' == $name):
            echo '<a href="' . $link . '" title="Kup bilet na ' . $name . '"><img class="img-fluid" src="' . get_template_directory_uri() . '/images/abilet.jpg" alt="agencja brussa, ' . $name . ', ' . $event . '"></a>';
        elseif ('evenea.pl' == $name):
            echo '<a href="' . $link . '" title="Kup bilet na ' . $name . '"><img class="img-fluid" src="' . get_template_directory_uri() . '/images/evenea.png" alt="agencja brussa, ' . $name . ', ' . $event . '"></a>';
        endif;
    }

}
function the_cpt_name()
{
    $postType = get_post_type_object(get_post_type());
    if ($postType) {
        echo esc_html($postType->labels->singular_name);
    }

}
function data_now()
{
    $now = date('Y');
    return $now;
}

function get_month_now()
{
    $now = date('n');
    return $now;
}
function the_month_name_now()
{
    $months = array('Styczeń' => 'January', 'Luty' => 'February', 'Marzec' => 'March', 'Kwiecień' => 'April', 'Maj' => 'May', 'Czerwiec' => 'June', 'Lipiec' => 'July', 'Sierpień' => 'August', 'Wrzesień' => 'September', 'Październik' => 'October', 'Listopad' => 'November', 'Grudzień' => 'December');
    $name = array_search(date("F", strtotime(date('F'))), $months);
    echo $name;
}

function the_display_only_month($old_date)
{
    echo date("m", strtotime($old_date));
}

function get_display_only_month($old_date)
{
    return date("m", strtotime($old_date));
}

function the_display_only_day($old_date)
{
    echo date("d", strtotime($old_date));
}

function get_display_only_day($old_date)
{
    return date("d", strtotime($old_date));
}
function the_display_only_year($old_date)
{
    echo date("Y", strtotime($old_date));
}

function get_display_only_year($old_date)
{
    return date("Y", strtotime($old_date));
}

function the_convert_month($date)
{
    $months = array('STY' => 'January', 'LUT' => 'February', 'MAR' => 'March', 'KWI' => 'April', 'Maj' => 'May', 'CZE' => 'June', 'LIP' => 'July', 'SIE' => 'August', 'WRZ' => 'September', 'PAŹ' => 'October', 'LIS' => 'November', 'GRU' => 'December');
    $name = array_search(date("F", strtotime($date)), $months);
    echo $name;
}

function the_convert_day($date)
{
    $days = array('Poniedziałek' => 'January', 'Wtorek' => 'Tuesday', 'Środa' => 'Wednesday', 'Czwartek' => 'Thursday', 'Piątek' => 'Friday', 'Sobota' => 'Saturday', 'Niedziela' => 'Sunday');
    $name = array_search(date("l", strtotime($date)), $days);
    echo $name;
}

function video_header($iframe)
{
    preg_match('/src="(.+?)"/', $iframe, $matches);
    $src = $matches[1];
    $params = array(
        'controls' => 0,
        'hd' => 0,
        'autohide' => 1,
        'autobuffer' => 1,
        'autoplay' => 0,
    );
    $new_src = add_query_arg($params, $src);
    $iframe = str_replace($src, $new_src, $iframe);
    $attributes = 'frameborder="0"';
    $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
    echo $iframe;
}

function the_category_name($taxonomy)
{
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'orderby' => 'name',
        'order' => 'ASC',
    ));

    if ($terms && !is_wp_error($terms)):
        foreach ($terms as $term):
            $name = $term->name;
            if ('Wszystkie' === $name):
                echo '<option value="' . $name . '" selected>' . $name . '</option>';
            else:
                echo '<option value="' . $name . '">' . $name . '</option>';
            endif;
        endforeach;
    endif;
}

function the_display_month_list()
{
    for ($i = 0; $i < 12; $i++) {
        $timestamp = mktime(0, 0, 0, date('m') - $i, 0);

        $months = array('Styczeń' => 'January', 'Luty' => 'February', 'Marzec' => 'March', 'Kwiecień' => 'April', 'Maj' => 'May', 'Czerwiec' => 'June', 'Lipiec' => 'July', 'Sierpień' => 'August', 'Wrzesień' => 'September', 'Październik' => 'October', 'Listopad' => 'November', 'Grudzień' => 'December');

        $pl = array_search(date("F", strtotime(date('F', $timestamp))), $months);
        $nr = date("m", strtotime(date('F', $timestamp)));

        if (date('F', $timestamp) == date('F')):
            echo '<option value="' . $nr . '" selected>' . $pl . '</option>';
        else:
            echo '<option value="' . $nr . '" >' . $pl . '</option>';
        endif;
    }
}

function the_display_only_year_list()
{
    for ($i = 0; $i < 8; $i++) {
        $now = date('Y');
        $year = $now - 4;
        $year = $year + $i;
        if ($year == $now):
            echo '<option value="' . $year . '" selected>' . $year . '</option>';
        else:
            echo '<option value="' . $year . '" >' . $year . '</option>';
        endif;
    }
}

function catCustom()
{
    $cats = get_the_category($post->ID);
    $parent = get_category($cats[1]->category_parent);
    if (is_wp_error($parent)) {
        $cat = get_category($cats[0]);
    } else {
        $cat = $parent;
    }
    echo '<a href="' . get_category_link($cat) . '">' . $cat->name . '</a>';
}

function sum($a, $b)
{
    $sum = $a + $b;
    return $sum;
}

function term_category_prefix()
{
    $categories = get_the_terms($post->ID, "events-category");
    $term_id_prefixed = 'events-category_' . $categories[0]->term_id;
    return $term_id_prefixed;
}

function status_event($var)
{
    if (2 == $var):
        echo "event-postponed";
    elseif (1 == $var):
        echo "event-cancelled";
    endif;
}

function display_acf_see_more_link($field)
{
    $link = $field;
    if ($link):
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
<a href="<?php echo esc_url($link_url); ?>"
    target="<?php echo esc_attr($link_target); ?>"><?php echo __('Zobacz termin'); ?></a>
<?php endif;
}

function event_columns($columns)
{
    $columns = array(
        'cb' => '< input type="checkbox" />',
        'title' => 'Wydarzenie',
        'event-date' => 'Data wydarzenia',
        'event-link' => 'Link do wydarzenia',
        'event-hour' => 'Godzina wydarzenia',
        'event-place' => 'Miejsce wydarzenia',
        'event-status' => 'Status wydarzenia',

    );
    return $columns;
}

function link_column($column)
{
    global $post;
    if ('event-link' == $column) {
        esc_url(the_permalink());
    } else {
        echo '';
    }
}

function event_column($column)
{
    global $post;
    if ('event-date' == $column) {
        if (have_rows('kiedy', $post->ID)):
            while (have_rows('kiedy', $post->ID)): the_row();
                the_sub_field('data', $post->ID);
            endwhile;
        endif;
    } else {
        echo '';
    }
}

function status_column($column)
{
    global $post;
    if ('event-status' == $column) {
        if (get_field('opcje', $post->ID) == 0):
            echo "Według planu";
        endif;
        if (get_field('opcje', $post->ID) == 1):
            echo "Odwołane";
        endif;
        if (get_field('opcje', $post->ID) == 2):
            echo "Przeniesione";
        endif;
    } else {
        echo '';
    }
}

function hour_column($column)
{
    global $post;
    if ('event-hour' == $column) {
        if (have_rows('czas', $post->ID)):
            while (have_rows('czas', $post->ID)): the_row();
                the_sub_field('rozpoczecie', $post->ID);
            endwhile;
        endif;
    } else {
        echo '';
    }
}

function place_column($column)
{
    global $post;
    if ('event-place' == $column) {
        if (have_rows('gdzie', $post->ID)):
            while (have_rows('gdzie', $post->ID)): the_row();
                the_sub_field('obiekt');
                echo ', ';
                the_sub_field('miasto');
            endwhile;
        endif;
    } else {
        echo '';
    }
}

add_action("manage_events_posts_custom_column", "link_column");
add_action("manage_events_posts_custom_column", "place_column");
add_action("manage_events_posts_custom_column", "hour_column");
add_action("manage_events_posts_custom_column", "status_column");
add_action("manage_events_posts_custom_column", "event_column");
add_filter("manage_edit-events_columns", "event_columns");