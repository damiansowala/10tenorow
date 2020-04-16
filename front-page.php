<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<?php if (have_posts()): ?>
<?php while (have_posts()): the_post(); ?>

<section class="fp-header" data-parallax="scroll" data-image-src="<?php echo the_post_thumbnail_url('full'); ?>">
    <img src="<?php echo the_post_thumbnail_url('full'); ?>" alt="">
    <article class="fp-header-content">
        <?php the_content(); ?>
    </article>

</section>

<?php if (have_rows('komentarze')): ?>
<div class="fp-comments">
    <div class="slider-comments">
        <?php while (have_rows('komentarze')): the_row(); ?>
        <article>
            <p><?php the_sub_field('tresc'); ?></p>
            <h6>- <?php the_sub_field('autor'); ?> -</h6>
        </article>
        <?php endwhile; ?>
    </div>
</div>
<?php endif; ?>
<?php if (have_rows('partnerzy')): ?>
<section class="fp-partners">
    <div class="container">
        <div class="row">
            <?php $i = 1; ?>
            <?php while (have_rows('partnerzy')): the_row(); ?>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="<?php echo $i; ?>50"
                data-aos-easing="ease-in-back">
                <?php $logo = get_sub_field('logo'); ?>
                <?php $link = get_sub_field('link'); ?>
                <?php if ($link && $logo): ?>
                <a target="_blank" rel="noopener" title="<?php echo $logo['alt']; ?>" href="<?php echo $link; ?>">
                    <img class="img-fluid" src="" data-src="<?php echo $logo['url']; ?>"
                        data-src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" /></a>
                <?php elseif ($logo): ?>
                <img class="img-fluid" src="" data-src="<?php echo $logo['url']; ?>"
                    data-src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
                <?php endif; ?>
            </div>
            <?php $i++; ?>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $terms = get_terms(array('taxonomy' => 'road-category', 'orderby' => 'name', 'order' => 'ASC')); ?>
