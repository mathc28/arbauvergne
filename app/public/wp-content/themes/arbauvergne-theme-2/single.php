<?php
/**
 * Single Post Template (Blog / Conseils)
 * 
 * @package Arbauvergne
 */

get_header();
?>

<!-- Breadcrumb -->
<nav class="breadcrumb" aria-label="Fil d'ariane">
    <div class="container">
        <a href="<?php echo home_url('/'); ?>">Accueil</a>
        <span>›</span>
        <a href="<?php echo home_url('/conseils/'); ?>">Conseils</a>
        <span>›</span>
        <span><?php the_title(); ?></span>
    </div>
</nav>

<main class="section">
    <div class="container single-content">
        
        <article class="single-content__main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                <h1 class="single-content__title"><?php the_title(); ?></h1>
                
                <div class="single-content__meta">
                    <time datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo get_the_date('j F Y'); ?>
                    </time>
                    <?php if (has_category()) : ?>
                        <span>|</span>
                        <?php the_category(', '); ?>
                    <?php endif; ?>
                </div>

                <?php if (has_post_thumbnail()) : ?>
                    <figure class="single-content__image">
                        <?php the_post_thumbnail('hero', array(
                            'loading' => 'eager',
                            'alt'     => get_the_title(),
                        )); ?>
                    </figure>
                <?php endif; ?>
                
                <div class="single-content__body">
                    <?php the_content(); ?>
                </div>

            <?php endwhile; endif; ?>

            <!-- Articles liés -->
            <?php
            $related = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post__not_in'   => array(get_the_ID()),
                'orderby'        => 'rand',
            ));

            if ($related->have_posts()) :
            ?>
                <div class="related-posts">
                    <h3>À lire aussi</h3>
                    <div class="related-posts__grid">
                        <?php while ($related->have_posts()) : $related->the_post(); ?>
                            <a href="<?php the_permalink(); ?>" class="related-post-card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('gallery-thumb'); ?>" 
                                         alt="<?php the_title(); ?>"
                                         loading="lazy" width="400" height="300">
                                <?php endif; ?>
                                <h4><?php the_title(); ?></h4>
                            </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </article>

        <!-- Sidebar -->
        <aside class="single-content__sidebar">
            <?php get_template_part('template-parts/cta-devis'); ?>
            <?php if (is_active_sidebar('sidebar-blog')) : ?>
                <?php dynamic_sidebar('sidebar-blog'); ?>
            <?php endif; ?>
        </aside>

    </div>
</main>

<?php get_footer(); ?>
