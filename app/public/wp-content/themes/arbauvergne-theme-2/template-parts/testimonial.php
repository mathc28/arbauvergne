<?php
/**
 * Template Part: Testimonial Card
 * Markup identique aux cartes de la page /avis
 *
 * @package Arbauvergne
 */

$client_name   = get_post_meta(get_the_ID(), '_arba_client_name', true) ?: get_the_title();
$client_commune = get_post_meta(get_the_ID(), '_arba_client_commune', true);
$client_rating  = intval(get_post_meta(get_the_ID(), '_arba_client_rating', true)) ?: 5;
$client_date    = get_post_meta(get_the_ID(), '_arba_client_date', true);
$initial        = strtoupper(mb_substr($client_name, 0, 1));

// Date relative
$relative_time = '';
if ($client_date) {
    $diff_days = (int) floor((time() - strtotime($client_date)) / DAY_IN_SECONDS);
    if ($diff_days < 1)           $relative_time = "Aujourd'hui";
    elseif ($diff_days < 14)      $relative_time = 'Il y a ' . $diff_days . ' jour' . ($diff_days > 1 ? 's' : '');
    elseif ($diff_days < 60)      $relative_time = 'Il y a ' . round($diff_days / 7) . ' semaine' . (round($diff_days / 7) > 1 ? 's' : '');
    elseif ($diff_days < 365)     $relative_time = 'Il y a ' . round($diff_days / 30) . ' mois';
    else                          $relative_time = 'Il y a ' . round($diff_days / 365) . ' an' . (round($diff_days / 365) > 1 ? 's' : '');
}

$text = wp_strip_all_tags(apply_filters('the_content', get_the_content()));

$google_g_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>';
?>

<article class="avis-card">
    <div class="avis-card__google" aria-hidden="true">
        <?php echo $google_g_svg; ?>
    </div>

    <div class="avis-card__header">
        <div class="avis-card__avatar"><?php echo esc_html($initial); ?></div>
        <div class="avis-card__meta">
            <strong class="avis-card__name"><?php echo esc_html($client_name); ?></strong>
            <?php if ($client_commune) : ?>
                <span class="avis-card__location"><?php echo esc_html($client_commune); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="avis-card__rating">
        <span class="avis-card__stars" aria-label="<?php echo $client_rating; ?> étoiles sur 5">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <svg class="avis-star <?php echo $i <= $client_rating ? 'avis-star--full' : 'avis-star--empty'; ?>" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <?php endfor; ?>
        </span>
        <?php if ($relative_time) : ?>
            <span class="avis-card__time"><?php echo esc_html($relative_time); ?></span>
        <?php endif; ?>
    </div>

    <?php if ($text) : ?>
        <p class="avis-card__text"><?php echo nl2br(esc_html($text)); ?></p>
    <?php endif; ?>
</article>
