<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<?php if (have_posts()): ?>
<div id="carouselTenors" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php while (have_posts()): the_post(); ?>

        <div class="carousel-item">
            <a class="fp-tenors-content" href="<?php the_permalink(); ?>" rel="bookmark">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bg320x240.jpg"
                    data-src="<?php the_post_thumbnail_url('thumbnail-big'); ?>" alt="" />
                <article>
                    <h1><?php the_title(); ?></h1>
                    <p><?php echo wp_trim_words(get_the_content(), 50, '...'); ?></p>
                    <button class="btn">Czytaj dalej</button>
                </article>

            </a>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
    </div>
</div>
<?php else: ?>
<h1>
    <?php echo __('No posts to display', 'wp_babobski'); ?>
</h1>
<?php endif; ?>

<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>