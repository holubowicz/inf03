const navigationButtonElements = document.querySelectorAll("main > button");
const registerSectionElements = document.querySelectorAll(".register-section");
const inputElements = document.querySelectorAll("input");
const submitButtonElement = document.getElementById("submit-button");
const progressStateElement = document.getElementById("progressbar__state");

navigationButtonElements.forEach((element, index) =>
    element.addEventListener("click", () => showRegisterSection(index))
);

inputElements.forEach(element =>
    element.addEventListener("focusout", handleInputOnFocusOut)
);

submitButtonElement.addEventListener("click", submitRegister);

function showRegisterSection(sectionIndex) {
    registerSectionElements.forEach(element => element.style.display = "none");
    registerSectionElements[sectionIndex].style.display = "block";
}

function handleInputOnFocusOut() {
    let width = parseInt(progressStateElement.style.width.slice(0, -1)) || 4;

    if (width < 100) {
        width += 12;
    }

    progressStateElement.style.width = width + "%";
}

function submitRegister() {
    let message = Array.from(inputElements)
        .map(element => element.value)
        .join(", ");
    console.log(message);
}