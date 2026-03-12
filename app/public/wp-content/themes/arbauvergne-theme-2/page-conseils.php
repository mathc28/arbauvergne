<?php
/**
 * Template de la page Conseils
 * Slug de page WordPress : conseils
 * Page statique — contenu géré directement dans ce fichier.
 *
 * @package Arbauvergne
 */

get_header();

$articles = array(
    array(
        'titre' => 'Quand faut-il tailler ses arbres ?',
        'contenu' => '
            <p>La période idéale de taille dépend de l\'espèce et de l\'objectif recherché. En règle générale :</p>
            <ul>
                <li><strong>Arbres d\'ornement et fruitiers</strong> : fin d\'hiver (février–mars), avant le débourrement, quand la sève n\'est pas encore montée. Les plaies cicatrisent mieux et les maladies fongiques sont limitées.</li>
                <li><strong>Haies et arbustes à fleurs printanières</strong> : juste après la floraison, pour ne pas supprimer les futures fleurs.</li>
                <li><strong>Taille de sécurité</strong> : à tout moment de l\'année si une branche présente un danger immédiat (branche morte, surplomb de voirie, risque de chute).</li>
            </ul>
            <p>À éviter absolument : la taille en période de gel intense ou de forte chaleur estivale, qui affaiblit l\'arbre et favorise les infections. En cas de doute, un arboriste professionnel évalue la situation et vous conseille sur le bon moment d\'intervenir.</p>
        ',
    ),
    array(
        'titre' => 'Élagage et taille : quelle différence ?',
        'contenu' => '
            <p>Ces deux termes sont souvent confondus, mais ils désignent des interventions bien distinctes :</p>
            <ul>
                <li><strong>La taille</strong> est une opération courante d\'entretien : on retire des rameaux, des branches secondaires ou on réduit la couronne pour maintenir une forme, favoriser la fructification ou contrôler la croissance.</li>
                <li><strong>L\'élagage</strong> est une intervention plus lourde sur des branches charpentières (grosses branches de structure). Il vise à alléger la couronne, corriger l\'architecture de l\'arbre, supprimer les branches mortes ou dangereuses.</li>
            </ul>
            <p>L\'élagage nécessite des compétences techniques spécifiques : mauvais coupes ou coupes excessives peuvent affaiblir durablement un arbre, voire provoquer sa mort. Faire appel à un arboriste grimpeur certifié garantit un travail respectueux de la physiologie de l\'arbre.</p>
        ',
    ),
    array(
        'titre' => 'Comment reconnaître un arbre dangereux ?',
        'contenu' => '
            <p>Un arbre peut présenter des risques sans paraître malade à première vue. Voici les signaux d\'alerte à surveiller :</p>
            <ul>
                <li><strong>Branches mortes ou dépérissantes</strong> : bois sec, absence de feuilles en saison, écorce qui se détache.</li>
                <li><strong>Champignons ou polypores</strong> au pied du tronc ou sur les grosses branches : signe d\'une pourriture interne souvent invisible de l\'extérieur.</li>
                <li><strong>Fissures ou crevasses profondes</strong> dans le tronc ou à la fourche principale.</li>
                <li><strong>Penchement progressif</strong> du tronc, accompagné ou non de soulèvement des racines.</li>
                <li><strong>Blessures profondes</strong> non cicatrisées, trous de pics, zone creuse sonnant creux au martelage.</li>
            </ul>
            <p>Si vous observez l\'un de ces signes sur un arbre proche d\'une maison, d\'une voirie ou d\'une zone fréquentée, contactez rapidement un professionnel. En cas de chute, la responsabilité du propriétaire peut être engagée.</p>
        ',
    ),
    array(
        'titre' => 'Abattage d\'arbre : quand et comment procéder ?',
        'contenu' => '
            <p>L\'abattage est la solution de dernier recours, envisagée lorsque l\'arbre ne peut plus être sauvé ou représente un danger avéré. Les principales raisons :</p>
            <ul>
                <li>Arbre mort ou dépérissant sans possibilité de traitement.</li>
                <li>Maladie grave (chancre, pourriture centrale avancée).</li>
                <li>Arbre instable ou fortement incliné menaçant une construction.</li>
                <li>Projet de construction ou d\'aménagement nécessitant la libération d\'espace.</li>
            </ul>
            <p><strong>Réglementation</strong> : avant tout abattage, vérifiez auprès de votre mairie si l\'arbre est soumis à un Plan Local d\'Urbanisme (PLU) ou s\'il figure sur une liste d\'arbres protégés. Une autorisation peut être nécessaire.</p>
            <p><strong>Technique</strong> : en zone contrainte (proximité de bâtiments, lignes électriques, clôtures), l\'abattage directionnel ou le démontage par tronçonnage séquentiel avec rétention s\'impose. Ces techniques nécessitent un équipement professionnel et une expérience confirmée.</p>
        ',
    ),
    array(
        'titre' => 'Le débroussaillage : obligation légale et bonnes pratiques',
        'contenu' => '
            <p>En zone rurale ou périurbaine, le débroussaillage n\'est pas qu\'une question d\'esthétique : c\'est souvent une <strong>obligation légale</strong> liée à la prévention des incendies.</p>
            <p><strong>Qui est concerné ?</strong> Tout propriétaire d\'un terrain situé à moins de 200 mètres de forêts, landes, maquis ou garrigues est tenu de débroussailler selon l\'article L131-10 du Code forestier. Les obligations varient selon les communes.</p>
            <p><strong>Bonnes pratiques :</strong></p>
            <ul>
                <li>Intervenir de préférence en automne ou au début du printemps, hors période de nidification des oiseaux.</li>
                <li>Maintenir une hauteur de végétation raisonnable plutôt qu\'un sol nu, pour limiter l\'érosion.</li>
                <li>Évacuer ou broyer les rémanents pour ne pas créer de tas inflammables.</li>
                <li>Conserver les arbres de valeur et les haies bocagères — le débroussaillage n\'implique pas tout raser.</li>
            </ul>
            <p>En cas de non-respect, la commune peut faire réaliser les travaux d\'office aux frais du propriétaire.</p>
        ',
    ),
    array(
        'titre' => 'Entretien des haies : conseils et réglementation',
        'contenu' => '
            <p>Une haie bien entretenue structure le paysage, protège du vent et favorise la biodiversité. Quelques règles essentielles :</p>
            <p><strong>Réglementation :</strong></p>
            <ul>
                <li>Une haie mitoyenne ne peut être arrachée ou déplacée qu\'avec l\'accord du voisin.</li>
                <li>La distance minimale à respecter par rapport à la propriété voisine est de <strong>0,50 m</strong> pour une haie de moins de 2 m, et de <strong>2 m</strong> au-delà (Code civil, article 671).</li>
                <li>La taille des haies est interdite entre le 15 avril et le 15 août en France, pour protéger la nidification des oiseaux.</li>
            </ul>
            <p><strong>Conseils pratiques :</strong></p>
            <ul>
                <li>Taillez en biseau, plus étroit en haut, pour que la base reçoive de la lumière et reste dense.</li>
                <li>N\'enlevez jamais plus d\'un tiers de la végétation en une seule intervention.</li>
                <li>Pour les haies très denses ou hautes, l\'intervention d\'un professionnel avec outillage adapté (cisaille sur perche, nacelle) garantit un résultat homogène.</li>
            </ul>
        ',
    ),
    array(
        'titre' => 'Comment choisir un élagueur professionnel ?',
        'contenu' => '
            <p>Confier l\'entretien de vos arbres à un professionnel qualifié est essentiel pour la sécurité et la santé de votre patrimoine arboré. Voici les critères à vérifier :</p>
            <ul>
                <li><strong>Diplôme ou certification</strong> : le CS Taille et Soins des Arbres (anciennement CS Arboriste-Grimpeur) ou un Bac Pro Aménagements Paysagers avec spécialité arbres sont des références sérieuses.</li>
                <li><strong>Assurance RC Professionnelle</strong> : indispensable. En cas de dommages causés lors des travaux (chute d\'arbre sur clôture, blessure d\'un tiers), l\'assurance couvre les sinistres. Demandez toujours une attestation.</li>
                <li><strong>Devis détaillé</strong> : un professionnel sérieux se déplace pour évaluer le chantier avant de chiffrer. Méfiez-vous des devis par téléphone sans visite.</li>
                <li><strong>Références et photos de réalisations</strong> : un carnet de références, des avis clients vérifiés et des photos de chantiers similaires témoignent du sérieux de l\'entreprise.</li>
                <li><strong>Matériel adapté</strong> : grimpe sur corde, nacelle, broyeur de branches, protection des espaces. L\'outillage professionnel garantit sécurité et qualité.</li>
            </ul>
            <p>N\'hésitez pas à demander plusieurs devis et à comparer non seulement les prix, mais aussi la méthode de travail proposée et les garanties offertes.</p>
        ',
    ),
);
?>

<!-- Hero (identique Contact / Avis / Réalisations) -->
<section class="hero hero--small hero--conseils">
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title">Conseils arboriculture</h1>
        <p class="hero__subtitle">Tout ce que vous devez savoir sur l'entretien, la taille et la sécurité de vos arbres</p>
    </div>
</section>

<!-- Articles accordions -->
<section class="conseils-section section">
    <div class="container conseils-container">

        <div class="conseils-intro">
            <p>7 articles rédigés par notre équipe pour vous aider à mieux comprendre le soin et l'entretien des arbres dans le Puy-de-Dôme.</p>
        </div>

        <div class="conseils-accordion" id="conseils-accordion">
            <?php foreach ($articles as $i => $article) : ?>
                <div class="accordion-item <?php echo $i === 0 ? 'accordion-item--open' : ''; ?>" id="accordion-<?php echo $i; ?>">
                    <button
                        class="accordion-trigger"
                        type="button"
                        aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                        aria-controls="accordion-panel-<?php echo $i; ?>"
                    >
                        <span class="accordion-trigger__num"><?php printf('%02d', $i + 1); ?></span>
                        <span class="accordion-trigger__title"><?php echo esc_html($article['titre']); ?></span>
                        <svg class="accordion-trigger__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div
                        class="accordion-panel"
                        id="accordion-panel-<?php echo $i; ?>"
                        role="region"
                        aria-labelledby="accordion-<?php echo $i; ?>"
                        <?php echo $i === 0 ? '' : 'hidden'; ?>
                    >
                        <div class="accordion-panel__inner">
                            <?php echo $article['contenu']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- CTA devis -->
<section class="cta-section">
    <div class="cta-section__inner container">
        <h2 class="cta-section__title">Un projet d'élagage ou d'abattage ?</h2>
        <p class="cta-section__text">Contactez-nous pour un devis gratuit et sans engagement sous 48h.</p>
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

<script>
(function () {
    var items = document.querySelectorAll('.accordion-item');

    items.forEach(function (item) {
        var trigger = item.querySelector('.accordion-trigger');
        var panel   = item.querySelector('.accordion-panel');

        trigger.addEventListener('click', function () {
            var isOpen = item.classList.contains('accordion-item--open');

            // Fermer tous
            items.forEach(function (other) {
                other.classList.remove('accordion-item--open');
                other.querySelector('.accordion-trigger').setAttribute('aria-expanded', 'false');
                other.querySelector('.accordion-panel').setAttribute('hidden', '');
            });

            // Ouvrir celui cliqué si il était fermé
            if (!isOpen) {
                item.classList.add('accordion-item--open');
                trigger.setAttribute('aria-expanded', 'true');
                panel.removeAttribute('hidden');
            }
        });
    });
})();
</script>

<?php get_footer(); ?>
