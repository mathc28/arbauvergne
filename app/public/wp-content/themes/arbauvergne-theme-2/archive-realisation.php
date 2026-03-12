<?php
/**
 * Archive des Réalisations
 * URL : /realisations/
 *
 * @package Arbauvergne
 */

get_header();

$labels_type = array(
    'elagage'         => 'Élagage',
    'abattage'        => 'Abattage',
    'debroussaillage' => 'Débroussaillage',
);

$colors_type = array(
    'elagage'         => 'badge--green',
    'abattage'        => 'badge--dark',
    'debroussaillage' => 'badge--olive',
);

// Récupérer toutes les réalisations publiées
$realisations = new WP_Query(array(
    'post_type'      => 'realisation',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
));
?>

<!-- Hero (identique Contact / Avis) -->
<section class="hero hero--small hero--realisations">
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title">Nos réalisations</h1>
        <p class="hero__subtitle">Découvrez nos chantiers d'élagage, d'abattage et de débroussaillage dans le Puy-de-Dôme</p>
    </div>
</section>

<!-- Filtres -->
<section class="real-filters-section">
    <div class="container">
        <div class="real-filters" role="group" aria-label="Filtrer par type">
            <button class="real-filter real-filter--active" data-filter="tous" type="button">Tous</button>
            <button class="real-filter" data-filter="elagage" type="button">Élagage</button>
            <button class="real-filter" data-filter="abattage" type="button">Abattage</button>
            <button class="real-filter" data-filter="debroussaillage" type="button">Débroussaillage</button>
        </div>
    </div>
</section>

<!-- Grille des réalisations -->
<section class="real-section">
    <div class="container">

        <?php if ($realisations->have_posts()) : ?>
            <div class="real-grid" id="real-grid">
                <?php while ($realisations->have_posts()) : $realisations->the_post();
                    $type       = get_post_meta(get_the_ID(), '_arba_type_intervention', true) ?: 'elagage';
                    $lieu       = get_post_meta(get_the_ID(), '_arba_lieu', true);
                    $img_apres_id  = get_post_meta(get_the_ID(), '_arba_image_apres', true);
                    $img_avant_url = get_the_post_thumbnail_url(get_the_ID(), 'service-card');
                    $img_apres_url = $img_apres_id ? wp_get_attachment_image_url($img_apres_id, 'service-card') : '';
                    $label_type = $labels_type[$type] ?? 'Élagage';
                    $color_type = $colors_type[$type] ?? 'badge--green';
                    $has_compare = $img_avant_url && $img_apres_url;
                ?>
                    <article class="real-card" data-type="<?php echo esc_attr($type); ?>">

                        <!-- Visuel : slider avant/après ou image simple -->
                        <div class="real-card__visual">
                            <?php if ($has_compare) : ?>
                                <div class="compare" data-compare>
                                    <img class="compare__before" src="<?php echo esc_url($img_avant_url); ?>" alt="Avant — <?php the_title(); ?>" draggable="false">
                                    <div class="compare__after-clip">
                                        <img class="compare__after" src="<?php echo esc_url($img_apres_url); ?>" alt="Après — <?php the_title(); ?>" draggable="false">
                                    </div>
                                    <div class="compare__divider">
                                        <div class="compare__handle" aria-hidden="true">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                                        </div>
                                    </div>
                                    <span class="compare__label compare__label--avant">Avant</span>
                                    <span class="compare__label compare__label--apres">Après</span>
                                </div>
                            <?php elseif ($img_avant_url) : ?>
                                <img class="real-card__img" src="<?php echo esc_url($img_avant_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else : ?>
                                <div class="real-card__placeholder" aria-hidden="true">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="m17 14 3 3.3a1 1 0 0 1-.7 1.7H4.7a1 1 0 0 1-.7-1.7L7 14h-.3a1 1 0 0 1-.7-1.7L9 9h-.2A1 1 0 0 1 8 7.3L12 3l4 4.3a1 1 0 0 1-.8 1.7H15l3 3.3a1 1 0 0 1-.7 1.7H17Z"/><path d="M12 22v-3"/></svg>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Infos -->
                        <div class="real-card__body">
                            <div class="real-card__meta">
                                <span class="badge <?php echo esc_attr($color_type); ?>"><?php echo esc_html($label_type); ?></span>
                                <?php if ($lieu) : ?>
                                    <span class="real-card__lieu">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <?php echo esc_html($lieu); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <h2 class="real-card__title"><?php the_title(); ?></h2>
                            <?php if (has_excerpt()) : ?>
                                <p class="real-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                            <?php endif; ?>
                        </div>

                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <!-- Message "aucun résultat" pour les filtres -->
            <p class="real-empty" id="real-empty" style="display:none;">Aucune réalisation pour ce type d'intervention.</p>

        <?php else : ?>
            <div class="real-empty-state">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="m17 14 3 3.3a1 1 0 0 1-.7 1.7H4.7a1 1 0 0 1-.7-1.7L7 14h-.3a1 1 0 0 1-.7-1.7L9 9h-.2A1 1 0 0 1 8 7.3L12 3l4 4.3a1 1 0 0 1-.8 1.7H15l3 3.3a1 1 0 0 1-.7 1.7H17Z"/></svg>
                <p>Les premières réalisations arrivent bientôt.</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- CTA devis -->
<section class="cta-section">
    <div class="cta-section__inner container">
        <h2 class="cta-section__title">Un projet similaire ? Parlons-en.</h2>
        <p class="cta-section__text">Devis gratuit et sans engagement sous 48h.</p>
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

<!-- JS : filtres + slider avant/après -->
<script>
(function () {

    // ── FILTRES ──────────────────────────────────────────────
    var btns  = document.querySelectorAll('.real-filter');
    var cards = document.querySelectorAll('.real-card');
    var empty = document.getElementById('real-empty');

    btns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            btns.forEach(function (b) { b.classList.remove('real-filter--active'); });
            btn.classList.add('real-filter--active');

            var filter = btn.dataset.filter;
            var visible = 0;

            cards.forEach(function (card) {
                var show = filter === 'tous' || card.dataset.type === filter;
                card.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            empty.style.display = visible === 0 ? 'block' : 'none';
        });
    });

    // ── SLIDER AVANT / APRÈS ─────────────────────────────────
    document.querySelectorAll('[data-compare]').forEach(function (el) {
        var clip    = el.querySelector('.compare__after-clip');
        var divider = el.querySelector('.compare__divider');
        var pos     = 50; // % initial
        var dragging = false;

        function setPos(pct) {
            pct = Math.max(5, Math.min(95, pct));
            pos = pct;
            clip.style.width    = pct + '%';
            divider.style.left  = pct + '%';
        }

        setPos(50);

        function getX(e) {
            return (e.touches ? e.touches[0].clientX : e.clientX);
        }

        el.addEventListener('mousedown',  function (e) { dragging = true; e.preventDefault(); });
        el.addEventListener('touchstart', function (e) { dragging = true; }, { passive: true });

        window.addEventListener('mousemove', function (e) {
            if (!dragging) return;
            var rect = el.getBoundingClientRect();
            setPos(((getX(e) - rect.left) / rect.width) * 100);
        });
        window.addEventListener('touchmove', function (e) {
            if (!dragging) return;
            var rect = el.getBoundingClientRect();
            setPos(((getX(e) - rect.left) / rect.width) * 100);
        }, { passive: true });

        window.addEventListener('mouseup',  function () { dragging = false; });
        window.addEventListener('touchend', function () { dragging = false; });
    });

})();
</script>

<?php get_footer(); ?>
