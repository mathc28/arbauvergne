<?php
/**
 * Front Page — Design Lovable
 * @package Arbauvergne
 */
get_header();
$services = arba_get_services();
$communes = arba_get_communes();
?>

<!-- HERO -->
<section class="hero">
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title">Élagueur professionnel à Aydat dans le Puy-de-Dôme</h1>
        <p class="hero__subtitle">Élagage, abattage et entretien d'arbres. Devis gratuit sous 48h.</p>
        <div class="hero__actions">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn--primary btn--lg">
                Demander un devis
            </a>
            <a href="tel:<?php echo arba_get_phone('tel'); ?>" class="btn btn--outline btn--lg">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                <?php echo arba_get_phone(); ?>
            </a>
        </div>
    </div>
</section>

<!-- ========================= STATS ========================= -->
<section class="stats">
    <div class="container stats__inner">
        <div class="stats__item">
            <div class="stats__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <span class="stats__number">Aydat</span>
            <span class="stats__label">Au cœur du Puy-de-Dôme</span>
        </div>
        <div class="stats__item">
            <div class="stats__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 8v8M8 12h8"/></svg>
            </div>
            <span class="stats__number">20 km</span>
            <span class="stats__label">Rayon d'intervention</span>
        </div>
        <div class="stats__item">
            <div class="stats__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            </div>
            <span class="stats__number">3 clientèles</span>
            <span class="stats__label">Particuliers, pros, collectivités</span>
        </div>
        <div class="stats__item">
            <div class="stats__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
            </div>
            <span class="stats__number">100%</span>
            <span class="stats__label">Devis gratuit</span>
        </div>
    </div>
</section>

<!-- ========================= SERVICES ========================= -->
<section class="services section">
    <div class="container">
        <h2 class="section__title">Nos services</h2>
        <p class="section__subtitle">Des prestations adaptées à tous vos besoins en arboriculture</p>
        
        <div class="services__grid">
            <?php foreach ($services as $key => $service) : ?>
                <article class="service-card">
                    <div class="service-card__icon">
                        <?php if ($key === 'elagage') : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4a7c28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tree-pine-icon lucide-tree-pine"><path d="m17 14 3 3.3a1 1 0 0 1-.7 1.7H4.7a1 1 0 0 1-.7-1.7L7 14h-.3a1 1 0 0 1-.7-1.7L9 9h-.2A1 1 0 0 1 8 7.3L12 3l4 4.3a1 1 0 0 1-.8 1.7H15l3 3.3a1 1 0 0 1-.7 1.7H17Z"/><path d="M12 22v-3"/></svg>
                        <?php elseif ($key === 'abattage') : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4a7c28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-axe-icon lucide-axe"><path d="m14 12-8.381 8.38a1 1 0 0 1-3.001-3L11 9"/><path d="M15 15.5a.5.5 0 0 0 .5.5A6.5 6.5 0 0 0 22 9.5a.5.5 0 0 0-.5-.5h-1.672a2 2 0 0 1-1.414-.586l-5.062-5.062a1.205 1.205 0 0 0-1.704 0L9.352 5.648a1.205 1.205 0 0 0 0 1.704l5.062 5.062A2 2 0 0 1 15 13.828z"/></svg>
                            <?php else : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4a7c28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tree-deciduous-icon lucide-tree-deciduous"><path d="M8 19a4 4 0 0 1-2.24-7.32A3.5 3.5 0 0 1 9 6.03V6a3 3 0 1 1 6 0v.04a3.5 3.5 0 0 1 3.24 5.65A4 4 0 0 1 16 19Z"/><path d="M12 19v3"/></svg>
                        <?php endif; ?>
                    </div>
                    <h3 class="service-card__title"><?php echo esc_html($service['title']); ?></h3>
                    <p class="service-card__desc"><?php echo esc_html($service['desc']); ?></p>
                    <a href="<?php echo home_url('/' . $service['slug'] . '/'); ?>" class="service-card__link">
                        En savoir plus →
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========================= À PROPOS ========================= -->
<section class="about section">
    <div class="container about__inner">
        <div class="about__content">
            <h2 class="about__title">Votre arboriste de confiance en Auvergne</h2>
            <p class="about__text">
                Basés à Aydat, nous intervenons dans tout le Puy-de-Dôme pour l'entretien et le 
                soin de vos arbres. Notre expertise et notre passion pour l'arboriculture garantissent 
                un travail soigné et respectueux du patrimoine arboré.
            </p>
            <ul class="about__list">
                <li>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Arboristes grimpeurs diplômés
                </li>
                <li>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Assurance RC Professionnelle
                </li>
                <li>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Respect de l'environnement
                </li>
                <li>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Devis gratuit sous 48h
                </li>
            </ul>
            <a href="<?php echo home_url('/a-propos/'); ?>" class="btn btn--primary-dark">
                Découvrir notre entreprise
            </a>
        </div>
        <div class="about__image">
            <?php 
            // Image d'arboriste — à remplacer par une vraie photo
            $about_img = get_template_directory_uri() . '/assets/images/unknown.jpeg';
            ?>
            <img src="<?php echo esc_url($about_img); ?>" alt="Arboriste grimpeur Arb'Auvergne en intervention à Aydat" loading="lazy" width="600" height="500">
        </div>
    </div>
