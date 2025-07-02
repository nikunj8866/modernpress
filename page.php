<?php
/**
 * The template for displaying all pages
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
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'modernpress'),
                                    'after'  => '</div>',
                                )
                            );
                            ?>
                        </div>

                        <?php if (get_edit_post_link()) : ?>
                            <footer class="entry-footer">
                                <?php
                                edit_post_link(
                                    sprintf(
                                        wp_kses(
                                            __('Edit <span class="screen-reader-text">"%s"</span>', 'modernpress'),
                                            array(
                                                'span' => array(
                                                    'class' => array(),
                                                ),
                                            )
                                        ),
                                        wp_kses_post(get_the_title())
                                    ),
                                    '<span class="edit-link">',
                                    '</span>'
                                );
                                ?>
                            </footer>
                        <?php endif; ?>
                    </article>

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
