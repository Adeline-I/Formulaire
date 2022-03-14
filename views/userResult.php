<!-- Retour si Formulaire correctement rempli -->
<div class="result">
                    <p>Adresse E-mail : <?= $mail; ?></p>
                    <p>Nom : <?= $lastname; ?></p>
                    <p>Date de naissance : <?= $birthDate; ?></p>
                    <p>Pays de naissance : <?= $nativeCountry; ?></p>
                    <p>Code postal : <?= $postalCode; ?></p>
                    <p>Photo de profil : <?= $profilePicture ?? 'Non indiqué'; ?> <a href="/uploads/<?= $lastname.'-'.$birthDate.'.'.$extension ?>">lien ici</a></p>
                    <p>Niveau d'études : <?= $levelStudy; ?></p>
                    <p>Compte LinkedIn : <?= $linkedinUrl ?? 'Non indiqué'; ?></p>
                    <p>Langage(s) web connu(s) : <?php
                        foreach ($webLanguages as $webLanguagesKey => $webLanguagesValue) { 
                            echo $webLanguagesValue.' - ' ?? 'Non indiqué';
                        };
                    ?></p>
                    <p>Experience : <?= $commentsExperience; ?></p>
                </div>