<section id="road" class="container fp-road">

    <article class="fp-h1">
        <h4>Trasy</h4>
        <h1>Koncertowe</h1>
    </article>

    <div class="row">
        <div class="col-12 col-lg-6">
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

        <?php if (have_rows('lista', 'option')): ?>
        <div class="col-12 col-lg-6">
            <div class="row">
                <?php while (have_rows('lista', 'option')): the_row(); ?>
                <div class="col-6 col-md-3">
                    <?php $img = get_sub_field('img'); ?>
                    <?php if ($img) { ?>
                    <a class="ticket" data-aos="flip-right" href=" <?php the_sub_field('url'); ?>">
                        <img class="img-fluid" src="<?php echo $img['url']; ?>" title="<?php the_sub_field('nazwa'); ?>"
                            alt="<?php echo $img['alt']; ?>" />
                    </a>
                    <?php } ?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-12">
            <div class="tab-content" id="nav-tabContent">
                <?php if ($terms && !is_wp_error($terms)): ?>
                <?php foreach ($terms as $term) { ?>
                <?php $catquery = new WP_Query(array('post_type' => 'road', 'post_status' => 'publish', 'posts_per_page' => -1, 'meta_key' => 'data', 'orderby' => 'meta_value', 'order' => 'ASC', 'tax_query' => array(array('taxonomy' => 'road-category', 'field' => 'slug', 'terms' => array($term->slug), 'operator' => 'IN')))); ?>
                <div class="tab-pane fade show" id="list-<?php echo $term->term_id; ?>" role="tabpanel"
                    aria-labelledby="list-<?php echo $term->term_id; ?>-list">

                    <?php while ($catquery->have_posts()): $catquery->the_post(); ?>
                    <div class="row" id="accordionExample" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                        <article class="col-12 col-md-9">
                            <h6><i class="fas fa-calendar mr-1"></i><span
                                    class="mr-3"><?php the_field('data'); ?></span> <i class="fas fa-clock"></i>
                                <span class="mr-3"><?php the_field('godzina'); ?></span></h6>
                            <h1><?php the_title(); ?></h1>
                            <h5><?php the_field('miejsce'); ?> - <?php the_field('adres'); ?>,
                                <?php the_title(); ?></h5>
                        </article>
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

<section class="parallax-window" data-parallax="scroll"
    data-image-src="<?php echo get_template_directory_uri(); ?>/images/img-header-10-tenorow.jpg">
    <h1>Dziesięć osobowości - jedna pasja</h1>
</section>



<?php $the_query = new WP_Query(array('post_type' => 'tenors', 'posts_per_page' => -1)); ?>
<?php if ($the_query->have_posts()): ?>
<section id="artist" class="fp-tenors">
    <div class="container">

        <article class="fp-h1">
            <h4>Dziesięciu</h4>
            <h1>tenorów</h1>
        </article>
        <div class="row">
            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
            <div class="col-12 col-md-6 fp-tenors-content" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a class="fp-gallery-link" href="<?php the_permalink(); ?>" rel="bookmark">
                            <img class="img-fluid"
                                src="<?php echo get_template_directory_uri(); ?>/images/bg320x240.jpg"
                                data-src="<?php the_post_thumbnail_url(); ?>" alt="" />
                            <span class="fp-gallery-link-overlay">
                                <p class="mt-2 text-center"><i class="fas fa-eye"></i> Czytaj dalej</p>
                            </span>
                        </a>
                    </div>
                    <article class="col-12 col-md-6">
                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                            <h1><?php the_title(); ?></h1>
                        </a>
                        <p><?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>
                        <a class="btn btn-primary" href="<?php the_permalink(); ?>" rel="bookmark">
                            Czytaj dalej
                        </a>
                    </article>

                </div>
            </div>
            <?php wp_reset_postdata(); ?>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<section class="fp-director">
    <div class="container">

        <article class="fp-h1">
            <h4>Magia</h4>
            <h1>muzyki</h1>
        </article>

    </div>
    <?php $dyrygent = get_field('dyrygent'); ?>
    <?php if ($dyrygent) { ?>
    <div class="fp-director-content" data-aos="zoom-in">
        <article>
            <h1><?php the_field('imie_i_nazwisko'); ?></h1>
            <?php the_field('notatka_biograficzna_dyrygent'); ?>
        </article>
        <img src="<?php echo $dyrygent['url']; ?>" alt="<?php echo $dyrygent['alt']; ?>" />
    </div>
    <?php } ?>
</section>

<?php $sklad_orkiestry_images = get_field('sklad_orkiestry'); ?>
<?php if ($sklad_orkiestry_images): ?>
<section id="orhestra" class="orhestra">
    <div class="container">
        <div class="orhestra-instrumentalist">
            <?php foreach ($sklad_orkiestry_images as $sklad_orkiestry_image): ?>
            <img class="p-1 rounded" src="<?php echo $sklad_orkiestry_image['sizes']['medium']; ?>"
                alt="<?php echo $sklad_orkiestry_image['alt']; ?>" />
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (have_rows('repertuar_koncertowy')): ?>
<section id="player" class="fp-players">
    <div class="container">

        <article class="fp-h1">
            <h4>przykładowe</h4>
            <h1>utwory</h1>
        </article>

    </div>
    <div class="playlistbox">
        <div class="container">
            <div class="row" data-aos="zoom-in">
                <div class="col-2">
                    <button class="btn btn-outline-light h-100 btn-block" id="playPause">
                        <span id="play">
                            <i class="fas fa-play fa-2x"></i>
                        </span>
                        <span id="pause" style="display: none">
                            <i class="fas fa-pause fa-2x"></i>
                        </span>
                    </button>
                </div>
                <div class="col-10">
                    <div id="waveform"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5 col-lg-3" data-aos="zoom-in">
                <div class="row audio bg-dark" id="playlist">
                    <?php while (have_rows('repertuar_koncertowy')): the_row(); ?>
                    <?php $plik_mp3 = get_sub_field('plik_mp3'); ?>
                    <?php if (get_sub_field('wykonawca') && get_sub_field('tytul')): ?>
                    <a href="<?php echo $plik_mp3['url']; ?>" class="col-12" data-aos="fade-right">
                        <span class="row">
                            <span class="col-2">
                                <i class="fas fa-play fa-2x mr-5"></i>
                            </span>
                            <span class="col-10">
                                <h6><?php the_sub_field('wykonawca'); ?></h6>
                                <h4 class="m-0"><?php the_sub_field('tytul'); ?></h4>
                            </span>
                        </span>
                    </a>
                    <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>

            <div class="col-12 col-md-7 col-lg-9">
                <?php $the_query = new WP_Query(array('post_type' => 'albums', 'posts_per_page' => -1)); ?>
                <?php if ($the_query->have_posts()): ?>
                <section id="albums" class="fp-album">
                    <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                    <div class="row" data-aos="zoom-in">
                        <div class="col-12 col-lg-5 mb-3 gallery-img">
                            <a class="fp-gallery-link mb-3" href="<?php the_permalink(); ?>">
                                <img class="img-fluid"
                                    src="<?php echo get_template_directory_uri(); ?>/images/bg320x240.jpg"
                                    data-src="<?php the_post_thumbnail_url(); ?>" alt="" />
                                <span class="fp-gallery-link-overlay">
                                    <p class="mt-2 text-center"><i class="fas fa-compact-disc"></i>
                                        <?php echo __('Zamów płyte'); ?> </p>
                                </span>
                            </a>
                            <a class="btn btn-primary btn-block" href="<?php the_permalink(); ?>">
                                <?php echo __('Zamów płyte'); ?>
                            </a>
                        </div>
                        <article class="col-12 col-lg-7">
                            <a class="fp-gallery-link mb-3" href="<?php the_permalink(); ?>">
                                <h2><i class="fas fa-compact-disc"></i> <?php the_title(); ?></h2>
                            </a>
                            <p><?php the_field('informacje'); ?></p>
                        </article>
                    </div>
                    <?php wp_reset_postdata(); ?>
                    <?php endwhile; ?>
                </section>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>






<?php $the_query = new WP_Query(array('post_type' => 'gallery', 'posts_per_page' => 6)); ?>
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

<section id="contact" class="fp-contact">
    <div class="container">
        <?php $organizator = get_field('organizator'); ?>

        <div class="row">
            <div class="col-12 col-md-6">
                <article class="fp-h1">
                    <h4>Organizator</h4>
                    <h1>Kontakt</h1>
                </article>
            </div>
            <?php if ($organizator) { ?>
            <div class="col-12 col-md-6">
                <a href="<?php the_field('link_do_strony_organizatora'); ?>">
                    <img class="img-fluid mt-3" src="<?php echo $organizator['url']; ?>"
                        alt="<?php echo $organizator['alt']; ?>" />
                </a>
            </div>
            <?php } ?>
        </div>

        <?php if (have_rows('podmioty_do_kontaktu')): ?>
        <div class="row">
            <?php while (have_rows('podmioty_do_kontaktu')): the_row(); ?>

            <div class="col-12 col-lg-4">
                <h2><?php the_sub_field('podmiot'); ?></h2>
                <a href="mailto:<?php the_sub_field('e-mail'); ?>">
                    <h3><?php the_sub_field('e-mail'); ?></h3>
                </a>
                <a href="tel:<?php the_sub_field('telefon'); ?>">
                    <h3><?php the_sub_field('telefon'); ?></h3>
                </a>
            </div>

            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12">
                <a href=""><img src="" alt=""></a>
            </div>
        </div>
    </div>
</section>

<?php $logotypy_images = get_field('miejsca_logo'); ?>
<?php if ($logotypy_images): ?>
<section class="fp-space">
    <div class="container-fluid">
        <div class="row">

            <?php $i = 1; ?>
            <?php foreach ($logotypy_images as $logotypy_image): ?>
            <div class="col-6 col-sm-3 col-md-1" data-aos="fade-right" data-aos-delay="<?php echo $i; ?>50"
                data-aos-easing="ease-in-back">
                <img class="img-fluid" src="<?php echo $logotypy_image['sizes']['medium']; ?>"
                    title="<?php echo $logotypy_image['alt']; ?>" alt="<?php echo $logotypy_image['alt']; ?>" />
            </div>
            <?php $i++; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="parallax-window" data-parallax="scroll"
    data-image-src="<?php echo get_template_directory_uri(); ?>/images/img-footer-10-tenorow.jpg">
    <h1>Zapraszamy!</h1>
</section>

<?php endwhile; ?>
<?php endif; ?>

<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>