<div class="nabar-lang">
    <div class="conatiner">
        <?php
wp_nav_menu(array(
    'menu' => 'lang',
    'theme_location' => 'lang',
    'depth' => 2,
    'container' => false,
    'menu_class' => 'navbar-nav',
    'fallback_cb' => 'bs4navwalker::fallback',
    'walker' => new bs4navwalker())
);
?>
    </div>
</div>
<div class="nabar-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg justify-content-md-center">
            <a class="navbar-brand col-8 col-sm-4" title="10tenorow.pl" href="<?php echo get_home_url(); ?>"><img
                    class="img-fluid" src="<?php echo logo(); ?>" data-src="<?php echo logo(); ?>"
                    alt="10tenorów logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-light"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-md-end" id="navbarNav">
                <?php
wp_nav_menu(array(
    'menu' => 'primary',
    'theme_location' => 'primary',
    'depth' => 2,
    'container' => false,
    'menu_class' => 'navbar-nav',
    'fallback_cb' => 'bs4navwalker::fallback',
    'walker' => new bs4navwalker())
);
?>
            </div>
        </nav>
    </div>
</div>