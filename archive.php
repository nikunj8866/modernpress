<?php
/**
 * The template for displaying archive pages
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
                        <?php
                        the_archive_title('<h1 class="page-title">', '</h1>');
                        the_archive_description('<div class="archive-description">', '</div>');
                        ?>
                    </header>

                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                <?php get_template_part('template-parts/post/post-meta'); ?>
                            </header>

                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="entry-footer">
                                <?php
                                $categories_list = get_the_category_list(esc_html__(', ', 'modernpress'));
                                if ($categories_list) {
                                    printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'modernpress') . '</span>', $categories_list);
                                }
                                ?>
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
                            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'modernpress'); ?></p>
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
