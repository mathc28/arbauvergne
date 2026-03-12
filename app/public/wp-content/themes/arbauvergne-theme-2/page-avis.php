<?php
/**
 * Template de la page Avis
 * Slug de page WordPress : avis
 *
 * @package Arbauvergne
 */

get_header();

// URL Google Maps (page fiche entreprise — à personnaliser)
$google_maps_url = 'https://g.page/r/CRs7BVXdVaLeEAE/review';

// ─ Requête CPT Témoignages ─
$query = new WP_Query(array(
    'post_type'      => 'temoignage',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
));

$reviews = array();
$ratings_sum = 0;

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $rating   = intval(get_post_meta(get_the_ID(), '_arba_client_rating', true)) ?: 5;
        $date_raw = get_post_meta(get_the_ID(), '_arba_client_date', true);

        // Calcul de la date relative en français
        $relative_time = '';
        if ($date_raw) {
            $diff_days = (int) floor((time() - strtotime($date_raw)) / DAY_IN_SECONDS);
            if ($diff_days < 14)          $relative_time = 'Il y a ' . $diff_days . ' jour' . ($diff_days > 1 ? 's' : '');
            elseif ($diff_days < 60)      $relative_time = 'Il y a ' . round($diff_days / 7) . ' semaine' . (round($diff_days / 7) > 1 ? 's' : '');
            elseif ($diff_days < 365)     $relative_time = 'Il y a ' . round($diff_days / 30) . ' mois';
            else                          $relative_time = 'Il y a ' . round($diff_days / 365) . ' an' . (round($diff_days / 365) > 1 ? 's' : '');
        }

        $reviews[] = array(
            'author'        => get_post_meta(get_the_ID(), '_arba_client_name', true) ?: get_the_title(),
            'location'      => get_post_meta(get_the_ID(), '_arba_client_commune', true),
            'rating'        => $rating,
            'relative_time' => $relative_time,
            'text'          => wp_strip_all_tags(apply_filters('the_content', get_the_content())),
            'photo_url'     => '',
        );
        $ratings_sum += $rating;
    }
    wp_reset_postdata();
}

// Note globale calculée depuis les témoignages
$total_reviews = count($reviews);
if ($total_reviews > 0) {
    $global_rating = number_format($ratings_sum / $total_reviews, 1);
} else {
    // Aucun témoignage saisi : valeurs par défaut affichées
    $global_rating = '4.9';
    $total_reviews = 0;
}

// Étoiles de la note globale
$rating_float  = floatval($global_rating);
$stars_full    = floor($rating_float);
$stars_half    = ($rating_float - $stars_full) >= 0.5 ? 1 : 0;
$stars_empty   = 5 - $stars_full - $stars_half;

// SVG Google G multicolor
$google_g_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>';
?>

