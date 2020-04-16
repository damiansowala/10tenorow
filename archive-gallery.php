<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<?php $the_query = new WP_Query(array('post_type' => 'gallery', 'posts_per_page' => -1)); ?>
<?php if ($the_query->have_posts()): ?>
<section id="gallery" class="fp-gallery">
    <div class="container-fluid">
        <nav class="row">
            <?php $i = 1; ?>
            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
            <div class="col-12 col-md-6 col-lg-4 gallery-img p-0 m-0" data-aos="zoom-in"
                data-aos-delay="<?php echo $i; ?>50" data-aos-easing="ease-in-back">
                <a class="fp-gallery-link" href="<?php the_permalink(); ?>">
                    <span class="fp-gallery-link-info">
                        <p class="m-0 p-0"> <?php the_field('miejsce_koncertu'); ?></p>
                        <h2 class="m-0 p-0"> <?php the_field('data_koncertu'); ?></h2>
                    </span>
                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/images/bg320x240.jpg"
                        data-src="<?php the_post_thumbnail_url('cover'); ?>" alt="" />
                    <span class="fp-gallery-link-overlay">
                        <p class="mt-2 text-center"><i class="fas fa-eye"></i> Zobacz galerię</p>
                    </span>
                </a>
            </div>
            <?php $i++; ?>
            <?php wp_reset_postdata(); ?>
            <?php endwhile; ?>
            <div class="fp-gallery-btn">
                <a class="btn" href="<?php echo get_home_url(); ?>/koncert-10-tenorow">Zobacz wszystkie galerie</a>
            </div>
        </nav>
    </div>
</section>
<?php endif; ?>

<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>