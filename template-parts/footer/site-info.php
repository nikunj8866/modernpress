<?php
/**
 * Displays footer site info
 *
 * @package ModernPress
 */

?>

<div class="site-info">
    <a href="<?php echo esc_url(__('https://wordpress.org/', 'modernpress')); ?>">
        <?php printf(esc_html__('Proudly powered by %s', 'modernpress'), 'WordPress'); ?>
    </a>
    <span class="sep"> | </span>
    <?php printf(esc_html__('Theme: %1$s by %2$s.', 'modernpress'), 'ModernPress', '<a href="#">Your Name</a>'); ?>
</div>
