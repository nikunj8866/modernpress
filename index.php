<?php
/**
 * The main template file
 *
 * @package ModernPress
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-sidebar">
            <div class="content-area">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php if (is_singular()) : ?>
                                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                                <?php else : ?>
                                    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                <?php endif; ?>
                                
                                <?php if (!is_page()) : ?>
                                    <?php get_template_part('template-parts/post/post-meta'); ?>
                                <?php endif; ?>
                            </header>

                            <div class="entry-content">
                                <?php
                                if (is_singular()) {
                                    the_content(
                                        sprintf(
                                            wp_kses(
                                                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'modernpress'),
                                                array(
                                                    'span' => array(
                                                        'class' => array(),
                                                    ),
                                                )
                                            ),
                                            wp_kses_post(get_the_title())
                                        )
                                    );
                                } else {
                                    the_excerpt();
                                }
                                ?>
                            </div>

                            <?php if (!is_page()) : ?>
                                <footer class="entry-footer">
                                    <?php
                                    $categories_list = get_the_category_list(esc_html__(', ', 'modernpress'));
                                    if ($categories_list) {
                                        printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'modernpress') . '</span>', $categories_list);
                                    }

                                    $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'modernpress'));
                                    if ($tags_list) {
                                        printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'modernpress') . '</span>', $tags_list);
                                    }
                                    ?>
                                </footer>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>

                    <?php
                    the_posts_navigation(array(
                        'prev_text' => __('&laquo; Older posts', 'modernpress'),
                        'next_text' => __('Newer posts &raquo;', 'modernpress'),
                    ));
                    ?>

                <?php else : ?>
                    <section class="no-results not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e('Nothing here', 'modernpress'); ?></h1>
                        </header>

                        <div class="page-content">
                            <?php if (is_home() && current_user_can('publish_posts')) : ?>
                                <p>
                                    <?php
                                    printf(
                                        wp_kses(
                                            __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'modernpress'),
                                            array(
                                                'a' => array(
                                                    'href' => array(),
                                                ),
                                            )
                                        ),
                                        esc_url(admin_url('post-new.php'))
                                    );
                                    ?>
                                </p>
                            <?php elseif (is_search()) : ?>
                                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'modernpress'); ?></p>
                                <?php get_search_form(); ?>
                            <?php else : ?>
                                <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'modernpress'); ?></p>
                                <?php get_search_form(); ?>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
