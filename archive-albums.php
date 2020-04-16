<?php wpFn::get_template_parts(array('header')); ?>

<?php if (have_posts()): ?>

<div class="container albums">
    <?php while (have_posts()): the_post(); ?>
    <div class="row albums-card">
        <div class="col-12 col-md-3">
            <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bg320x240.jpg"
                    data-src="<?php echo the_post_thumbnail_url('full'); ?>" class="img-fluid"
                    alt="Płyta: <?php the_title(); ?>">
            </a>
        </div>
        <div class="col-12 col-md-6">
            <a href="<?php esc_url(the_permalink()); ?>" title="Informacje o <?php the_title(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>
            <p><?php the_field('informacje'); ?></p>
        </div>
        <div class="col-12 col-md-3">
            <a class="btn btn-primary btn-lg" href="<?php esc_url(the_permalink()); ?>"
                title="Zamów płytę: <?php the_title(); ?>">
                <?php echo __('Zamów płytę'); ?>
            </a>
        </div>
    </div>
    <?php endwhile; ?>
    <?php wpFn::pagination_bar(); ?>
    <?php endif; ?>
</div>

<?php wpFn::get_template_parts(array('footer')); ?>