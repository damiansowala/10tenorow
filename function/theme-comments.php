<?php
/* ========================================================================================================================
Comments
======================================================================================================================== */
function bootstrap_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    if ($comment->comment_approved == '1'):
        echo '<li class="media">';
        echo '<div class="media-left">';
        echo get_avatar($comment);
        echo '</div>';
        echo '<div class="media-body">';
        echo '<h4 class="media-heading">' . comment_author_link() . '</h4>';
        echo '<time><a href="#comment-' . comment_ID() . '" pubdate>' . comment_date() . ' at ' . comment_time() . '</a></time>';
        comment_text();
        echo '</div>';
    endif;
}