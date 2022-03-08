// declaration regex    
let mailRegex = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
let nameRegex = /^[A-Za-zéèê\-]+$/;

// selecteurs
let getMail = document.getElementById("mail");
let getName = document.getElementById("lastname");
let submitBtn = document.getElementById('submit');

// click
tagBtn.addEventListener('click', function () {

    //Validation de l'email
    if (mailRegex.test(getMail.value) == false) {
        document.getElementById("falseMail").style.display = 'block';
    } else {
        document.getElementById("falseMail").style.display = 'none';
    };

    // validation du nom
    if (nameRegex.test(getName.value) == false) {
        document.getElementById("falseLastname").style.display = 'block';
    } else {
        document.getElementById("falseLastname").style.display = 'none';
    };

    // validation de la date de naissance
    if (nameRegex.test(getName.value) == false) {
        document.getElementById("falseBirthDate").style.display = 'block';
    } else {
        document.getElementById("falseBirthDate").style.display = 'none';
    };
    // validation du pays de naissance
    if (nameRegex.test(getName.value) == false) {
        document.getElementById("falseNativeCountry").style.display = 'block';
    } else {
        document.getElementById("falseNativeCountry").style.display = 'none';
    };
    // validation du code postal
    if (nameRegex.test(getName.value) == false) {
        document.getElementById("falsePostalCode").style.display = 'block';
    } else {
        document.getElementById("falsePostalCode").style.display = 'none';
    };
    // validation du fichier
    if (nameRegex.test(getName.value) == false) {
        document.getElementById("falseProfilePicture").style.display = 'block';
    } else {
        document.getElementById("falseProfilePicture").style.display = 'none';
    };
    // validation de l'URL
    if (nameRegex.test(getName.value) == false) {
        document.getElementById("falseLinkedinUrl").style.display = 'block';
    } else {
        document.getElementById("falseLinkedinUrl").style.display = 'none';
    };
    // validation de l'URL
    if (nameRegex.test(getName.value) == false) {
        document.getElementById("falseCommentsExpérience").style.display = 'block';
    } else {
        document.getElementById("falseCommentsExpérience").style.display = 'none';
    };
    // validation du/des langage(s) connu(s)
    if (nameRegex.test(getName.value) == false) {
        document.getElementById("falseWebLanguages").style.display = 'block';
    } else {
        document.getElementById("falseWebLanguages").style.display = 'none';
    };

});