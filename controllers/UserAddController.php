<?php
require_once(dirname(__FILE__).'/../config/regex.php');
// Déclaration Variables
    $dateToday = new DateTime();
    $todayDay = $dateToday -> format('Y-m-d');
    $actualYear = $dateToday -> format('Y');
    $startYear = $actualYear - 120;
    $actualMonth = $dateToday -> format('m');
    $actualday = $dateToday -> format('d');
    
    $dateStart = new DateTime("$startYear-$actualMonth-$actualday");
    $startDay = $dateStart -> format('Y-m-d');

    $urlCompare1 = parse_url('https://www.linkedin.com/in/');

// Déclarations Variables Tableaux
    $countriesArray = [
        'Albanie', 'Allemagne', 'Arménie', 'Autriche', 'Azerbaïdjan', 'Belgique', 'Bosnie-Herzégovine', 'Bulgarie', 'Canada', 'Chypre', 'Croatie', 'Danemark',
        'Espagne', 'Estonie', 'Etats-Unis', 'Finlande', 'France', 'Géorgie', 'Grèce', 'Hongrie', 'Irlande', 'Islande', 'Ukraine', 'Algérie', 'Israël', 'Egypte',
        'Italie', 'Lettonie', 'Lituanie', 'Luxembourg', 'Malte' , 'Macédoine du Nord', 'Monténégro', 'Pays-Bas', 'Pologne', 'Jordanie', 'Maroc', 'Australie',
        'Tchéquie', 'Turquie', 'République de Moldova', 'République Tchèque', 'Roumanie', 'Royaume-Uni', 'Serbie', 'Slovaquie', 'Slovénie', 'Suède', 'Suisse',
        'Japon', 'Kazakhstan', 'Corée du Sud', 'Tunisie', 'Kosovo'
    ];
    sort($countriesArray);

    $levelStudyArray = ['without' => 'sans','bac' => 'Bac', 'twoBac' => 'Bac+2', 'threeBac' => 'Bac+3', 'sup' => 'supérieur'];

    $webLanguagesArray = ['htmlCss' => 'Html/Css', 'php' => 'PHP', 'javascript' => 'Javascript', 'python' => 'Python', 'autres' => 'Autres'];
    
    $extensionArray = ['jpeg', 'jpg', 'png', 'avif', 'gif'];

    $error = [];

// Condition si le formulaire a été envoyé
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
// Vérification mail
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
        if (empty($mail)) {
            $error['mail'] = 'Veuillez entrer votre e-mail';
        } else {
            $mailChecked = filter_var($mail, FILTER_VALIDATE_EMAIL);
            if ($mailChecked === false) {
                $error['mail'] = 'Votre e-mail comporte des erreurs';
            };
        };

// Vérification nom
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        if (empty($lastname)) {
            $error['lastname'] = 'Veuillez entrer votre nom';
        } else {
            $lastnameChecked = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>'/'.CONSTANT_REGEX_FULL_CHARS.'/')));
            if ($lastnameChecked === false) {
                $error['lastname'] = 'Votre nom comporte des erreurs';
            };
        };

// Vérification date de naissance
        $birthDate = trim(filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_NUMBER_INT));
        if (empty($birthDate)) {
            $error['birthDate'] = 'Veuillez choisir une date';
        } else {
            $birthDateChecked = filter_var($birthDate, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>'/'.CONSTANT_REGEX_DATE.'/')));
            if ($birthDateChecked === false || $birthDate < $startDay || $birthDate > $todayDay) {
                $error['birthDate'] = 'Votre date d\'anniversaire comporte des erreurs';
            };
        };

// Vérification pays de naissance
        $nativeCountry = trim(filter_input(INPUT_POST, 'nativeCountry', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        if (empty($nativeCountry)) {
            $error['nativeCountry'] = 'Veuillez choisir un pays';
        } else {
            $nativeCountryChecked = in_array($nativeCountry, $countriesArray);
            if ($nativeCountryChecked === false) {
                $error['nativeCountry'] = 'Votre pays de naissance comporte des erreurs';
            };
        };

// Vérification code postal
        $postalCode = intval(filter_input(INPUT_POST, 'postalCode', FILTER_SANITIZE_NUMBER_INT));
        if (empty($postalCode)) {
            $error['postalCode'] = 'Veuillez entrer votre code postal';
        } else {
            $postalCodeChecked = filter_var($postalCode, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>'/'.CONSTANT_REGEX_POSTAL_CODE.'/')));
            if ($postalCodeChecked === false) {
                $error['postalCode'] = 'Votre code postal comporte des erreurs';
            };
        };

// Vérification photo profil
        if(!empty($_FILES['profilePicture']['name'])){
            $profilePictureName = $_FILES['profilePicture']['name'];
            $fileInfo = pathinfo($_FILES['profilePicture']['name']);
            $extension = strtolower($fileInfo['extension']);
            $extensionChecked = in_array($extension, $extensionArray);
            if($extensionChecked === false){
                $error['profilePicture'] = 'Le fichier transféré n\'est pas un fichier de type image';
            } else {
                move_uploaded_file($_FILES['profilePicture']['tmp_name'], 'uploads/' . $lastname.'_'.$birthDate.'.'.$extension);
                $profilePicture = 'Le fichier a été transféré avec succès';
            };
        };

// Vérificafion niveau études
        $levelStudy = trim(filter_input(INPUT_POST, 'levelStudy', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        if (empty($levelStudy)) {
            $error['levelStudy'] = 'Veuillez choisir un niveau';
        } else {
            $levelStudyChecked = in_array($levelStudy, $levelStudyArray);
            if ($levelStudyChecked === false) {
                $error['levelStudy'] = 'Le niveau choisi comporte des erreurs';
            };
        };

// Vérification url
        $linkedinUrl = trim(filter_input(INPUT_POST, 'linkedinUrl', FILTER_SANITIZE_URL));
        if (!empty($linkedinUrl)) {
            $linkedinUrlChecked = filter_var($linkedinUrl, FILTER_VALIDATE_URL);
            $urlCompare2 = parse_url("$linkedinUrlChecked");
            if ($linkedinUrlChecked === false || $urlCompare1['host'] != $urlCompare2['host']) {
                $error['linkedinUrl'] = 'Votre URL comporte des erreurs';
            };
        };

// Vérification langage web
        $webLanguages = filter_input(INPUT_POST, 'webLanguages', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        if (!empty($webLanguages)) {
            $webLanguagesChecked = array_diff($webLanguages, $webLanguagesArray);
            if ($webLanguagesChecked != NULL) {
                $error['webLanguages'] = 'Le langage choisi comporte des erreurs';
            };
        };

// Vérification commentaire
        $commentsExperience = filter_input(INPUT_POST, 'commentsExperience', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($commentsExperience)) {
            $error['commentsExperience'] = 'Veuillez saisir un commentaire';
        };
    };

    include(dirname(__FILE__).'/../views/templates/header.php');

    if ($_SERVER['REQUEST_METHOD'] != 'POST' || !empty($error) ) {
        include(dirname(__FILE__).'/../views/userAdd.php');
    } else {
        include(dirname(__FILE__).'/../views/userResult.php');
    };

    include(dirname(__FILE__).'/../views/templates/footer.php');