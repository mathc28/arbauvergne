<?php
/**
 * Arb'Auvergne Theme Functions
 * 
 * @package Arbauvergne
 * @version 1.0.0
 */

// Empêcher l'accès direct
if (!defined('ABSPATH')) {
    exit;
}

// Désactiver la barre admin WordPress
add_filter('show_admin_bar', '__return_false');

// Constantes du thème
define('ARBA_VERSION', '1.0.0');
define('ARBA_DIR', get_template_directory());
define('ARBA_URI', get_template_directory_uri());

// ============================================
// 1. SETUP DU THÈME
// ============================================
function arba_setup() {
    // Support du titre dynamique
    add_theme_support('title-tag');

    // Support des images à la une
    add_theme_support('post-thumbnails');

    // Tailles d'images custom
    add_image_size('hero', 1920, 800, true);
    add_image_size('service-card', 600, 400, true);
    add_image_size('gallery-thumb', 400, 300, true);
    add_image_size('gallery-large', 1200, 800, true);

    // Support du logo custom
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Support HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Menus
    register_nav_menus(array(
        'primary'   => __('Menu Principal', 'arbauvergne'),
        'footer'    => __('Menu Footer', 'arbauvergne'),
    ));
}
add_action('after_setup_theme', 'arba_setup');

// ============================================
// 2. ENQUEUE STYLES & SCRIPTS
// ============================================
function arba_scripts() {
    // CSS principal
    wp_enqueue_style(
        'arba-main',
        ARBA_URI . '/assets/css/main.css',
        array(),
        ARBA_VERSION
    );

    // JS principal (dans le footer)
    wp_enqueue_script(
        'arba-main',
        ARBA_URI . '/assets/js/main.js',
        array(),
        ARBA_VERSION,
        true
    );

    // CSS page Contact (chargé uniquement sur la page contact)
    if (is_page('contact')) {
        wp_enqueue_style(
            'arba-contact',
            ARBA_URI . '/assets/css/contact.css',
            array('arba-main'),
            ARBA_VERSION
        );
    }

    // Localisation JS (pour AJAX si besoin)
    wp_localize_script('arba-main', 'arba_ajax', array(
        'url'   => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('arba_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'arba_scripts');

// ============================================
// 3. CUSTOM POST TYPES
// ============================================
function arba_register_post_types() {
    
    // CPT Réalisations
    register_post_type('realisation', array(
        'labels' => array(
            'name'               => 'Réalisations',
            'singular_name'      => 'Réalisation',
            'add_new'            => 'Ajouter une réalisation',
            'add_new_item'       => 'Ajouter une nouvelle réalisation',
            'edit_item'          => 'Modifier la réalisation',
            'view_item'          => 'Voir la réalisation',
            'all_items'          => 'Toutes les réalisations',
            'search_items'       => 'Rechercher une réalisation',
            'not_found'          => 'Aucune réalisation trouvée',
        ),
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'realisations'),
        'menu_icon'     => 'dashicons-camera',
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'  => true,
    ));

    // CPT Témoignages
    register_post_type('temoignage', array(
        'labels' => array(
            'name'               => 'Témoignages',
            'singular_name'      => 'Témoignage',
            'add_new'            => 'Ajouter un témoignage',
            'add_new_item'       => 'Ajouter un nouveau témoignage',
            'edit_item'          => 'Modifier le témoignage',
            'view_item'          => 'Voir le témoignage',
            'all_items'          => 'Tous les témoignages',
        ),
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => array('slug' => 'temoignages'),
        'menu_icon'     => 'dashicons-format-quote',
        'supports'      => array('title', 'editor'),
        'show_in_rest'  => true,
    ));
}
add_action('init', 'arba_register_post_types');

// ============================================
// 4. TAXONOMIES CUSTOM
// ============================================
function arba_register_taxonomies() {

    // Taxonomie : Type de service (pour réalisations)
    register_taxonomy('type_service', array('realisation'), array(
        'labels' => array(
            'name'          => 'Types de service',
            'singular_name' => 'Type de service',
            'add_new_item'  => 'Ajouter un type de service',
        ),
        'hierarchical'  => true,
        'rewrite'       => array('slug' => 'type-service'),
        'show_in_rest'  => true,
    ));

    // Taxonomie : Commune (pour réalisations et pages locales)
    register_taxonomy('commune', array('realisation'), array(
        'labels' => array(
            'name'          => 'Communes',
            'singular_name' => 'Commune',
            'add_new_item'  => 'Ajouter une commune',
        ),
        'hierarchical'  => true,
        'rewrite'       => array('slug' => 'commune'),
        'show_in_rest'  => true,
    ));
}
add_action('init', 'arba_register_taxonomies');

// ============================================
// 5. CUSTOM FIELDS (sans plugin ACF)
// ============================================
function arba_add_meta_boxes() {
    
    // Meta box pour les témoignages
    add_meta_box(
        'arba_temoignage_details',
        'Détails du témoignage',
        'arba_temoignage_meta_box_callback',
        'temoignage',
        'normal',
        'high'
    );

    // Meta box pour les réalisations
    add_meta_box(
        'arba_realisation_details',
        'Détails de la réalisation',
        'arba_realisation_meta_box_callback',
        'realisation',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'arba_add_meta_boxes');

// Callback témoignage
function arba_temoignage_meta_box_callback($post) {
    wp_nonce_field('arba_save_temoignage', 'arba_temoignage_nonce');
    
    $client_name = get_post_meta($post->ID, '_arba_client_name', true);
    $client_commune = get_post_meta($post->ID, '_arba_client_commune', true);
    $client_rating = get_post_meta($post->ID, '_arba_client_rating', true);
    $client_date = get_post_meta($post->ID, '_arba_client_date', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="arba_client_name">Prénom du client</label></th>
            <td><input type="text" id="arba_client_name" name="arba_client_name" value="<?php echo esc_attr($client_name); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="arba_client_commune">Commune</label></th>
            <td><input type="text" id="arba_client_commune" name="arba_client_commune" value="<?php echo esc_attr($client_commune); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Note</label></th>
            <td>
                <div class="arba-star-picker" style="display:flex;gap:6px;align-items:center;">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <span class="arba-star"
                              data-value="<?php echo $i; ?>"
                              style="font-size:28px;cursor:pointer;color:<?php echo $i <= intval($client_rating) ? '#F59E0B' : '#D1D5DB'; ?>;"
                        >★</span>
                    <?php endfor; ?>
                    <span class="arba-star-label" style="margin-left:8px;color:#555;font-size:13px;">
                        <?php echo $client_rating ? $client_rating . ' / 5' : 'Cliquez pour noter'; ?>
                    </span>
                </div>
                <input type="hidden" id="arba_client_rating" name="arba_client_rating" value="<?php echo esc_attr($client_rating ?: 5); ?>">
                <script>
                (function() {
                    var stars  = document.querySelectorAll('.arba-star-picker .arba-star');
                    var input  = document.getElementById('arba_client_rating');
                    var label  = document.querySelector('.arba-star-picker .arba-star-label');
                    function paint(val) {
                        stars.forEach(function(s) {
                            s.style.color = parseInt(s.dataset.value) <= val ? '#F59E0B' : '#D1D5DB';
                        });
                        label.textContent = val + ' / 5';
                    }
                    stars.forEach(function(star) {
                        star.addEventListener('mouseover', function() { paint(parseInt(this.dataset.value)); });
                        star.addEventListener('mouseout',  function() { paint(parseInt(input.value)); });
                        star.addEventListener('click',     function() {
                            input.value = this.dataset.value;
                            paint(parseInt(this.dataset.value));
                        });
                    });
                })();
                </script>
            </td>
        </tr>
        <tr>
            <th><label for="arba_client_date">Date</label></th>
            <td><input type="date" id="arba_client_date" name="arba_client_date" value="<?php echo esc_attr($client_date); ?>"></td>
        </tr>
    </table>
    <?php
}

// Callback réalisation
function arba_realisation_meta_box_callback($post) {
    wp_nonce_field('arba_save_realisation', 'arba_realisation_nonce');
    
    $lieu = get_post_meta($post->ID, '_arba_lieu', true);
    $type_intervention = get_post_meta($post->ID, '_arba_type_intervention', true);
    $difficulte = get_post_meta($post->ID, '_arba_difficulte', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="arba_lieu">Lieu / Commune</label></th>
            <td><input type="text" id="arba_lieu" name="arba_lieu" value="<?php echo esc_attr($lieu); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="arba_type_intervention">Type d'intervention</label></th>
            <td>
                <select id="arba_type_intervention" name="arba_type_intervention">
                    <option value="elagage" <?php selected($type_intervention, 'elagage'); ?>>Élagage</option>
                    <option value="abattage" <?php selected($type_intervention, 'abattage'); ?>>Abattage</option>
                    <option value="debroussaillage" <?php selected($type_intervention, 'debroussaillage'); ?>>Débroussaillage</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="arba_difficulte">Difficulté</label></th>
            <td>
                <select id="arba_difficulte" name="arba_difficulte">
                    <option value="standard" <?php selected($difficulte, 'standard'); ?>>Standard</option>
                    <option value="technique" <?php selected($difficulte, 'technique'); ?>>Technique</option>
                    <option value="complexe" <?php selected($difficulte, 'complexe'); ?>>Complexe</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label>Image Avant</label></th>
            <td><p style="color:#666;font-size:12px;">Utiliser l'image mise en avant (vignette) comme photo "Avant".</p></td>
        </tr>
        <tr>
            <th><label>Image Après</label></th>
            <td>
                <?php
                $image_apres_id  = get_post_meta($post->ID, '_arba_image_apres', true);
                $image_apres_url = $image_apres_id ? wp_get_attachment_image_url($image_apres_id, 'medium') : '';
                ?>
                <div style="display:flex;align-items:flex-start;gap:12px;flex-wrap:wrap;">
                    <div id="arba-apres-preview" style="<?php echo $image_apres_url ? '' : 'display:none;'; ?>">
                        <img src="<?php echo esc_url($image_apres_url); ?>" style="max-width:200px;border-radius:4px;display:block;margin-bottom:8px;" id="arba-apres-img">
                        <button type="button" class="button" id="arba-apres-remove">Supprimer</button>
                    </div>
                    <div>
                        <button type="button" class="button" id="arba-apres-upload"><?php echo $image_apres_url ? 'Changer l\'image' : 'Choisir une image'; ?></button>
                        <input type="hidden" id="arba_image_apres" name="arba_image_apres" value="<?php echo esc_attr($image_apres_id); ?>">
                    </div>
                </div>
                <script>
                (function($) {
                    var frame;
                    $('#arba-apres-upload').on('click', function(e) {
                        e.preventDefault();
                        if (frame) { frame.open(); return; }
                        frame = wp.media({ title: 'Image Après', button: { text: 'Utiliser cette image' }, multiple: false });
                        frame.on('select', function() {
                            var att = frame.state().get('selection').first().toJSON();
                            $('#arba_image_apres').val(att.id);
                            $('#arba-apres-img').attr('src', att.url);
                            $('#arba-apres-preview').show();
                            $('#arba-apres-upload').text('Changer l\'image');
                        });
                        frame.open();
                    });
                    $('#arba-apres-remove').on('click', function() {
                        $('#arba_image_apres').val('');
                        $('#arba-apres-preview').hide();
                        $('#arba-apres-upload').text('Choisir une image');
                    });
                })(jQuery);
                </script>
            </td>
        </tr>
    </table>
    <?php
}

// Sauvegarde des meta boxes
function arba_save_meta_boxes($post_id) {
    // Témoignage
    if (isset($_POST['arba_temoignage_nonce']) && wp_verify_nonce($_POST['arba_temoignage_nonce'], 'arba_save_temoignage')) {
        if (isset($_POST['arba_client_name'])) {
            update_post_meta($post_id, '_arba_client_name', sanitize_text_field($_POST['arba_client_name']));
        }
        if (isset($_POST['arba_client_commune'])) {
            update_post_meta($post_id, '_arba_client_commune', sanitize_text_field($_POST['arba_client_commune']));
        }
        if (isset($_POST['arba_client_rating'])) {
            update_post_meta($post_id, '_arba_client_rating', intval($_POST['arba_client_rating']));
        }
        if (isset($_POST['arba_client_date'])) {
            update_post_meta($post_id, '_arba_client_date', sanitize_text_field($_POST['arba_client_date']));
        }
    }

    // Réalisation
    if (isset($_POST['arba_realisation_nonce']) && wp_verify_nonce($_POST['arba_realisation_nonce'], 'arba_save_realisation')) {
        if (isset($_POST['arba_lieu'])) {
            update_post_meta($post_id, '_arba_lieu', sanitize_text_field($_POST['arba_lieu']));
        }
        if (isset($_POST['arba_type_intervention'])) {
            update_post_meta($post_id, '_arba_type_intervention', sanitize_text_field($_POST['arba_type_intervention']));
        }
        if (isset($_POST['arba_difficulte'])) {
            update_post_meta($post_id, '_arba_difficulte', sanitize_text_field($_POST['arba_difficulte']));
        }
        if (isset($_POST['arba_image_apres'])) {
            update_post_meta($post_id, '_arba_image_apres', intval($_POST['arba_image_apres']) ?: '');
        }
    }
}
add_action('save_post', 'arba_save_meta_boxes');

// ============================================
// 6. WIDGETS / SIDEBARS
// ============================================
function arba_widgets_init() {
    register_sidebar(array(
        'name'          => 'Sidebar Blog',
        'id'            => 'sidebar-blog',
        'description'   => 'Sidebar pour les pages du blog/conseils',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'arba_widgets_init');

// ============================================
// 7. SÉCURITÉ & PERFORMANCE
// ============================================

// Supprimer la version WordPress du head
remove_action('wp_head', 'wp_generator');

// Supprimer les liens inutiles du head
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

// Désactiver les emojis WordPress (performance)
function arba_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'arba_disable_emojis');

// Désactiver XML-RPC (sécurité)
add_filter('xmlrpc_enabled', '__return_false');

// Limiter les révisions
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

// ============================================
// 8. HELPERS / FONCTIONS UTILITAIRES
// ============================================

/**
 * Récupérer le numéro de téléphone formaté
 */
function arba_get_phone($format = 'display') {
    $phone = '06 14 61 58 29';
    if ($format === 'tel') {
        return '+33614615829';
    }
    return $phone;
}

/**
 * Récupérer l'email de contact
 */
function arba_get_email() {
    return 'contact@arb-auvergne.fr';
}

/**
 * Récupérer l'adresse
 */
function arba_get_address() {
    return array(
        'street'  => '1 Impasse du Tessignou',
        'city'    => 'Aydat',
        'zip'     => '63970',
        'country' => 'France',
        'full'    => '1 Impasse du Tessignou, 63970 Aydat',
    );
}

/**
 * Liste des communes desservies
 */
function arba_get_communes() {
    return array(
        'Aydat',
        'Saint-Amant-Tallende',
        'Cournols',
        'Saulzet-le-Froid',
        'Olloix',
        'Vernines',
        'Le Vernet-Sainte-Marguerite',
        'Murol',
        'Chambon-sur-Lac',
        'Saint-Nectaire',
        'Saint-Genès-Champanelle',
        'Orcival',
    );
}

/**
 * Liste des services
 */
function arba_get_services() {
    return array(
        'elagage' => array(
            'title' => 'Élagage & Taille',
            'slug'  => 'elagage-taille-arbres',
            'icon'  => 'tree',
            'desc'  => 'Taille douce, taille de formation, taille de sécurité, taille de haies et arbres fruitiers.',
        ),
        'abattage' => array(
            'title' => 'Abattage d\'arbres',
            'slug'  => 'abattage-arbres',
            'icon'  => 'axe',
            'desc'  => 'Abattage classique, démontage technique avec rétention, intervention en zone contrainte.',
        ),
        'debroussaillage' => array(
            'title' => 'Débroussaillage & Entretien',
            'slug'  => 'debroussaillage-entretien',
            'icon'  => 'leaf',
            'desc'  => 'Débroussaillage de terrains, nettoyage de parcelles, entretien d\'espaces verts, broyage.',
        ),
    );
}

// ============================================
// 9. INCLUDES
// ============================================
require_once ARBA_DIR . '/inc/seo-schema.php';

// ============================================
// 10. GOOGLE PLACES REVIEWS
// ============================================

/**
 * Récupère les avis Google via l'API Places.
 * Nécessite dans wp-config.php :
 *   define('GOOGLE_PLACES_API_KEY', 'votre_clé');
 *   define('GOOGLE_PLACE_ID', 'votre_place_id');
 *
 * @return array|false  ['rating', 'total', 'reviews'] ou false si indisponible.
 */
function arba_get_google_reviews() {
    $cached = get_transient('arba_google_reviews');
    if ($cached !== false) {
        return $cached;
    }

    if (!defined('GOOGLE_PLACES_API_KEY') || !defined('GOOGLE_PLACE_ID')) {
        return false;
    }

    $url = add_query_arg(array(
        'place_id' => GOOGLE_PLACE_ID,
        'fields'   => 'rating,user_ratings_total,reviews',
        'language' => 'fr',
        'reviews_sort' => 'newest',
        'key'      => GOOGLE_PLACES_API_KEY,
    ), 'https://maps.googleapis.com/maps/api/place/details/json');

    $response = wp_remote_get($url, array('timeout' => 10));

    if (is_wp_error($response)) {
        return false;
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);

    if (empty($body['result'])) {
        return false;
    }

    $data = array(
        'rating'  => $body['result']['rating'] ?? 0,
        'total'   => $body['result']['user_ratings_total'] ?? 0,
        'reviews' => $body['result']['reviews'] ?? array(),
    );

    set_transient('arba_google_reviews', $data, HOUR_IN_SECONDS);

    return $data;
}

/**
 * Vide le cache des avis Google (utile si on veut forcer un refresh).
 */
function arba_flush_google_reviews_cache() {
    delete_transient('arba_google_reviews');
}

// Enqueue CSS page Avis
add_action('wp_enqueue_scripts', function () {
    if (is_page('avis')) {
        wp_enqueue_style(
            'arba-avis',
            ARBA_URI . '/assets/css/avis.css',
            array('arba-main'),
            ARBA_VERSION
        );
    }
    if (is_post_type_archive('realisation') || is_singular('realisation')) {
        wp_enqueue_style(
            'arba-realisations',
            ARBA_URI . '/assets/css/realisations.css',
            array('arba-main'),
            ARBA_VERSION
        );
    }
    if (is_page('conseils')) {
        wp_enqueue_style(
            'arba-conseils',
            ARBA_URI . '/assets/css/conseils.css',
            array('arba-main'),
            ARBA_VERSION
        );
    }
});
