<?php
/**
 * The template for displaying all single posts
 *
 * @package ModernPress
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-sidebar">
            <div class="content-area">
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            <?php get_template_part('template-parts/post/post-meta'); ?>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
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

                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'modernpress'),
                                    'after'  => '</div>',
                                )
                            );
                            ?>
                        </div>

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
                    </article>

                    <?php get_template_part('template-parts/post/post-navigation'); ?>

                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>

                <?php endwhile; ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
