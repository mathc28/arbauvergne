<?php
/**
 * Template Name: Page Commune SEO
 * 
 * Template pour les pages locales SEO (élagage + ville)
 * Usage : Créer une page, sélectionner ce template, 
 *         et renseigner les custom fields ci-dessous.
 * 
 * @package Arbauvergne
 */

get_header();

// Custom fields de la page
$commune_name = get_post_meta(get_the_ID(), '_arba_commune_name', true) ?: get_the_title();
$commune_distance = get_post_meta(get_the_ID(), '_arba_commune_distance', true) ?: '15 minutes';
$commune_description = get_post_meta(get_the_ID(), '_arba_commune_description', true);

$services = arba_get_services();
?>

<!-- Breadcrumb -->
<nav class="breadcrumb" aria-label="Fil d'ariane">
    <div class="container">
        <a href="<?php echo home_url('/'); ?>">Accueil</a>
        <span>›</span>
        <span>Élagage <?php echo esc_html($commune_name); ?></span>
    </div>
</nav>

<!-- Hero local -->
<section class="hero hero--small">
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title">Élagage à <?php echo esc_html($commune_name); ?></h1>
        <p class="hero__subtitle">
            Votre élagueur professionnel intervient à <?php echo esc_html($commune_name); ?> 
            et ses environs — À seulement <?php echo esc_html($commune_distance); ?> d'Aydat
        </p>
        <a href="tel:<?php echo arba_get_phone('tel'); ?>" class="btn btn--primary btn--lg">
            Appeler maintenant
        </a>
    </div>
</section>

<!-- Contenu principal -->
<section class="section">
    <div class="container commune-content">
        
        <div class="commune-content__main">
            <h2>Votre arboriste à <?php echo esc_html($commune_name); ?>, Puy-de-Dôme</h2>
            
            <?php if ($commune_description) : ?>
                <p><?php echo wp_kses_post($commune_description); ?></p>
            <?php else : ?>
                <p>
                    Arb'Auvergne, votre entreprise d'élagage basée à Aydat, intervient rapidement 
                    à <strong><?php echo esc_html($commune_name); ?></strong> pour tous vos travaux sur les arbres. 
                    Situés à seulement <?php echo esc_html($commune_distance); ?> de votre commune, 
                    nous garantissons une intervention rapide et un suivi personnalisé.
                </p>
            <?php endif; ?>

            <h3>Nos services d'élagage à <?php echo esc_html($commune_name); ?></h3>
            
            <?php foreach ($services as $service) : ?>
                <div class="commune-service">
                    <h4><?php echo esc_html($service['title']); ?></h4>
                    <p><?php echo esc_html($service['desc']); ?></p>
                    <a href="<?php echo home_url('/' . $service['slug'] . '/'); ?>">
                        En savoir plus sur ce service →
                    </a>
                </div>
            <?php endforeach; ?>

            <h3>Pourquoi choisir Arb'Auvergne à <?php echo esc_html($commune_name); ?> ?</h3>
            <ul>
                <li>Proximité : à seulement <?php echo esc_html($commune_distance); ?> de <?php echo esc_html($commune_name); ?></li>
                <li>Arboristes qualifiés et assurés</li>
                <li>Devis gratuit et sans engagement</li>
                <li>Intervention rapide, y compris en urgence</li>
                <li>Respect de l'arbre et de l'environnement</li>
                <li>Particuliers, professionnels et collectivités</li>
            </ul>

            <!-- Réalisations locales si disponibles -->
            <?php
            $realisations_locales = new WP_Query(array(
                'post_type'      => 'realisation',
                'posts_per_page' => 3,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'commune',
                        'field'    => 'name',
                        'terms'    => $commune_name,
                    ),
                ),
            ));

            if ($realisations_locales->have_posts()) :
            ?>
                <h3>Nos réalisations à <?php echo esc_html($commune_name); ?></h3>
                <div class="realisations-grid realisations-grid--small">
                    <?php while ($realisations_locales->have_posts()) : $realisations_locales->the_post(); ?>
                        <article class="realisation-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('gallery-thumb'); ?>" 
                                     alt="<?php the_title(); ?> - Élagage à <?php echo esc_html($commune_name); ?>"
                                     loading="lazy"
                                     width="400" height="300">
                            <?php endif; ?>
                            <h4><?php the_title(); ?></h4>
                            <p><?php the_excerpt(); ?></p>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>

            <!-- Le contenu WordPress de la page (si ajouté dans l'éditeur) -->
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php if (get_the_content()) : ?>
                    <div class="commune-content__editor">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            <?php endwhile; endif; ?>
        </div>

        <!-- Sidebar -->
        <aside class="commune-content__sidebar">
            <?php get_template_part('template-parts/cta-devis'); ?>
        </aside>

    </div>
</section>

<?php get_footer(); ?>
