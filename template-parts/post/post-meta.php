<?php
/**
 * Displays post meta information
 *
 * @package ModernPress
 */

?>

<div class="entry-meta">
    <?php
    printf(
        '<span class="posted-on">' . esc_html__('Posted on %s', 'modernpress') . '</span>',
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_date() . '</a>'
    );

    printf(
        '<span class="byline"> ' . esc_html__('by %s', 'modernpress') . '</span>',
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'modernpress'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );
        echo '</span>';
    }
    ?>
</div>
