<?php
// Déclarations constantes tableaux
$countriesArray = [
    'Albanie', 'Allemagne', 'Arménie', 'Autriche', 'Azerbaïdjan', 'Belgique', 'Bosnie-Herzégovine', 'Bulgarie', 'Canada', 'Chypre', 'Croatie', 'Danemark',
    'Espagne', 'Estonie', 'Etats-Unis', 'Finlande', 'France', 'Géorgie', 'Grèce', 'Hongrie', 'Irlande', 'Islande', 'Ukraine', 'Algérie', 'Israël', 'Egypte',
    'Italie', 'Lettonie', 'Lituanie', 'Luxembourg', 'Malte' , 'Macédoine du Nord', 'Monténégro', 'Pays-Bas', 'Pologne', 'Jordanie', 'Maroc', 'Australie',
    'Tchéquie', 'Turquie', 'République de Moldova', 'République Tchèque', 'Roumanie', 'Royaume-Uni', 'Serbie', 'Slovaquie', 'Slovénie', 'Suède', 'Suisse',
    'Japon', 'Kazakhstan', 'Corée du Sud', 'Tunisie', 'Kosovo'
];
sort($countriesArray);
define('CONSTANT_ARRAY_COUNTRIES', $countriesArray);

$levelStudyArray = ['without' => 'sans','bac' => 'Bac', 'twoBac' => 'Bac+2', 'threeBac' => 'Bac+3', 'sup' => 'supérieur'];
define('CONSTANT_ARRAY_LEVEL_STUDY', $levelStudyArray);

$webLanguagesArray = ['htmlCss' => 'Html/Css', 'php' => 'PHP', 'javascript' => 'Javascript', 'python' => 'Python', 'autres' => 'Autres'];
define('CONSTANT_ARRAY_WEB_LANGUAGES', $webLanguagesArray);

$extensionArray = ['jpeg', 'jpg', 'png', 'avif', 'gif'];
define('CONSTANT_ARRAY_EXTENSION', $extensionArray);