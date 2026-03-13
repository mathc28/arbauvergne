<?php
/**
 * Archive des Conseils arboriculture
 * URL : /conseils/
 *
 * @package Arbauvergne
 */

get_header();

$conseils = new WP_Query(array(
    'post_type'      => 'conseil',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
));
?>

<!-- Hero -->
<section class="hero hero--small hero--conseils">
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title">Conseils arboriculture</h1>
        <p class="hero__subtitle">Tout ce que vous devez savoir sur l'entretien, la taille et la sécurité de vos arbres</p>
    </div>
</section>

<!-- Accordions -->
<section class="conseils-section section">
    <div class="container conseils-container">

        <div class="conseils-intro">
            <p>Des articles rédigés par notre équipe pour vous aider à mieux comprendre le soin et l'entretien des arbres dans le Puy-de-Dôme.</p>
        </div>

        <?php if ($conseils->have_posts()) : ?>
        <div class="conseils-accordion">
            <?php $i = 0; while ($conseils->have_posts()) : $conseils->the_post(); ?>
                <div class="accordion-item <?php echo $i === 0 ? 'accordion-item--open' : ''; ?>">
                    <button
                        class="accordion-trigger"
                        type="button"
                        aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                        aria-controls="accordion-panel-<?php echo get_the_ID(); ?>"
                    >
                        <span class="accordion-trigger__num"><?php printf('%02d', $i + 1); ?></span>
                        <span class="accordion-trigger__title"><?php the_title(); ?></span>
                        <svg class="accordion-trigger__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div
                        class="accordion-panel"
                        id="accordion-panel-<?php echo get_the_ID(); ?>"
                        role="region"
                        <?php echo $i === 0 ? '' : 'hidden'; ?>
                    >
                        <div class="accordion-panel__inner">
                            <?php the_content(); ?>
                            <a href="<?php the_permalink(); ?>" class="accordion-panel__readmore">
                                Lire l'article complet
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php $i++; endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else : ?>
            <p style="text-align:center;color:var(--gray-400);padding:40px 0;">Aucun conseil publié pour l'instant.</p>
        <?php endif; ?>

    </div>
</section>

<!-- CTA devis -->
<section class="cta-section">
    <div class="cta-section__inner container">
        <h2 class="cta-section__title">Un projet d'élagage ou d'abattage ?</h2>
        <p class="cta-section__text">Contactez-nous pour un devis gratuit et sans engagement sous 48h.</p>
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

<script>
(function () {
    var items = document.querySelectorAll('.accordion-item');
    items.forEach(function (item) {
        var trigger = item.querySelector('.accordion-trigger');
        var panel   = item.querySelector('.accordion-panel');
        trigger.addEventListener('click', function () {
            var isOpen = item.classList.contains('accordion-item--open');
            items.forEach(function (other) {
                other.classList.remove('accordion-item--open');
                other.querySelector('.accordion-trigger').setAttribute('aria-expanded', 'false');
                other.querySelector('.accordion-panel').setAttribute('hidden', '');
            });
            if (!isOpen) {
                item.classList.add('accordion-item--open');
                trigger.setAttribute('aria-expanded', 'true');
                panel.removeAttribute('hidden');
            }
        });
    });
})();
</script>

<?php get_footer(); ?>
