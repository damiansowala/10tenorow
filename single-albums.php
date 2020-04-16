<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<?php if (have_posts()): ?>
<?php while (have_posts()): the_post(); ?>

<section class="container fp fp-album-single">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-7">
            <img src="<?php echo get_template_directory_uri(); ?>/images/bg-square.jpg"
                data-src="<?php echo the_post_thumbnail_url('full'); ?>" class="img-fluid"
                alt="Płyta: <?php the_title(); ?>">
        </div>
        <div class="col-12 col-md-6 col-lg-5">
            <h1> <?php the_title(); ?> </h1>
            <?php if (get_field('cena')): ?>
            <p id="albumPrice"><?php echo __('Cena płyty:'); ?> <span><?php the_field('cena'); ?></span>
                <?php echo __('PLN'); ?></p>
            <?php endif; ?>
            <p><?php the_field('informacje'); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-7">
            <?php if (have_rows('spis_utworow')): ?>
            <ol class="album-playlist">
                <?php while (have_rows('spis_utworow')): the_row(); ?>
                <li><b><?php the_sub_field('tytul'); ?></b> - <em><?php the_sub_field('autor'); ?></em></li>
                <?php endwhile; ?>
            </ol>
            <?php endif; ?>
        </div>
        <div class="col-12 col-md-6 col-lg-5">
            <div class="alert alert-success" role="alert">
                <?php echo __('Jeśli zamówisz kilka płyt w ciągu jednego dnia, wszystkie płyty wyślemy jedną paczką w dniu nastepnym. Opłata za wysyłkę zostanie naliczona tylko raz.'); ?>
            </div>
            <?php if (get_field('forma_wystawienia') == 1): ?>
            <form id="form-album" class="form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST">
                <input id="name" name="name" placeholder="Imię i nazwisko" type="text" class="form-control">
                <input id="address" name="address" placeholder="Adres do wysyłki" type="text" class="form-control">
                <input id="phone" name="phone" placeholder="Telefon" type="phone" class="form-control">
                <input id="mail" name="email" placeholder="E-mail" type="mail" class="form-control">
                <div class="form-group album-total">
                    <input id="amount" name="amount" min="1" placeholder="Sztuk: 1" type="number" class="form-control">
                    <div class="row">
                        <h4 class="col-12 mt-3 mb-0" id="price"> <?php echo __('Koszt całkowity: '); ?>
                            <b><?php echo sum(get_field('cena'), get_field('koszt_przesylki')); ?></b>
                            <?php echo __('PLN'); ?>
                        </h4>
                        <em class="col-12"
                            id="courier"><?php echo __('w tym kurier: '); ?><?php the_field('nazwa_kuriera_-_forma_dostawy'); ?>
                            -
                            <span><?php the_field('koszt_przesylki'); ?></span>
                            <?php echo __('PLN'); ?></em>
                    </div>
                </div>
                <hr>
                <span class="form-m">
                    <input class="form-check-input" type="checkbox" name="checkbox" id="input-check1" value="1">
                    <label class="form-info" for="input-check1">
                        <?php echo __(get_field('zgoda_na_przedstawienie_oferty', 'option')); ?>
                    </label>
                </span>
                <p class="form-info form-info__p">
                    <?php echo __(get_field('klauzula_informacyjna', 'option')); ?>
                </p>
                <input name="albumName" type="hidden" value="<?php echo get_the_title(); ?>">
                <input id="cost" name="cost" type="hidden"
                    value="<?php echo sum(get_field('cena'), get_field('koszt_przesylki')); ?>">
                <button type="submit" class="btn btn-primary btn-lg btn-block"><i
                        class="fas fa-paper-plane mr-2"></i><?php echo __('Zamów'); ?></button>
                <input type="hidden" name="action" value="ordered_discs">
            </form>
            <?php else: ?>
            <form id="form-album" class="form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST">
                <input id="name" name="name" placeholder="Imię i nazwisko" type="text" class="form-control">
                <input id="address" name="address" placeholder="Adres do wysyłki" type="text" class="form-control">
                <input id="phone" name="phone" placeholder="Telefon" type="phone" class="form-control">
                <input id="mail" name="email" placeholder="E-mail" type="mail" class="form-control">
                <div class="form-group album-total">
                    <input id="amount" name="amount" min="1" placeholder="Sztuk: 1" type="number" class="form-control">
                    <div class="album-total-delivery">
                        <label>
                            <input type="radio" name="delivery" value="Kurier"> <?php echo __('Kurier'); ?>
                        </label>
                        <label>
                            <input type="radio" name="delivery" value="Poczta Polska">
                            <?php echo __('Poczta Polska'); ?>
                        </label>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <input class="form-check-input" type="checkbox" name="checkbox" id="input-check1" value="1">
                    <label class="form-info" for="input-check1">
                        <?php echo __(get_field('zgoda_na_przedstawienie_oferty', 'option')); ?>
                    </label>
                </div>
                <p class="form-info form-info__p">
                    <?php echo __(get_field('klauzula_informacyjna', 'option')); ?>
                </p>
                <input name="albumName" type="hidden" value="<?php echo get_the_title(); ?>">
                <input id="cost" name="cost" type="hidden"
                    value="<?php echo sum(get_field('cena'), get_field('koszt_przesylki')); ?>">
                <div class="g-recaptcha" data-sitekey="6LfkOOYUAAAAAGvWetkNntqW3J34tQbxCbewM2H_"></div>
                <button type="submit" class="btn btn-primary btn-lg btn-block"><i
                        class="fas fa-paper-plane mr-2"></i><?php echo __('Zamów'); ?></button>
                <input type="hidden" name="action" value="ordered_discs_two">
            </form>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endwhile; ?>
<?php endif; ?>

<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>