</section>

<!-- TÉMOIGNAGES -->
<section class="testimonials section">
    <div class="container">
        <h2 class="section__title">Ce que disent nos clients</h2>
        <p class="section__subtitle">La satisfaction de nos clients est notre meilleure publicité</p>

        <?php
        $temoignages = new WP_Query(array(
            'post_type'      => 'temoignage',
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));

        $google_g_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>';
        ?>

        <div class="testimonials__grid">
            <?php if ($temoignages->have_posts()) :
                while ($temoignages->have_posts()) : $temoignages->the_post();
                    get_template_part('template-parts/testimonial');
                endwhile;
                wp_reset_postdata();
            else :
                $fallback = array(
                    array('name' => 'Marie L.',  'commune' => 'Aydat',               'rating' => 5, 'time' => 'Il y a 2 semaines', 'text' => 'Travail impeccable pour l\'élagage de nos grands chênes. Équipe professionnelle et respectueuse du jardin. Je recommande vivement !'),
                    array('name' => 'Pierre D.', 'commune' => 'Saint-Amant-Tallende','rating' => 5, 'time' => 'Il y a 1 mois',    'text' => 'Intervention rapide pour un abattage délicat près de la maison. Résultat parfait, chantier propre. Devis respecté à l\'euro près.'),
                    array('name' => 'Isabelle M.','commune' => 'Murol',              'rating' => 5, 'time' => 'Il y a 3 mois',    'text' => 'Excellent débroussaillage de notre terrain en pente. L\'équipe est ponctuelle, efficace et très agréable. Merci Arb\'Auvergne !'),
                );
                foreach ($fallback as $t) :
                    $initial = strtoupper(mb_substr($t['name'], 0, 1));
            ?>
                <article class="avis-card">
                    <div class="avis-card__google" aria-hidden="true"><?php echo $google_g_svg; ?></div>
                    <div class="avis-card__header">
                        <div class="avis-card__avatar"><?php echo esc_html($initial); ?></div>
                        <div class="avis-card__meta">
                            <strong class="avis-card__name"><?php echo esc_html($t['name']); ?></strong>
                            <span class="avis-card__location"><?php echo esc_html($t['commune']); ?></span>
                        </div>
                    </div>
                    <div class="avis-card__rating">
                        <span class="avis-card__stars">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <svg class="avis-star <?php echo $i <= $t['rating'] ? 'avis-star--full' : 'avis-star--empty'; ?>" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <?php endfor; ?>
                        </span>
                        <span class="avis-card__time"><?php echo esc_html($t['time']); ?></span>
                    </div>
                    <p class="avis-card__text"><?php echo esc_html($t['text']); ?></p>
                </article>
            <?php
                endforeach;
            endif;
            ?>
        </div>

        <!-- Lien vers la page avis complète -->
        <div style="text-align:center;margin-top:40px;">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('avis'))); ?>" class="avis-see-all__link">
                Voir tous nos avis
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
        </div>

    </div>
</section>

<!-- ========================= ZONE D'INTERVENTION ========================= -->
<section class="zone section">
    <div class="container zone__inner">
        <div class="zone__content">
            <h2 class="zone__title">Notre zone d'intervention</h2>
            <p class="zone__text">
                Nous intervenons dans un rayon de 20 km autour d'Aydat et dans les communes 
                environnantes du Puy-de-Dôme.
            </p>
            <ul class="zone__communes">
                <?php foreach ($communes as $commune) : ?>
                    <li>
                        <a href="<?php echo home_url('/elagage-' . sanitize_title($commune) . '/'); ?>">
                            <?php echo esc_html($commune); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="zone__map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d350000!2d2.8!3d45.7!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f6d84bb655acf5%3A0x79e4af42e541e8c3!2sAuvergne!5e0!3m2!1sfr!2sfr"
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                title="Zone d'intervention Arb'Auvergne autour d'Aydat">
            </iframe>
        </div>
    </div>
</section>

<!-- ========================= CTA FINAL ========================= -->
<section class="cta-section">
    <div class="cta-section__inner container">
        <h2 class="cta-section__title">Besoin d'un élagueur dans le Puy-de-Dôme ?</h2>
        <p class="cta-section__text">Contactez-nous dès maintenant pour un devis gratuit et sans engagement.</p>
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
