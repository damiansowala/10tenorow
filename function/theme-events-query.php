<?php

function event_query_start()
{
    $year = (string)date('Y');
    $month = (string)date('m');

    $query = array(
        'post_type' => 'events',
        'post_status' => 'publish',
        'posts_per_page' => -1,

        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'kiedy_data',
                'compare' => '>=',
                'value' => "" . $year . "" . $month . "" . '01',
                'type' => 'DATE',
            ),

            array(
                'key' => 'kiedy_data',
                'compare' => '<=',
                'value' => "" . $year . "" . $month . "" . '31',
                'type' => 'DATE',
            ),

        ),

        'meta_key' => 'kiedy_data',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',

    );
    return $query;

}

add_action('wp_ajax_nopriv_event_query_filter', 'event_query_filter');
add_action('wp_ajax_event_query_filter', 'event_query_filter');

function event_query_filter()
{
    $filter = array();
    $tax = array();

    $city = $_POST['filterCity'];
    $ticet = $_POST['filterTicets'];
    $allDay = $_POST['filterAllDay'];

    $manyDays = $_POST['filterManyDays'];
    $category = $_POST['filterCategory'];

    $month = $_POST['filterMonth'];
    $year = $_POST['filterYear'];

    if ($year && $month):
        if ('all' === $month):
            $start = "" . $year . "" . '0101';
            $stop = "" . $year . "" . '1231';
        else:
            $start = "" . $year . "" . $month . "" . '01';
            $stop = "" . $year . "" . $month . "" . '31';
        endif;
    else:
        $year = (string)date('Y');
        $month = (string)date('m');

        $start = "" . $year . "" . $month . "" . '01';
        $stop = "" . $year . "" . $month . "" . '31';

    endif;

    if ($category):
        $tax += array(
            array(
                'taxonomy' => 'events-category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    endif;

    if ($city):
        $filter += array(
            array(
                'key' => 'gdzie_miasto',
                'compare' => '=',
                'value' => $city,
            ),
        );
    endif;

    if ($ticet):
        $filter += array(
            'key' => 'bilety_wydarzenie_otwarte',
            'compare' => '=',
            'value' => $ticet,
        );
    endif;

    if ($allDay):
        $filter += array(
            'key' => 'kiedy_wydarzenie_calodniowe',
            'compare' => '=',
            'value' => $allDay,
        );
    endif;

    if ($manyDays):
        $filter += array(
            'key' => 'kiedy_wydarzenie_kilkudniowe',
            'compare' => '=',
            'value' => $manyDays,
        );
    endif;

    $query = array(
        'post_type' => 'events',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'tax_query' => $tax,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'kiedy_data',
                'compare' => '>=',
                'value' => $start,
                'type' => 'DATE',
            ),
            array(
                'key' => 'kiedy_data',
                'compare' => '<=',
                'value' => $stop,
                'type' => 'DATE',
            ),
            $filter,
        ),
        'meta_key' => 'kiedy_data',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
    );
    ?>

<?php $event = new WP_Query($query); ?>
<?php if ($event->have_posts()): ?> <?php while ($event->have_posts()): $event->the_post(); ?>

<?php if (have_rows('kiedy')): ?>
<?php while (have_rows('kiedy')): the_row(); ?>
<?php $start = get_sub_field('data'); ?>
<?php endwhile; ?>
<?php endif; ?>

<?php if (strtotime($start) >= strtotime(date('d-m-Y'))): ?>
<a class="event-item event-item__p0 <?php status_event(get_field('opcje')); ?>" data-event="active"
    href="<?php esc_url(the_permalink()); ?>">
    <span class="event-color"
        style="background-color: <?php the_field('kolor_kategorii', term_category_prefix()); ?>;"></span>
    <article class="row event-active">
        <span class="col-12 col-md-5 col-lg-3">
            <?php $plakat = get_field('plakat'); ?>
            <?php if ($plakat): ?>

            <span class="event-date event-date__ab">
                <span><?php the_convert_month($start); ?></span>
                <span><?php the_display_only_day($start); ?></span>
                <span><?php the_display_only_year($start); ?></span>
            </span>
            <img class="img-fluid" src="<?php echo $plakat['sizes']['cover']; ?>" alt="<?php echo $plakat['alt']; ?>" />
            <?php endif; ?>
        </span>
        <span class="col-12 col-md-7 col-lg-9">
            <h1><?php the_title(); ?></h1>
            <?php if (get_field('opcje') == 2): ?>
            <span>
                <i class="fas fa-exclamation-circle"></i>
                <?php echo __('Wydarzenie odbędzie się w innym terminie'); ?>
            </span>
            <?php elseif (get_field('opcje') == 1): ?>
            <span>
                <i class="fas fa-exclamation-circle"></i>
                <?php echo __('Wydarzenie odwołane'); ?>
            </span>
            <?php else: ?>
            <?php if (have_rows('czas')): ?>
            <?php while (have_rows('czas')): the_row(); ?>
            <span>
                <i class="fas fa-clock"></i> <?php the_sub_field('rozpoczecie'); ?>
                - <?php the_sub_field('zakonczenie'); ?>
            </span>
            <?php endwhile; ?>
            <?php endif; ?>
            <?php if (have_rows('gdzie')): ?>
            <?php while (have_rows('gdzie')): the_row(); ?>
            <span>
                <i class="fas fa-map-marker-alt"></i>
                <?php the_sub_field('miasto'); ?> - <?php the_sub_field('obiekt'); ?>
            </span>
            <?php endwhile; ?>
            <?php endif; ?>
            <?php endif; ?>
        </span>
    </article>
</a>

<?php else: ?>

<a class="event-item event-item__p0 <?php status_event(get_field('opcje')); ?>"
    href="<?php esc_url(the_permalink()); ?>">
    <span class="event-color"
        style="background-color: <?php the_field('kolor_kategorii', term_category_prefix()); ?>;"></span>
    <article class="row event-concluded">
        <span class="col-12 col-md-5 col-lg-3">
            <?php $plakat = get_field('plakat'); ?>
            <?php if ($plakat) { ?>
            <span class="event-date event-date__ab">
                <span><?php the_convert_month($start); ?></span>
                <span><?php the_display_only_day($start); ?></span>
                <span><?php the_display_only_year($start); ?></span>
            </span>
            <img class="img-fluid" src="<?php echo $plakat['sizes']['cover']; ?>" alt="<?php echo $plakat['alt']; ?>" />
            <?php } ?>
        </span>
        <span class="col-12 col-md-7 col-lg-9">
            <h5><?php the_title(); ?></h5>
            <span>
                <i class="fas fa-exclamation-circle"></i>
                <?php echo __('Wydarzenie już się odbyło.'); ?>
            </span>
        </span>
    </article>
</a>

<?php endif; ?>
<?php endwhile; ?>
<?php else: ?>

<h2 class="event-item-alert"><?php echo __('Brak wydarzeń'); ?></h2>

<?php endif; ?>
<?php

    die();

}