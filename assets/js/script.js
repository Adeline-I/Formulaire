// declaration regex    
let mailRegex = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
let lastnameRegex = /^[A-Za-zéèê\-]+$/;
let birthDateRegex = "";
let nativeCountryRegex = "";
let postalCodeRegex = "";
let profilePictureRegex = "";
let linkedinUrlRegex = "";
let webLanguagesRegex = "";

// selecteurs
let getMail = document.getElementById("mail");
let getLastname = document.getElementById("lastname");
let getBirthDate = document.getElementById("birthDate");
let getNativeCountry = document.getElementById("nativeCountry");
let getPostalCode = document.getElementById("postalCode");
let getProfilePicture = document.getElementById("profilePicture");
let getLinkedinUrl = document.getElementById("linkedinUrl");
let getWebLanguages = document.getElementById("webLanguages");
let submitBtn = document.getElementById('submit');

// click
submitBtn.addEventListener('click', function () {

    //Validation de l'email
    if (mailRegex.test(getMail.value) == false) {
        document.getElementById("falseMail").style.display = 'block';
    } else {
        document.getElementById("falseMail").style.display = 'none';
    };

    // validation du nom
    if (lastnameRegex.test(getLastname.value) == false) {
        document.getElementById("falseLastname").style.display = 'block';
    } else {
        document.getElementById("falseLastname").style.display = 'none';
    };

    // validation de la date de naissance
    if (nameRegex.test(getBirthDate.value) == false) {
        document.getElementById("falseBirthDate").style.display = 'block';
    } else {
        document.getElementById("falseBirthDate").style.display = 'none';
    };
    // validation du pays de naissance
    if (nameRegex.test(getNativeCountry.value) == false) {
        document.getElementById("falseNativeCountry").style.display = 'block';
    } else {
        document.getElementById("falseNativeCountry").style.display = 'none';
    };
    // validation du code postal
    if (nameRegex.test(getPostalCode.value) == false) {
        document.getElementById("falsePostalCode").style.display = 'block';
    } else {
        document.getElementById("falsePostalCode").style.display = 'none';
    };
    // validation du fichier
    if (nameRegex.test(getProfilePicture.value) == false) {
        document.getElementById("falseProfilePicture").style.display = 'block';
    } else {
        document.getElementById("falseProfilePicture").style.display = 'none';
    };
    // validation de l'URL
    if (nameRegex.test(getLinkedinUrl.value) == false) {
        document.getElementById("falseLinkedinUrl").style.display = 'block';
    } else {
        document.getElementById("falseLinkedinUrl").style.display = 'none';
    };
    // validation du/des langage(s) connu(s)
    if (nameRegex.test(getWebLanguages.value) == false) {
        document.getElementById("falseWebLanguages").style.display = 'block';
    } else {
        document.getElementById("falseWebLanguages").style.display = 'none';
    };
});