<?php
/**
 * The template for displaying search results pages
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

                    <header class="page-header">
                        <h1 class="page-title">
                            <?php
                            printf(esc_html__('Search Results for: %s', 'modernpress'), '<span>' . get_search_query() . '</span>');
                            ?>
                        </h1>
                    </header>

                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                <?php if ('post' === get_post_type()) : ?>
                                    <?php get_template_part('template-parts/post/post-meta'); ?>
                                <?php endif; ?>
                            </header>

                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="entry-footer">
                                <?php if ('post' === get_post_type()) : ?>
                                    <?php
                                    $categories_list = get_the_category_list(esc_html__(', ', 'modernpress'));
                                    if ($categories_list) {
                                        printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'modernpress') . '</span>', $categories_list);
                                    }
                                    ?>
                                <?php endif; ?>
                            </footer>
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
                            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'modernpress'); ?></p>
                            <?php get_search_form(); ?>
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
