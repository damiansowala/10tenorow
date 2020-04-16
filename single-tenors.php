<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<?php if (have_posts()): ?>
<?php while (have_posts()): the_post(); ?>
<div class="container fp">
    <div class="row">
        <div class="col-12">
            <div class="row fp-tenors-site">
                <div class="col-12 col-md-6 col-lg-7">
                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/images/bg320x240.jpg"
                        data-src="<?php the_post_thumbnail_url('thumbnail-big'); ?>" alt="" />
                </div>
                <article class="col-12 col-md-6 col-lg-5">
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_content(); ?></p>
                </article>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
<?php else: ?>
<h1>
    <?php echo __('No posts to display', 'wp_babobski'); ?>
</h1>
<?php endif; ?>

<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>