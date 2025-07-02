<?php
/**
 * Displays post navigation
 *
 * @package ModernPress
 */

$prev_post = get_previous_post();
$next_post = get_next_post();

if ($prev_post || $next_post) :
?>

<nav class="navigation post-navigation" role="navigation">
    <h2 class="screen-reader-text"><?php esc_html_e('Post navigation', 'modernpress'); ?></h2>
    <div class="nav-links">
        <?php
        if ($prev_post) :
            ?>
            <div class="nav-previous">
                <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" rel="prev">
                    <span class="meta-nav" aria-hidden="true"><?php esc_html_e('Previous', 'modernpress'); ?></span>
                    <span class="screen-reader-text"><?php esc_html_e('Previous post:', 'modernpress'); ?></span>
                    <span class="post-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
                </a>
            </div>
            <?php
        endif;

        if ($next_post) :
            ?>
            <div class="nav-next">
                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" rel="next">
                    <span class="meta-nav" aria-hidden="true"><?php esc_html_e('Next', 'modernpress'); ?></span>
                    <span class="screen-reader-text"><?php esc_html_e('Next post:', 'modernpress'); ?></span>
                    <span class="post-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
                </a>
            </div>
            <?php
        endif;
        ?>
    </div>
</nav>

<?php
endif;
