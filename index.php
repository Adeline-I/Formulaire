<?php
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

// Déclaration des constantes
    define('CONSTANT_REGEX_FULL_CHARS', "^[A-Za-àáâãäçèéêëìíîïñòóôõöùûúüýÿ'\-]+$");
    define('CONSTANT_REGEX_POSTAL_CODE', "^\d{5}$");
    define('CONSTANT_REGEX_DATE', "^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$");

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
                $error['profilePicture'] = 'Le fichier transféré n\'est pas un jpeg';
            } else {
                move_uploaded_file($_FILES['profilePicture']['tmp_name'], 'uploads/' . $lastname.'-'.$birthDate.'.'.$extension);
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
        $commentsExpérience = filter_input(INPUT_POST, 'commentsExpérience', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($commentsExpérience)) {
            $error['commentsExpérience'] = 'Veuillez saisir un commentaire';
        };
    };
?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Formulaire d'inscription</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8 my-5 py-5">
                <h1>Partie 10 - Les Formulaires</h1>
            </div>
            <div class="col-8 mb-5 py-5">
                <h3>Formulaire d'inscription</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-8 mb-5">
            <?php if ($_SERVER['REQUEST_METHOD'] != 'POST' || !empty($error) ) { ?>
                <!---------- Formulaire ---------->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype='multipart/form-data' novalidate>
                    <div class="row py-3">
                        <div class="col-12 col-lg-6 pt-3 px-lg-5 colLeft">
                            <!-- Formulaire : E-mail -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="mail" name="mail" placeholder="E-mail" value="<?= $mail ?? ''; ?>" autocomplete="email" required>
                                <label for="mail">E-mail *</label>
                            </div>
                            <p class="error">
                                <?=  $error['mail'] ?? '' ?>
                            </p>
                            <!-- Formulaire : Nom -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom" required pattern="<?= CONSTANT_REGEX_FULL_CHARS; ?>" value="<?= $lastname ?? ''; ?>" autocomplete="name">
                                <label for="lastname">Nom *</label>
                            </div>
                            <p class="error">
                                <?=  $error['lastname'] ?? '' ?>
                            </p>
                            <!-- Formulaire : Date de naissance -->
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="birthDate" name="birthDate" placeholder="Date de naissance" min="<?=$startDay?>" max="<?= $todayDay; ?>" value="<?= $birthDate ?? ''; ?>" required>
                                <label for="birthDate">Date de naissance *</label>
                            </div>
                            <p class="error">
                                <?=  $error['birthDate'] ?? '' ?>
                            </p>
                            <!-- Formulaire : Pays de naissance -->
                            <div class="form-floating mb-3">
                                <select class="form-select" name="nativeCountry" id="nativeCountry" aria-label="nativeCountryLabel" value="<?= $nativeCountry ?? ''; ?>" required>
                                    <option>Choisissez un pays</option>
                                <?php
                                    foreach ($countriesArray as $countrieKey => $countrieValue) { 
                                ?>
                                    <option
                                    <?php
                                        if(!empty($nativeCountry) && ($countrieValue == $nativeCountry)) {
                                            echo 'selected="selected"';
                                        };
                                    ?>
                                    value= <?= $countrieValue; ?>><?= $countrieValue; ?></option>
                                <?php
                                    };
                                ?>
                                </select>
                                <label for="nativeCountry">Pays de naissance *</label>
                            </div>
                            <p class="error">
                                <?=  $error['nativeCountry'] ?? '' ?>
                            </p>
                            <!-- Formulaire : Code postal -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Code Postal" required size="5" pattern="<?= CONSTANT_REGEX_POSTAL_CODE; ?> value="<?= $postalCode ?? ''; ?>" autocomplete="postal-code">
                                <label for="postalCode">Code Postal *</label>
                            </div>
                            <div class="error">
                                <?=  $error['postalCode'] ?? '' ?>
                            </div>
                            <!-- Formulaire : Photo de profil -->
                            <div class="mb-3">
                                <label class="form-label profilePicture" for="profilePicture">Photo de profil :</label>
                                <input type="file" name="profilePicture" class="form-control" id="profilePicture">
                            </div>
                            <p class="error">
                            <?= $error['profilePicture'] ?? '' ?>
                            </p>
                        </div>
                        <div class="col-12 col-lg-6 pt-3 px-lg-5 colRight">
                            <!-- Formulaire : Niveau d'études -->
                            <p class="levelStudy">Niveau d'études *</p>
                            <?php
                                foreach ($levelStudyArray as $levelStudyKey => $levelStudyValue) {
                            ?>
                            <div class="form-check form-check-inline mb-3">
                                <input class="form-check-input" type="radio" name="levelStudy" id="<?= $levelStudyKey; ?>LevelStudy"  value="<?= $levelStudy ?? $levelStudyValue; ?>"
                                <?php
                                    if(!empty($levelStudy) && ($levelStudyValue == $levelStudy)) {
                                        echo 'checked="checked"';
                                    };
                                ?>
                                >
                                <label class="form-check-label" for="<?= $levelStudyKey; ?>LevelStudy"><?= $levelStudyValue; ?></label>
                            </div>
                            <?php
                                };
                            ?>
                            <p class="error">
                                <?=  $error['levelStudy'] ?? '' ?>
                            </p>
                            <!-- Formulaire : Compte LinkedIn -->
                            <div class="form-floating mb-3">
                                <input type="url" class="form-control" id="linkedinUrl" name="linkedinUrl" placeholder="URL du compte LinkedIn" value="<?= $linkedinUrl ?? ''; ?>">
                                <label for="linkedinUrl">URL du compte LinkedIn</label>
                            </div>
                            <p class="error">
                                <?=  $error['linkedinUrl'] ?? '' ?>
                            </p>
                            <!-- Formulaire : Langage(s) web connu(s) -->
                            <p class="webLanguages">Quel langage Web connaissez-vous ?</p>
                            <?php
                                foreach ($webLanguagesArray as $webLanguageKey => $webLanguageValue) {
                            ?>
                            <div class="form-check form-check-inline mb-3">
                                <input class="form-check-input" type="checkbox" name="webLanguages[]" id="<?= $webLanguageKey; ?>WebLanguages"  value="<?= $webLanguage ?? $webLanguageValue; ?>"
                                <?php
                                    if(!empty($webLanguages) && (in_array($webLanguageValue, $webLanguages))) {
                                        echo 'checked="checked"';
                                    };
                                ?>
                                >
                                <label class="form-check-label" for="<?= $webLanguageKey; ?>WebLanguages"><?= $webLanguageValue; ?></label>
                            </div>
                            <?php
                                };
                            ?>
                            <p class="error">
                                <?=  $error['webLanguages'] ?? '' ?>
                            </p>
                            <!-- Formulaire : Expérience -->
                            <div class="mb-3">
                                <label for="commentsExpérience" class="commentsExpérience">Avez vous déjà eu une expérience dans la programmation et/ou l'informatique avant de remplir ce formulaire ? *</label>
                                <textarea class="form-control" placeholder="Précisez" name="commentsExpérience" id="commentsExpérience" required><?= $commentsExpérience ?? ''; ?></textarea>
                            </div>
                            <p class="error">
                            <?=  $error['commentsExpérience'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" id="submit" class="btn my-3">Soumettre</button>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <p>* Champs obligatoires</p>
                        </div>
                    </div>
                </form>
                <?php } else { ?>
                <!-- Retour si Formulaire correctement rempli -->
                <p>Adresse E-mail : <?= $mail; ?></p>
                <p>Nom : <?= $lastname; ?></p>
                <p>Date de naissance : <?= $birthDate; ?></p>
                <p>Pays de naissance : <?= $nativeCountry; ?></p>
                <p>Code postal : <?= $postalCode; ?></p>
                <p>Photo de profil : <?= $profilePicture ?? 'Non indiqué'; ?></p>
                <p>Niveau d'études : <?= $levelStudy; ?></p>
                <p>Compte LinkedIn : <?= $linkedinUrl ?? 'Non indiqué'; ?></p>
                <p>Langage(s) web connu(s) : <?php
                    foreach ($webLanguages as $webLanguagesKey => $webLanguagesValue) { 
                        echo $webLanguagesValue.', ' ?? 'Non indiqué';
                    };
                ?></p>
                <p>Expérience : <?= $commentsExpérience; ?></p>
                <?php }; ?>
            </div>
        </div>
    </div>
</html>