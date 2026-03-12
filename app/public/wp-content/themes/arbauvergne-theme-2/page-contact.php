<?php
/**
 * Template de la page Contact
 * Slug de page WordPress : contact
 *
 * @package Arbauvergne
 */

get_header();
$address = arba_get_address();
?>

<!-- Hero small -->
<section class="hero hero--small hero--contact">
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title">Contactez-nous</h1>
        <p class="hero__subtitle">Devis gratuit sous 48h — Sans engagement</p>
    </div>
</section>

<!-- Contenu principal -->
<section class="section contact-section">
    <div class="container contact-layout">

        <!-- Colonne gauche : infos -->
        <div class="contact-info">

            <h2 class="contact-info__title">Nos coordonnées</h2>
            <p class="contact-info__intro">Vous pouvez nous joindre par téléphone, email ou en remplissant le formulaire. Nous répondons rapidement.</p>

            <ul class="contact-details">

                <li class="contact-details__item">
                    <div class="contact-details__icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    <div class="contact-details__content">
                        <span class="contact-details__label">Téléphone</span>
                        <a href="tel:<?php echo arba_get_phone('tel'); ?>" class="contact-details__value"><?php echo arba_get_phone(); ?></a>
                    </div>
                </li>

                <li class="contact-details__item">
                    <div class="contact-details__icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div class="contact-details__content">
                        <span class="contact-details__label">Email</span>
                        <a href="mailto:<?php echo arba_get_email(); ?>" class="contact-details__value"><?php echo arba_get_email(); ?></a>
                    </div>
                </li>

                <li class="contact-details__item">
                    <div class="contact-details__icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div class="contact-details__content">
                        <span class="contact-details__label">Adresse</span>
                        <span class="contact-details__value"><?php echo esc_html($address['street']); ?><br><?php echo esc_html($address['zip'] . ' ' . $address['city']); ?></span>
                    </div>
                </li>

                <li class="contact-details__item">
                    <div class="contact-details__icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="contact-details__content">
                        <span class="contact-details__label">Horaires</span>
                        <span class="contact-details__value">
                            Lun – Ven : 8h00 – 18h00<br>
                            Samedi : 8h00 – 12h00<br>
                            Dimanche : Fermé
                        </span>
                    </div>
                </li>

            </ul>

            <!-- Réseaux sociaux -->
            <div class="contact-social">
                <p class="contact-social__label">Suivez-nous</p>
                <div class="contact-social__icons">
                    <a href="https://www.facebook.com/" class="contact-social__link" aria-label="Facebook" target="_blank" rel="noopener">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/" class="contact-social__link" aria-label="LinkedIn" target="_blank" rel="noopener">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    <a href="https://www.instagram.com/" class="contact-social__link" aria-label="Instagram" target="_blank" rel="noopener">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                </div>
            </div>

        </div>

        <!-- Colonne droite : formulaire CF7 -->
        <div class="contact-form-wrapper">
            <div class="contact-form-card">
                <h2 class="contact-form-card__title">Demander un devis gratuit</h2>
                <p class="contact-form-card__subtitle">Décrivez votre besoin, nous vous répondons sous 48h.</p>

                <?php
                // Remplacer l'ID par celui de votre formulaire Contact Form 7
                if (function_exists('wpcf7_contact_form')) :
                    echo do_shortcode('[contact-form-7 id="daecd6a" title="Arbauvergne"]');
                else :
                ?>
                    <p class="contact-form-card__notice">Le plugin Contact Form 7 doit être activé.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<!-- Carte Google Maps pleine largeur -->
<section class="contact-map-section">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d350000!2d2.8!3d45.7!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f6d84bb655acf5%3A0x79e4af42e541e8c3!2sAuvergne!5e0!3m2!1sfr!2sfr"
        width="100%"
        height="450"
        style="border:0; display:block;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Localisation Arb'Auvergne à Aydat">
    </iframe>
</section>

<?php get_footer(); ?>
