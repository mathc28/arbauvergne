<?php
/**
 * Page Template (défaut)
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
        <span><?php the_title(); ?></span>
    </div>
</nav>

<main class="section">
    <div class="container page-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
            <h1 class="page-content__title"><?php the_title(); ?></h1>
            
            <div class="page-content__body">
                <?php the_content(); ?>
            </div>

        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>