<!-- Hero small (identique page Contact) -->
<section class="hero hero--small hero--avis">
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title">Avis de nos clients</h1>
        <p class="hero__subtitle">Découvrez les retours de nos clients satisfaits à travers toute l'Auvergne.</p>

        <!-- Badge note Google -->
        <div class="avis-badge">
            <?php echo $google_g_svg; ?>
            <span class="avis-badge__label">Avis Google</span>
            <span class="avis-badge__sep" aria-hidden="true"></span>
            <strong class="avis-badge__score"><?php echo esc_html($global_rating); ?></strong>
            <span class="avis-badge__stars" aria-label="Note <?php echo esc_attr($global_rating); ?> sur 5">
                <?php for ($i = 0; $i < $stars_full; $i++) : ?>
                    <svg class="avis-star avis-star--full" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <?php endfor; ?>
                <?php if ($stars_half) : ?>
                    <svg class="avis-star avis-star--half" viewBox="0 0 24 24"><defs><linearGradient id="g-half"><stop offset="50%" stop-color="#F59E0B"/><stop offset="50%" stop-color="#D1D5DB"/></linearGradient></defs><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" fill="url(#g-half)" stroke="none"/></svg>
                <?php endif; ?>
                <?php for ($i = 0; $i < $stars_empty; $i++) : ?>
                    <svg class="avis-star avis-star--empty" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <?php endfor; ?>
            </span>
            <span class="avis-badge__count"><?php echo esc_html($total_reviews); ?> avis</span>
        </div>
    </div>
</section>

<!-- GRILLE AVIS -->
<section class="avis-reviews-section">
    <div class="container">
        <div class="avis-grid">
            <?php if (empty($reviews)) : ?>
            <p style="text-align:center;color:var(--gray-400);padding:40px 0;">Aucun avis pour l'instant.</p>
        <?php endif; ?>

        <?php foreach ($reviews as $index => $review) :
                $author   = esc_html($review['author']);
                $location = esc_html($review['location'] ?? '');
                $rating   = intval($review['rating']);
                $rel_time = esc_html($review['relative_time'] ?? '');
                $text     = esc_html($review['text'] ?? '');
                $photo    = $review['photo_url'] ?? '';
                $initial  = strtoupper(mb_substr($author, 0, 1));
                $hidden   = $index >= 6 ? ' avis-card--hidden' : '';
            ?>
                <article class="avis-card<?php echo $hidden; ?>">
                    <!-- Google G icon top-right -->
                    <div class="avis-card__google" aria-hidden="true">
                        <?php echo $google_g_svg; ?>
                    </div>

                    <!-- Header: avatar + nom + ville -->
                    <div class="avis-card__header">
                        <div class="avis-card__avatar">
                            <?php if (!empty($photo)) : ?>
                                <img src="<?php echo esc_url($photo); ?>" alt="" width="42" height="42" loading="lazy">
                            <?php else : ?>
                                <?php echo esc_html($initial); ?>
                            <?php endif; ?>
                        </div>
                        <div class="avis-card__meta">
                            <strong class="avis-card__name"><?php echo $author; ?></strong>
                            <?php if ($location) : ?>
                                <span class="avis-card__location"><?php echo $location; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Étoiles + date -->
                    <div class="avis-card__rating">
                        <span class="avis-card__stars" aria-label="<?php echo $rating; ?> étoiles sur 5">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <svg class="avis-star <?php echo $i <= $rating ? 'avis-star--full' : 'avis-star--empty'; ?>" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <?php endfor; ?>
                        </span>
                        <?php if ($rel_time) : ?>
                            <span class="avis-card__time"><?php echo $rel_time; ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Texte de l'avis -->
                    <?php if ($text) : ?>
                        <p class="avis-card__text"><?php echo nl2br($text); ?></p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- Bouton "Afficher plus d'avis" -->
        <?php if (count($reviews) > 6) : ?>
        <div class="avis-load-more" id="avis-load-more">
            <button class="btn btn--primary btn--lg" id="avis-load-more-btn" type="button">
                Afficher plus d'avis
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
        </div>
        <?php endif; ?>

        <!-- Lien "Voir tous nos avis sur Google" -->
        <div class="avis-see-all">
            <a href="<?php echo esc_url($google_maps_url); ?>" class="avis-see-all__link" target="_blank" rel="noopener noreferrer">
                Voir tous nos avis sur Google
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
        </div>

        <script>
        (function () {
            var btn     = document.getElementById('avis-load-more-btn');
            var wrapper = document.getElementById('avis-load-more');
            if (!btn) return;
            btn.addEventListener('click', function () {
                document.querySelectorAll('.avis-card--hidden').forEach(function (card) {
                    card.classList.remove('avis-card--hidden');
                });
                wrapper.style.display = 'none';
            });
        })();
        </script>
    </div>
</section>

<!-- CTA Laisser un avis -->
<section class="avis-leave-section">
    <div class="container">
        <div class="avis-leave">
            <div class="avis-leave__stars" aria-hidden="true">
                <?php for ($i = 0; $i < 5; $i++) : ?>
                    <svg class="avis-star avis-star--full" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <?php endfor; ?>
            </div>
            <h2 class="avis-leave__title">Vous avez fait appel à nos services ?</h2>
            <p class="avis-leave__text">
                Votre avis compte énormément. Il aide d'autres particuliers à nous trouver et récompense le travail de notre équipe. Cela ne prend que 2 minutes.
            </p>
            <a href="<?php echo esc_url($google_maps_url); ?>" class="avis-leave__btn" target="_blank" rel="noopener noreferrer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                Laisser un avis sur Google
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
