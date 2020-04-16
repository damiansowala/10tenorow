<?php
/**
* Template Name: Galeria
*/
?>

<?php BsWp::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <img src="" alt="">

        </div>
    </div>
</div>

<div class="gallery container-fluid">
    <div class="row justify-content-center">
        <?php $galeria_images = get_field( 'galeria' ); ?>
        <?php if ( $galeria_images ) :  ?>
        <?php foreach ( $galeria_images as $galeria_image ): ?>
        <div class="col-12 col-md-6 col-lg-3 p-0">
            <a class="gallery-container" href="<?php echo $galeria_image['url']; ?>" data-lightbox="roadtrip"><img
                    class="img-fluid" src="<?php echo $galeria_image['sizes']['medium']; ?>" data-src="<?php echo $galeria_image['sizes']['large']; ?>"
                    alt="<?php echo $galeria_image['alt']; ?>" />
                <span class="gallery-overlay">
                        <p class="mt-2 text-center"><i class="fas fa-search-plus"></i> Powiększ</p>
                </span>
            </a>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


<?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>