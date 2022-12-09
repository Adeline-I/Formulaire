<!---------- Formulaire ---------->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype='multipart/form-data' novalidate>
    <div class="row py-2">
        <div class="col-12 col-lg-6 pt-3 px-lg-5 colLeft">
            <!-- Formulaire : E-mail -->
            <div class="form-floating mb-3">
                <input type="email" class="form-control
                <?php
                if (!empty($error['mail'])) {
                    echo 'invalidInput';
                };
                ?>" id="mail" name="mail" placeholder="E-mail" value="<?= $mail ?? ''; ?>" autocomplete="email" required>
                <label for="mail">E-mail *</label>
            </div>
            <p class="error">
                <?= $error['mail'] ?? '' ?>
            </p>
            <!-- Formulaire : Nom -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control
                <?php
                if (!empty($error['lastname'])) {
                    echo 'invalidInput';
                };
                ?>" id="lastname" name="lastname" placeholder="Nom" required pattern="<?= CONSTANT_REGEX_FULL_CHARS; ?>" value="<?= $lastname ?? ''; ?>" autocomplete="name">
                <label for="lastname">Nom *</label>
            </div>
            <p class="error">
                <?= $error['lastname'] ?? '' ?>
            </p>
            <!-- Formulaire : Date de naissance -->
            <div class="form-floating mb-3">
                <input type="date" class="form-control
                <?php
                if (!empty($error['birthDate'])) {
                    echo 'invalidInput';
                };
                ?>" id="birthDate" name="birthDate" placeholder="Date de naissance" min="<?= $startDay ?>" max="<?= $todayDay; ?>" value="<?= $birthDate ?? ''; ?>">
                <label for="birthDate">Date de naissance *</label>
            </div>
            <p class="error">
                <?= $error['birthDate'] ?? '' ?>
            </p>
            <!-- Formulaire : Pays de naissance -->
            <div class="form-floating mb-3">
                <select class="form-select
                <?php
                if (!empty($error['nativeCountry'])) {
                    echo 'invalidInput';
                };
                ?>" name="nativeCountry" id="nativeCountry" aria-label="nativeCountryLabel" value="<?= $nativeCountry ?? ''; ?>" required>
                    <option>Choisissez un pays</option>
                    <?php
                    foreach (CONSTANT_ARRAY_COUNTRIES as $countrieKey => $countrieValue) {
                    ?>
                        <option <?php
                                if (!empty($nativeCountry) && ($countrieValue == $nativeCountry)) {
                                    echo 'selected="selected"';
                                };
                                ?> value=<?= $countrieValue; ?>><?= $countrieValue; ?></option>
                    <?php
                    };
                    ?>
                </select>
                <label for="nativeCountry">Pays de naissance *</label>
            </div>
            <p class="error">
                <?= $error['nativeCountry'] ?? '' ?>
            </p>
            <!-- Formulaire : Code postal -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control
                <?php
                if (!empty($error['postalCode'])) {
                    echo 'invalidInput';
                };
                ?>" id="postalCode" name="postalCode" placeholder="Code Postal" required size="5" pattern="<?= CONSTANT_REGEX_POSTAL_CODE; ?>" value="<?= $postalCode ?? ''; ?>" autocomplete="postal-code">
                <label for="postalCode">Code Postal *</label>
            </div>
            <div class="error">
                <?= $error['postalCode'] ?? '' ?>
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
            foreach (CONSTANT_ARRAY_LEVEL_STUDY as $levelStudyKey => $levelStudyValue) {
            ?>
                <div class="form-check form-check-inline mb-3">
                    <input class="form-check-input" type="radio" name="levelStudy" id="<?= $levelStudyKey; ?>LevelStudy" value="<?= $levelStudy ?? $levelStudyValue; ?>" <?php
                                                                                                                                                                            if (!empty($levelStudy) && ($levelStudyValue == $levelStudy)) {
                                                                                                                                                                                echo 'checked="checked"';
                                                                                                                                                                            };
                                                                                                                                                                            ?>>
                    <label class="form-check-label" for="<?= $levelStudyKey; ?>LevelStudy"><?= $levelStudyValue; ?></label>
                </div>
            <?php
            };
            ?>
            <p class="error">
                <?= $error['levelStudy'] ?? '' ?>
            </p>
            <!-- Formulaire : Compte LinkedIn -->
            <div class="form-floating mb-3">
                <input type="url" class="form-control" id="linkedinUrl" name="linkedinUrl" placeholder="URL du compte LinkedIn" value="<?= $linkedinUrl ?? ''; ?>">
                <label for="linkedinUrl">URL du compte LinkedIn</label>
            </div>
            <p class="error">
                <?= $error['linkedinUrl'] ?? '' ?>
            </p>
            <!-- Formulaire : Langage(s) web connu(s) -->
            <p class="webLanguages">Quel langage Web connaissez-vous ?</p>
            <?php
            foreach (CONSTANT_ARRAY_WEB_LANGUAGES as $webLanguageKey => $webLanguageValue) {
            ?>
                <div class="form-check form-check-inline mb-3">
                    <input class="form-check-input" type="checkbox" name="webLanguages[]" id="<?= $webLanguageKey; ?>WebLanguages" value="<?= $webLanguage ?? $webLanguageValue; ?>" <?php
                                                                                                                                                                                        if (!empty($webLanguages) && (in_array($webLanguageValue, $webLanguages))) {
                                                                                                                                                                                            echo 'checked="checked"';
                                                                                                                                                                                        };
                                                                                                                                                                                        ?>>
                    <label class="form-check-label" for="<?= $webLanguageKey; ?>WebLanguages"><?= $webLanguageValue; ?></label>
                </div>
            <?php
            };
            ?>
            <p class="error">
                <?= $error['webLanguages'] ?? '' ?>
            </p>
            <!-- Formulaire : Experience -->
            <div class="mb-3">
                <label for="commentsExperience" class="commentsExperience">Avez vous déjà eu une experience dans la programmation et/ou l'informatique avant de remplir ce formulaire ? *</label>
                <textarea class="form-control
                <?php
                if (!empty($error['commentsExperience'])) {
                    echo 'invalidInput';
                };
                ?>" placeholder="Précisez" name="commentsExperience" id="commentsExperience" required><?= $commentsExperience ?? ''; ?></textarea>
            </div>
            <p class="error">
                <?= $error['commentsExperience'] ?? '' ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <button type="submit" id="submit" class="btn my-1">Soumettre</button>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <p>* Champs obligatoires</p>
        </div>
    </div>
</form>