<div class="site-branding">
    <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
        <div class="site-logo">
            <?php the_custom_logo(); ?>
        </div>
    <?php endif; ?>

    <div class="site-identity">
        <?php if (is_front_page() && is_home()) : ?>
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php bloginfo('name'); ?>
                </a>
            </h1>
        <?php else : ?>
            <p class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php bloginfo('name'); ?>
                </a>
            </p>
        <?php endif; ?>

        <?php
        $modernpress_description = get_bloginfo('description', 'display');
        if ($modernpress_description || is_customize_preview()) :
        ?>
            <p class="site-description"><?php echo $modernpress_description; ?></p>
        <?php endif; ?>
    </div>

    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
        <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'modernpress'); ?></span>
        <span class="menu-icon"></span>
    </button>
</div>
