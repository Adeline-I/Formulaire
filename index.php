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
                <form action="index.php" method="post">
                    <div class="row">
                        <div class="col-12 col-lg-6 pt-3 px-lg-5">
                            <div class="form-floating mb-3">
                                <input required type="mail" class="form-control" id="mail" name="mail" placeholder="E-mail">
                                <label for="mail">E-mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input required type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom">
                                <label for="lastname">Nom</label>
                            </div>
                            <div class="form-floating mb-3 input-group">
                                <input required type="date" class="form-control" id="birthDate" name="birthDate" placeholder="Date de naissance">
                                <label for="birthDate">Date de naissance</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="nativeCountry" id="nativeCountry" aria-label="nativeCountryLabel">
                                    <option selected>Sélectionnez un pays</option>
                                    <option value="1">France</option>
                                    <option value="2">Allemagne</option>
                                    <option value="3">Royaume-Uni</option>
                                </select>
                                <label for="nativeCountry">Pays de naissance</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input required type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Code Postal">
                                <label for="postalCode">Code Postal</label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label profilePicture" for="profilePicture">Photo de profil :</label>
                                <input required required type="file" name="profilePicture" class="form-control" id="profilePicture">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 pt-3 px-lg-5">
                            <p>Niveau d'études</p>
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="radio" name="levelStudy" id="withoutLevelStudy" value="sans">
                                        <label class="form-check-label" for="withoutLevelStudy">sans</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="radio" name="levelStudy" id="bacLevelStudy" value="Bac">
                                        <label class="form-check-label" for="yeslevelStudy">Bac</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="radio" name="levelStudy" id="twoBacLevelStudy" value="Bac+2">
                                        <label class="form-check-label" for="yeslevelStudy">Bac+2</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="radio" name="levelStudy" id="threeBacLevelStudy" value="Bac+3">
                                        <label class="form-check-label" for="threeBacLevelStudy">Bac+3</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="radio" name="levelStudy" id="supLevelStudy" value="supérieur" checked>
                                        <label class="form-check-label" for="supLevelStudy">supérieur</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input required type="url" class="form-control" id="linkedinUrl" name="linkedinUrl" placeholder="URL du compte LinkedIn">
                                <label for="linkedinUrl">URL du compte LinkedIn</label>
                            </div>
                            <p>Quel langage Web connaissez-vous ?</p>
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="checkbox" name="htmlCsswebLanguages" id="htmlCsswebLanguages">
                                        <label class="form-check-label" for="htmlCsswebLanguages">Html/Css</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="checkbox" name="phpwebLanguages" id="phpwebLanguages">
                                        <label class="form-check-label" for="phpwebLanguages">PHP</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="checkbox" name="javascriptwebLanguages" id="javascriptwebLanguages">
                                        <label class="form-check-label" for="javascriptwebLanguages">Javascript</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="checkbox" name="pythonwebLanguages" id="pythonwebLanguages">
                                        <label class="form-check-label" for="pythonwebLanguages">Python</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-check form-check-inline mb-3">
                                        <input class="form-check-input" type="checkbox" name="otherwebLanguages" id="otherwebLanguages">
                                        <label class="form-check-label" for="otherwebLanguages">Autres</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="commentsExpérience" class="commentsExpérience">Avez vous déjà eu une expérience dans la programmation et/ou l'informatique avant de remplir ce formulaire ?</label>
                                <textarea class="form-control" placeholder="Précisez" id="commentsExpérience"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex  justify-content-center">
                            <button type="submit" class="btn my-3">Soumettre</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>