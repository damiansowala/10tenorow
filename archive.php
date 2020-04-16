<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package     WordPress
 * @subpackage     Bootstrap 4.0.0
 * @autor         Babobski
 */; ?>
<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>

<?php if (have_posts()): ?>

<ul class="media-list">
    <?php while (have_posts()): the_post(); ?>
    <li class="media">
        <div class="media-body">
            <h2 class="media-heading">
                <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
            </h2>
        </div>
    </li>
    <?php endwhile; ?>
</ul>

<?php else: ?>
<h1>
    <?php echo __('No posts to display', 'wp_babobski'); ?>
</h1>
<?php endif; ?>

<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>