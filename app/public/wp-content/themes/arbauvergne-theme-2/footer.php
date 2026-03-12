<?php
/**
 * Footer Template
 * 
 * @package Arbauvergne
 */

$address = arba_get_address();
$communes = arba_get_communes();
$services = arba_get_services();
?>

<!-- Footer -->
<footer class="footer">

    <!-- Ligne 1 : 3 colonnes -->
    <div class="container footer__inner">

        <!-- Colonne 1 : À propos -->
        <div class="footer__col">
            <h3 class="footer__title">Arb'Auvergne</h3>
            <p class="footer__text">
                Entreprise d'élagage et d'arboriculture à Aydat.
                Nous intervenons auprès des particuliers, professionnels et collectivités
                pour tous vos travaux sur les arbres.
            </p>
            <div class="footer__contact">
                <p>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <?php echo esc_html($address['full']); ?>
                </p>
                <p>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                    <a href="tel:<?php echo arba_get_phone('tel'); ?>"><?php echo arba_get_phone(); ?></a>
                </p>
            </div>
        </div>

        <!-- Colonne 2 : Services -->
        <div class="footer__col">
            <h3 class="footer__title">Nos Services</h3>
            <ul class="footer__links">
                <?php foreach ($services as $service) : ?>
                    <li>
                        <a href="<?php echo home_url('/' . $service['slug'] . '/'); ?>">
                            <?php echo esc_html($service['title']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li><a href="<?php echo home_url('/realisations/'); ?>">Nos réalisations</a></li>
                <li><a href="<?php echo home_url('/faq/'); ?>">FAQ</a></li>
            </ul>
        </div>

        <!-- Colonne 3 : Horaires -->
        <div class="footer__col">
            <h3 class="footer__title">Horaires</h3>
            <table class="footer__hours">
                <tr>
                    <td>Lundi - Vendredi</td>
                    <td>7h00 - 19h00</td>
                </tr>
                <tr>
                    <td>Samedi</td>
                    <td>8h00 - 17h00</td>
                </tr>
                <tr>
                    <td>Dimanche</td>
                    <td>Fermé</td>
                </tr>
            </table>
            <p class="footer__emergency">Urgence tempête : appelez-nous</p>
        </div>

    </div>

    <!-- Ligne 2 : Zone d'intervention pleine largeur -->
    <div class="footer__zone">
        <div class="container">
            <h3 class="footer__title">Zone d'intervention</h3>
            <ul class="footer__links footer__links--communes">
                <?php foreach ($communes as $commune) :
                    $slug = sanitize_title('elagage-' . $commune);
                ?>
                    <li>
                        <a href="<?php echo home_url('/' . $slug . '/'); ?>">
                            Élagage <?php echo esc_html($commune); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>



    <!-- Bottom bar -->
    <div class="footer__bottom">
        <div class="container footer__bottom-inner">
            <p>&copy; <?php echo date('Y'); ?> Arb'Auvergne — Tous droits réservés</p>
            <nav class="footer__legal">
                <a href="<?php echo home_url('/mentions-legales/'); ?>">Mentions légales</a>
                <a href="<?php echo home_url('/politique-de-confidentialite/'); ?>">Politique de confidentialité</a>
            </nav>
        </div>
    </div>
</footer>

<!-- Bouton téléphone flottant mobile -->
<a href="tel:<?php echo arba_get_phone('tel'); ?>" class="floating-phone" aria-label="Appeler Arb'Auvergne">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
</a>

<?php wp_footer(); ?>
</body>
</html>
