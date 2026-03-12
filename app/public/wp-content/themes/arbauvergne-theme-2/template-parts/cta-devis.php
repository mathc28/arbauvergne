<?php
/**
 * Template Part: CTA Devis (sidebar / réutilisable)
 * 
 * @package Arbauvergne
 */
?>

<div class="cta-box">
    <h3 class="cta-box__title">Devis gratuit</h3>
    <p class="cta-box__text">
        Besoin d'un élagueur ? Contactez-nous pour un devis gratuit et sans engagement.
    </p>
    <a href="tel:<?php echo arba_get_phone('tel'); ?>" class="btn btn--primary btn--block">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
        <?php echo arba_get_phone(); ?>
    </a>
    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn--outline btn--block">
        Formulaire de devis
    </a>
    <ul class="cta-box__list">
        <li>✓ Réponse sous 48h</li>
        <li>✓ Devis détaillé gratuit</li>
        <li>✓ Sans engagement</li>
    </ul>
</div>
