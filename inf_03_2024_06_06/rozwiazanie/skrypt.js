function showRegisterFormCard(nextCardIdx, e) {
    e.preventDefault();

    const formSectionElements = document.querySelectorAll("form > section");
    formSectionElements[nextCardIdx - 1].style.visibility = "hidden";
    formSectionElements[nextCardIdx].style.visibility = "visible";
}

function submitRegisterForm(e) {
    e.preventDefault();

    const password = document.getElementById("register-form__input-password").value;
    const confirmPassword = document.getElementById("register-form__input-confirm-password").value;

    if (password !== confirmPassword) {
        alert("Podane hasła różnią się");
        return;
    }

    const name = document.getElementById("register-form__input-name").value;
    const lastname = document.getElementById("register-form__input-lastname").value;

    console.log(`Witaj ${name} ${lastname}`);
}