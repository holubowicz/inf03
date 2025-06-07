const roomWidthInputElement = document.getElementById("room-width-input");
const roomLengthInputElement = document.getElementById("room-length-input");

const floorPanelRadio1Element = document.getElementById("floor-panel-radio--1");
const floorPanelRadio2Element = document.getElementById("floor-panel-radio--2");
const floorPanelRadio3Element = document.getElementById("floor-panel-radio--3");

const costResultElement = document.getElementById("cost-result");

function handleCalculateButtonOnClick() {
    const widthValue = roomWidthInputElement.value;
    const lengthValue = roomLengthInputElement.value;

    if (widthValue === "" || lengthValue === "") {
        costResultElement.textContent = "Wprowadź poprawne dane.";
        return;
    }

    let squareMeterCost = 0;
    if (floorPanelRadio1Element.checked) {
        squareMeterCost = 12;
    } else if (floorPanelRadio2Element.checked) {
        squareMeterCost = 14;
    } else if (floorPanelRadio3Element.checked) {
        squareMeterCost = 18;
    }

    const area = Number(widthValue) * Number(lengthValue);
    const cost = area * squareMeterCost;

    costResultElement.textContent = `Pole powierzchni pomieszczenia: ${area}, koszt montażu ${cost}`;
}