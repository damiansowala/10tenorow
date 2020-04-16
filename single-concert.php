<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<?php $terms = get_terms(array('taxonomy' => 'road-category', 'orderby' => 'name', 'order' => 'ASC')); ?>
<section id="road" class="container fp-road">

    <article class="fp-h1">
        <h4>Trasy</h4>
        <h1>Koncertowe</h1>
    </article>

    <div class="row">
        <div class="col-12">
            <?php if ($terms && !is_wp_error($terms)): ?>
            <div class="list-group" id="list-tab" role="tablist">
                <?php foreach ($terms as $term) { ?>
                <a class="btn" id="list-<?php echo $term->term_id; ?>-list" data-toggle="list"
                    href="#list-<?php echo $term->term_id; ?>" role="tab" aria-controls="<?php echo $term->term_id; ?>">
                    <h3><?php echo $term->name; ?></h3>
                </a>
                <?php } ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-12">
            <div class="tab-content" id="nav-tabContent">
                <?php if ($terms && !is_wp_error($terms)): ?>
                <?php foreach ($terms as $term) { ?>
                <?php $catquery = new WP_Query(array('post_type' => 'road', 'post_status' => 'publish', 'posts_per_page' => -1, 'meta_key' => 'data', 'orderby' => 'meta_value', 'order' => 'ASC', 'tax_query' => array(array('taxonomy' => 'road-category', 'field' => 'slug', 'terms' => array($term->slug), 'operator' => 'IN')))); ?>
                <div class="tab-pane fade show" id="list-<?php echo $term->term_id; ?>" role="tabpanel"
                    aria-labelledby="list-<?php echo $term->term_id; ?>-list">

                    <?php while ($catquery->have_posts()): $catquery->the_post(); ?>
                    <div class="row" id="accordionExample" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                        <article class="col-9">
                            <h6><i class="fas fa-calendar mr-1"></i><span
                                    class="mr-3"><?php the_field('data'); ?></span> <i class="fas fa-clock"></i>
                                <span class="mr-3"><?php the_field('godzina'); ?></span></h6>
                            <h1><?php the_title(); ?></h1>
                            <h5><?php the_field('miejsce'); ?> - <?php the_field('adres'); ?>,
                                <?php the_title(); ?></h5>
                        </article>

                        <div class="col-3">
                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-ticket-alt"></i> Kup
                                bilet</a>
                        </div>
                    </div>
                    <?php endwhile; ?>

                </div>
                <?php wp_reset_postdata(); ?>
                <?php } ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $the_query = new WP_Query(array('post_type' => 'gallery', 'posts_per_page' => 6)); ?>
<?php if ($the_query->have_posts()): ?>
<section id="gallery" class="fp-gallery">
    <div class="container-fluid">
        <nav class="row">
            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
            <div class="col-12 col-md-6 col-lg-4 gallery-img p-0 m-0">
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
            <?php wp_reset_postdata(); ?>
            <?php endwhile; ?>
            <div class="fp-gallery-btn">
                <a class="btn" href="<?php echo get_home_url(); ?>/relacje-z-koncertow">Zobacz wszystkie galerie</a>
            </div>
        </nav>
    </div>
</section>
<?php endif; ?>

<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>