<?php
/**
 * Arb'Auvergne - Schema JSON-LD
 * Schema.org LocalBusiness + FAQ pour le SEO
 * 
 * @package Arbauvergne
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Schema LocalBusiness - Injecté sur toutes les pages
 */
function arba_schema_local_business() {
    $address = arba_get_address();
    $communes = arba_get_communes();
    
    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        '@id'         => home_url('/#localbusiness'),
        'name'        => "Arb'Auvergne",
        'description' => "Entreprise d'élagage et d'arboriculture à Aydat, Puy-de-Dôme. Élagage, abattage, débroussaillage pour particuliers, professionnels et collectivités.",
        'url'         => home_url('/'),
        'telephone'   => arba_get_phone('tel'),
        'email'       => 'contact@arbauvergne.fr',
        'address'     => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => $address['street'],
            'addressLocality' => $address['city'],
            'postalCode'      => $address['zip'],
            'addressCountry'  => 'FR',
            'addressRegion'   => 'Auvergne-Rhône-Alpes',
        ),
        'geo' => array(
            '@type'     => 'GeoCoordinates',
            'latitude'  => 45.6603,
            'longitude' => 2.9764,
        ),
        'areaServed' => array_map(function($commune) {
            return array(
                '@type' => 'City',
                'name'  => $commune,
            );
        }, $communes),
        'serviceType' => array(
            'Élagage',
            'Taille d\'arbres',
            'Abattage d\'arbres',
            'Débroussaillage',
            'Entretien d\'espaces verts',
        ),
        'openingHoursSpecification' => array(
            array(
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'),
                'opens'     => '07:00',
                'closes'    => '19:00',
            ),
            array(
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Saturday',
                'opens'     => '08:00',
                'closes'    => '17:00',
            ),
        ),
        'priceRange'       => '€€',
        'paymentAccepted'  => array('Espèces', 'Chèque', 'Virement bancaire'),
        'image'            => ARBA_URI . '/assets/img/arbauvergne-elagage.jpg',
        'sameAs'           => array(
            // Ajouter les profils réseaux sociaux ici
        ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'arba_schema_local_business');

/**
 * Schema FAQ - Injecté uniquement sur la page FAQ
 */
function arba_schema_faq() {
    if (!is_page('faq')) {
        return;
    }

    $faqs = array(
        array(
            'question' => 'Combien coûte un élagage à Aydat ?',
            'answer'   => 'Le prix d\'un élagage dépend de plusieurs facteurs : la hauteur de l\'arbre, son accessibilité, le type de taille et le volume de déchets à évacuer. Contactez-nous pour un devis gratuit et personnalisé.',
        ),
        array(
            'question' => 'Faut-il une autorisation pour abattre un arbre ?',
            'answer'   => 'Oui, dans certains cas une autorisation est nécessaire, notamment si l\'arbre est dans un secteur protégé, classé, ou soumis à un Plan Local d\'Urbanisme (PLU). Nous vous accompagnons dans les démarches administratives.',
        ),
        array(
            'question' => 'Quelle est la meilleure période pour élaguer ?',
            'answer'   => 'La période idéale dépend de l\'espèce. En général, l\'élagage se pratique en automne/hiver (hors période de gel) quand l\'arbre est en repos végétatif. Certaines tailles douces peuvent se faire en été.',
        ),
        array(
            'question' => 'Êtes-vous assuré pour les travaux d\'élagage ?',
            'answer'   => 'Oui, Arb\'Auvergne dispose d\'une assurance responsabilité civile professionnelle qui couvre tous nos chantiers. Nous pouvons vous fournir une attestation sur demande.',
        ),
        array(
            'question' => 'Intervenez-vous en urgence après une tempête ?',
            'answer'   => 'Oui, nous intervenons rapidement pour sécuriser les arbres dangereux suite à des intempéries. Contactez-nous par téléphone pour une intervention d\'urgence.',
        ),
        array(
            'question' => 'Quelles communes couvrez-vous autour d\'Aydat ?',
            'answer'   => 'Nous intervenons dans un rayon de 20 km autour d\'Aydat : Saint-Amant-Tallende, Cournols, Saulzet-le-Froid, Olloix, Vernines, Murol, Chambon-sur-Lac, Saint-Nectaire, Saint-Genès-Champanelle, Orcival et communes environnantes.',
        ),
    );

    $schema = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => array_map(function($faq) {
            return array(
                '@type' => 'Question',
                'name'  => $faq['question'],
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text'  => $faq['answer'],
                ),
            );
        }, $faqs),
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'arba_schema_faq');

/**
 * Schema BreadcrumbList - Navigation fil d'ariane
 */
function arba_schema_breadcrumb() {
    if (is_front_page()) {
        return;
    }

    $items = array();
    $position = 1;

    // Accueil toujours en premier
    $items[] = array(
        '@type'    => 'ListItem',
        'position' => $position++,
        'name'     => 'Accueil',
        'item'     => home_url('/'),
    );

    // Page parente si existe
    if (is_page() && wp_get_post_parent_id(get_the_ID())) {
        $parent = get_post(wp_get_post_parent_id(get_the_ID()));
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => $parent->post_title,
            'item'     => get_permalink($parent->ID),
        );
    }

    // Page actuelle
    if (is_page() || is_single()) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    }

    if (count($items) > 1) {
        $schema = array(
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $items,
        );

        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
}
add_action('wp_head', 'arba_schema_breadcrumb');
