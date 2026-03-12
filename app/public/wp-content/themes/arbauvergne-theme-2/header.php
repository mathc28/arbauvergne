<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2D5016">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header — Transparent sur hero, blanc au scroll -->
<header class="header" id="header">
    <div class="container header__inner">
        
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo" aria-label="Arb'Auvergne - Accueil">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png" alt="Arb'Auvergne" class="header__logo-img">
        </a>

        <!-- Navigation majuscules -->
        <nav class="nav" id="nav" aria-label="Navigation principale">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav__list',
                'fallback_cb'    => 'arba_fallback_menu',
                'depth'          => 2,
            ));
            ?>
        </nav>

        <!-- CTA Devis -->
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="header__cta">
            Devis gratuit
        </a>

        <!-- Burger mobile -->
        <button class="header__burger" id="burger" aria-label="Ouvrir le menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<?php
function arba_fallback_menu() {
    echo '<ul class="nav__list">';
    echo '<li class="nav__item"><a href="' . home_url('/') . '" class="nav__link">Accueil</a></li>';
    echo '<li class="nav__item"><a href="' . home_url('/elagage-taille-arbres/') . '" class="nav__link">Services</a></li>';
    echo '<li class="nav__item"><a href="' . home_url('/realisations/') . '" class="nav__link">Réalisations</a></li>';
    echo '<li class="nav__item"><a href="' . home_url('/conseils/') . '" class="nav__link">Conseils</a></li>';
    echo '<li class="nav__item"><a href="' . home_url('/avis/') . '" class="nav__link">Avis</a></li>';
    echo '<li class="nav__item"><a href="' . esc_url(get_permalink(get_page_by_path('contact'))) . '" class="nav__link">Contact</a></li>';
    echo '</ul>';
}
?>
