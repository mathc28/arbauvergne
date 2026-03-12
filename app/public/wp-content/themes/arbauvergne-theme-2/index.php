<?php
/**
 * Index / Archive Template
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
        <span>Conseils</span>
    </div>
</nav>

<main class="section">
    <div class="container">
        <h1 class="section__title">Nos conseils en arboriculture</h1>
        <p class="section__subtitle">Guides pratiques et astuces pour l'entretien de vos arbres</p>
        
        <?php if (have_posts()) : ?>
            <div class="blog-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="blog-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="blog-card__image">
                                <img src="<?php the_post_thumbnail_url('service-card'); ?>" 
                                     alt="<?php the_title(); ?>"
                                     loading="lazy" width="600" height="400">
                            </a>
                        <?php endif; ?>
                        <div class="blog-card__content">
                            <time datetime="<?php echo get_the_date('c'); ?>" class="blog-card__date">
                                <?php echo get_the_date('j F Y'); ?>
                            </time>
                            <h2 class="blog-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                            <a href="<?php the_permalink(); ?>" class="blog-card__link">Lire la suite →</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '← Précédent',
                    'next_text' => 'Suivant →',
                )); ?>
            </div>

        <?php else : ?>
            <p>Aucun article pour le moment. Revenez bientôt !</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
