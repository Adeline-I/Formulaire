<!-- Retour si Formulaire correctement rempli -->
<div class="result">
    <p>Adresse E-mail : <?= $mail; ?></p>
    <p>Nom : <?= $lastname; ?></p>
    <p>Date de naissance : <?= $birthDate; ?></p>
    <p>Pays de naissance : <?= $nativeCountry; ?></p>
    <p>Code postal : <?= $postalCode; ?></p>
    <p>Photo de profil :
        <?php if (!empty($profilePicture)) { ?>
            <?= $profilePicture; ?> <a href="/uploads/<?= $lastname . '-' . $birthDate . '.' . $extension ?>">lien ici</a></p>
<?php
        } else {
            echo 'Non indiqué';
        };
?>
<p>Niveau d'études : <?= $levelStudy; ?></p>
<p>Compte LinkedIn :
    <?php if (!empty($linkedinUrl)) {
        echo $linkedinUrl;
    } else {
        echo 'Non indiqué';
    };
    ?>
<p>Langage(s) web connu(s) :
    <?php
    if (!empty($webLanguages)) {
        foreach ($webLanguages as $webLanguagesKey => $webLanguagesValue) {
            echo $webLanguagesValue . ' - ';
        };
    } else {
        echo 'Non indiqué';
    };
    ?>
</p>
<p>Expérience : <?= $commentsExperience; ?></p>
</div>