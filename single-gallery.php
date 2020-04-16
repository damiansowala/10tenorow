<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>
<?php if (have_posts()): ?>
<?php while (have_posts()): the_post(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <img src="" alt="">
        </div>
    </div>
</div>

<div class="gallery container-fluid">
    <div class="row justify-content-center">
        <?php $galeria_images = get_field('galeria'); ?>
        <?php if ($galeria_images): ?>
        <?php foreach ($galeria_images as $galeria_image): ?>
        <div class="col-12 col-md-6 col-lg-4 p-0">
            <a class="fp-gallery-link" href="<?php echo $galeria_image['url']; ?>" data-lightbox="roadtrip"><img
                    class="img-fluid" src="<?php echo $galeria_image['sizes']['medium']; ?>"
                    data-src="<?php echo $galeria_image['sizes']['large']; ?>"
                    alt="<?php echo $galeria_image['alt']; ?>" />
                <span class="fp-gallery-link-overlay">
                    <span class="d-block">
                        <p class="mt-2 text-center"><i class="fas fa-eye"></i> Powiększ</p>
                    </span>
                </span>
            </a>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php endwhile; ?>
<?php endif; ?>

<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>