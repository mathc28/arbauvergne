<?php
/**
 * Article de conseil individuel
 * URL : /conseils/nom-de-larticle/
 *
 * @package Arbauvergne
 */

get_header();
the_post();
?>

<!-- Hero -->
<section class="hero hero--small hero--conseils">
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <p class="hero__eyebrow">
            <a href="<?php echo esc_url(get_post_type_archive_link('conseil')); ?>">← Tous nos conseils</a>
        </p>
        <h1 class="hero__title"><?php the_title(); ?></h1>
        <?php if (get_the_excerpt()) : ?>
            <p class="hero__subtitle"><?php echo esc_html(get_the_excerpt()); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- Contenu de l'article -->
<section class="conseil-article section">
    <div class="container conseil-article__container">

        <article class="conseil-article__content">
            <?php the_content(); ?>
        </article>

        <!-- Navigation entre articles -->
        <nav class="conseil-nav" aria-label="Articles suivant / précédent">
            <?php
            $prev = get_previous_post(false, '', 'conseil');
            $next = get_next_post(false, '', 'conseil');
            ?>
            <?php if ($prev) : ?>
                <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="conseil-nav__link conseil-nav__link--prev">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span>
                        <small>Article précédent</small>
                        <?php echo esc_html(get_the_title($prev)); ?>
                    </span>
                </a>
            <?php endif; ?>
            <?php if ($next) : ?>
                <a href="<?php echo esc_url(get_permalink($next)); ?>" class="conseil-nav__link conseil-nav__link--next">
                    <span>
                        <small>Article suivant</small>
                        <?php echo esc_html(get_the_title($next)); ?>
                    </span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            <?php endif; ?>
        </nav>

        <!-- Retour à la liste -->
        <div class="conseil-back">
            <a href="<?php echo esc_url(get_post_type_archive_link('conseil')); ?>" class="btn btn--outline">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Retour aux conseils
            </a>
        </div>

    </div>
</section>

<!-- CTA devis -->
<section class="cta-section">
    <div class="cta-section__inner container">
        <h2 class="cta-section__title">Besoin d'un professionnel ?</h2>
        <p class="cta-section__text">Devis gratuit sous 48h — sans engagement.</p>
        <div class="cta-section__actions">
            <a href="tel:<?php echo arba_get_phone('tel'); ?>" class="btn btn--outline btn--lg">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                <?php echo arba_get_phone(); ?>
            </a>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn--outline btn--lg">
                Demander un devis
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
