<?php
    $countriesArray = [
        'Albanie', 'Allemagne', 'Arménie', 'Autriche', 'Azerbaïdjan', 'Belgique', 'Bosnie-Herzégovine', 'Bulgarie', 'Canada', 'Chypre', 'Croatie', 'Danemark',
        'Espagne', 'Estonie', 'Etats-Unis', 'Finlande', 'France', 'Géorgie', 'Grèce', 'Hongrie', 'Irlande', 'Islande', 'Ukraine', 'Algérie', 'Israël', 'Egypte',
        'Italie', 'Lettonie', 'Lituanie', 'Luxembourg', 'Malte' , 'Macédoine du Nord', 'Monténégro', 'Pays-Bas', 'Pologne', 'Jordanie', 'Maroc', 'Australie',
        'Tchéquie', 'Turquie', 'République de Moldova', 'République Tchèque', 'Roumanie', 'Royaume-Uni', 'Serbie', 'Slovaquie', 'Slovénie', 'Suède', 'Suisse',
        'Japon', 'Kazakhstan', 'Corée du Sud', 'Tunisie', 'Kosovo'
    ];
    sort($countriesArray);

    $levelStudyArray = ['sans', 'Bac', 'Bac+2', 'Bac+3', 'supérieur'];

    $webLanguages = ['Html/Css', 'PHP', 'Javascript', 'Python', 'Autres'];

    $dateToday = new DateTime();
    $todayDay = $dateToday -> format('Y-m-d');
    $actualYear = $dateToday -> format('Y');
    $startYear = $actualYear - 150;
    $actualMonth = $dateToday -> format('m');
    $actualday = $dateToday -> format('d');
    $dateStart = new DateTime("$startYear-$actualMonth-$actualday");
    $startDay = $dateStart -> format('Y-m-d');

    $error = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
        if (empty($mail)) {
            $error['mail'] = 'Veuillez entrer votre e-mail';
        } else {
            $mailChecked = filter_var($mail, FILTER_VALIDATE_EMAIL);
            if ($mailChecked == false) {
                $error['mail'] = 'Votre e-mail comporte des erreurs';
            };
        };

        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($lastname)) {
            $error['lastname'] = 'Veuillez entrer votre nom';
        } else {
            $lastnameChecked = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[A-Za-àáâãäçèéêëìíîïñòóôõöùûúüýÿ'\-]+$/")));
            if ($lastnameChecked == false) {
                $error['lastname'] = 'Votre nom comporte des erreurs';
            };
        };

        $birthDate = filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_NUMBER_INT);
        if (empty($birthDate)) {
            $error['birthDate'] = 'Veuillez choisir une date';
        } else {
            $birthDateChecked = filter_var($birthDate, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/")));
            if ($birthDateChecked == false) {
                $error['birthDate'] = 'Votre date d\'anniversaire comporte des erreurs';
            };
        };

        $nativeCountry = filter_input(INPUT_POST, 'nativeCountry', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($nativeCountry)) {
            $error['nativeCountry'] = 'Veuillez choisir un pays';
        } else {
            $nativeCountryChecked = filter_var($nativeCountry, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[A-Za-àáâãäçèéêëìíîïñòóôõöùûúüýÿ'\-]+$/")));
            if ($nativeCountryChecked == false) {
                $error['nativeCountry'] = 'Votre pays de naissance comporte des erreurs';
            };
        };

        $postalCode = filter_input(INPUT_POST, 'postalCode', FILTER_SANITIZE_NUMBER_INT);
        if (empty($postalCode)) {
            $error['postalCode'] = 'Veuillez entrer votre code postal';
        } else {
            $postalCodeChecked = filter_var($postalCode, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{5}$/")));
            if ($postalCodeChecked == false) {
                $error['postalCode'] = 'Votre code postal comporte des erreurs';
            };
        };

        if(!empty($_FILES['profilePicture']['name'])){
            $profilePictureName = $_FILES['profilePicture']['name'];
            $fileInfo = pathinfo($_FILES['profilePicture']['name']);
            $extension = strtolower($fileInfo['extension']);
            if($extension != 'pdf'){
                $error['profilePictureName'] = 'Le fichier transféré n\'est pas un pdf';
            }
        } else {
            $error['profilePictureName'] = 'Vous n\'avez pas transféré de fichier';
        };

        $levelStudy = filter_input(INPUT_POST, 'levelStudy', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($levelStudy)) {
            $error['levelStudy'] = 'Veuillez choisir un niveau';
        } else {
            $levelStudyChecked = filter_var($levelStudy, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[A-Za-àáâãäçèéêëìíîïñòóôõöùûúüýÿ'\-]+$/")));
            if ($levelStudyChecked == false) {
                $error['levelStudy'] = 'Le niveau choisi comporte des erreurs';
            };
        };

        $linkedinUrl = filter_input(INPUT_POST, 'linkedinUrl', FILTER_SANITIZE_URL);
        if (empty($linkedinUrl)) {
            $error['linkedinUrl'] = 'Veuillez saisir un URL';
        } else {
            $linkedinUrlChecked = filter_var($linkedinUrl, FILTER_VALIDATE_URL);
            if ($linkedinUrlChecked == false) {
                $error['linkedinUrl'] = 'Votre URL comporte des erreurs';
            };
        };

        $webLanguages[] = filter_input(INPUT_POST, 'webLanguages[]', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($webLanguages)) {
            $error['webLanguages'] = 'Veuillez choisir un langage';
        } else {
            $webLanguagesChecked = filter_var($webLanguages[], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[A-Za-àáâãäçèéêëìíîïñòóôõöùûúüýÿ'\-]+$/")));
            if ($webLanguagesChecked == false) {
                $error['webLanguages'] = 'Le langage choisi comporte des erreurs';
            };
        };

        $commentsExpérience = filter_input(INPUT_POST, 'commentsExpérience', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($commentsExpérience)) {
            $error['commentsExpérience'] = 'Veuillez saisir un commentaire';
        } else {
            $commentsExpérienceChecked = filter_var($commentsExpérience, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[A-Za-àáâãäçèéêëìíîïñòóôõöùûúüýÿ'\-]+$/")));
            if ($commentsExpérienceChecked == false) {
                $error['commentsExpérience'] = 'Le commentaire saisi comporte des erreurs';
            };
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
                <form action="index.php" method="post" enctype='multipart/form-data' novalidate>
                    <div class="row">
                        <div class="col-12 col-lg-6 pt-3 px-lg-5">
                        <?php if ($_SERVER['REQUEST_METHOD'] != 'POST' || !empty($error) ) { ?>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="mail" name="mail" placeholder="E-mail" value="<?= $mailChecked ?? ''; ?>" required>
                                <label for="mail">E-mail *</label>
                            </div>
                            <div class="error">
                                <?=  $error['mail']; ?>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom" required pattern="^[A-Za-àáâãäçèéêëìíîïñòóôõöùûúüýÿ'\-]+$" value="<?= $lastnameChecked ?? ''; ?>">
                                <label for="lastname">Nom *</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="birthDate" name="birthDate" placeholder="Date de naissance" min="<?=$startDay?>" max="<?= $todayDay; ?>" value="<?= $birthDateChecked ?? ''; ?>" required>
                                <label for="birthDate">Date de naissance *</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" name="nativeCountry" id="nativeCountry" aria-label="nativeCountryLabel" value="<?= $nativeCountryChecked ?? ''; ?>" required>
                                    <option>Choisissez un pays</option>
                                <?php
                                    foreach ($countriesArray as $countrieKey => $countrieValue) {
                                    echo '<option value='.($countrieKey + 1).'>'.$countrieValue.'</option>';
                                    };
                                ?>
                                </select>
                                <label for="nativeCountry">Pays de naissance *</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Code Postal" required size="5" pattern="[0-9]+" value="<?= $postalCodeChecked ?? ''; ?>">
                                <label for="postalCode">Code Postal *</label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label profilePicture" for="profilePicture">Photo de profil :</label>
                                <input type="file" name="profilePicture" class="form-control" id="profilePicture">
                            </div>

                        </div>
                        <div class="col-12 col-lg-6 pt-3 px-lg-5">
                            <p class="levelStudy">Niveau d'études *</p>
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="radio" name="levelStudy" id="withoutLevelStudy"  value="<?= $levelStudyChecked ?? 'sans'; ?>" checked>
                                        <label class="form-check-label" for="withoutLevelStudy">sans</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="radio" name="levelStudy" id="bacLevelStudy" value="<?= $levelStudyChecked ?? 'Bac'; ?>">
                                        <label class="form-check-label" for="yeslevelStudy">Bac</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="radio" name="levelStudy" id="twoBacLevelStudy" value="<?= $levelStudyChecked ?? 'Bac+2'; ?>">
                                        <label class="form-check-label" for="yeslevelStudy">Bac+2</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="radio" name="levelStudy" id="threeBacLevelStudy" value="<?= $levelStudyChecked ?? 'Bac+3'; ?>">
                                        <label class="form-check-label" for="threeBacLevelStudy">Bac+3</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="radio" name="levelStudy" id="supLevelStudy" value="<?= $levelStudyChecked ?? 'supérieur'; ?>">
                                        <label class="form-check-label" for="supLevelStudy">supérieur</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="url" class="form-control" id="linkedinUrl" name="linkedinUrl" placeholder="URL du compte LinkedIn" value="<?= $linkedinUrlChecked ?? 'sans'; ?>">
                                <label for="linkedinUrl">URL du compte LinkedIn</label>
                            </div>

                            <p class="webLanguages">Quel langage Web connaissez-vous ?</p>
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="checkbox" name="webLanguages[]" id="htmlCssWebLanguages" value="<?= $webLanguagesChecked ?? 'Html/Css'; ?>">
                                        <label class="form-check-label" for="htmlCssWebLanguages">Html/Css</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="checkbox" name="webLanguages[]" id="phpWebLanguages" value="<?= $webLanguagesChecked ?? 'PHP'; ?>">
                                        <label class="form-check-label" for="phpWebLanguages">PHP</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="checkbox" name="webLanguages[]" id="javascriptWebLanguages" value="<?= $webLanguagesChecked ?? 'Javascript'; ?>">
                                        <label class="form-check-label" for="javascriptWebLanguages">Javascript</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="checkbox" name="webLanguages[]" id="pythonWebLanguages" value="<?= $webLanguagesChecked ?? 'Python'; ?>">
                                        <label class="form-check-label" for="pythonWebLanguages">Python</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="checkbox" name="webLanguages[]" id="otherWebLanguages" value="<?= $webLanguagesChecked ?? 'Autres'; ?>">
                                        <label class="form-check-label" for="otherWebLanguages">Autres</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="commentsExpérience" class="commentsExpérience">Avez vous déjà eu une expérience dans la programmation et/ou l'informatique avant de remplir ce formulaire ? *</label>
                                <textarea class="form-control" placeholder="Précisez" name="commentsExpérience" id="commentsExpérience" value="<?= $commentsExpérienceChecked ?? ''; ?>" required></textarea>
                            </div>

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
                <p><?php $mail; ?></p>
                <p><?php $lastname; ?></p>
                <p><?php $birthDate; ?></p>
                <p><?php $nativeCountry; ?></p>
                <p><?php $postalCode; ?></p>
                <p><?php $profilePicture; ?></p>
                <p><?php $levelStudy; ?></p>
                <p><?php $linkedinUrl; ?></p>
                <p><?php $webLanguages; ?></p>
                <p><?php $CommentsExpérience; ?></p>
                <?php }; ?>
            </div>
        </div>
    </div>
</html>