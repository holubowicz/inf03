const beeImageElement = document.getElementById("bee-image__img");
const beeImageRadioBlurElement = document.getElementById("bee-image__radio--blur");
const beeImageRadioSepiaElement = document.getElementById("bee-image__radio--sepia");
const beeImageRadioInvertElement = document.getElementById("bee-image__radio--invert");

const orangeImageElement = document.getElementById("orange-image__img");

const fruitsImageElement = document.getElementById("fruits-image__img");
const fruitsImageRangeElement = document.getElementById("fruits-image__range");

const turtleImageElement = document.getElementById("turtle-image__img");
const turtleImageRangeElement = document.getElementById("turtle-image__range");

function handleBeeImageButtonOnClick() {
    if (beeImageRadioBlurElement.checked) {
        // [4, 8]; 8 - 4 + 1 = 5
        const blurValue = Math.floor(Math.random() * 5) + 4;
        beeImageElement.style.filter = `blur(${blurValue}px)`;
    } else if (beeImageRadioSepiaElement.checked) {
        beeImageElement.style.filter = "sepia(100%)";
    } else if (beeImageRadioInvertElement.checked) {
        beeImageElement.style.filter = "invert(100%)";
    }
}

function applyOrangeImageColorsFilter() {
    orangeImageElement.style.filter = "";
}

function applyOrangeImageBlackAndWhiteFilter() {
    orangeImageElement.style.filter = "grayscale(100%)";
}

function handleFruitsImageButtonOnClick() {
    const opacityValue = Number(fruitsImageRangeElement.value);
    fruitsImageElement.style.filter = `opacity(${opacityValue}%)`;
}

function handleTurtleImageButtonOnClick() {
    const brightnessValue = Number(turtleImageRangeElement.value);
    turtleImageElement.style.filter = `brightness(${brightnessValue}%)`;
}