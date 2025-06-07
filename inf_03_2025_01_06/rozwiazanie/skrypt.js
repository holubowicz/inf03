const numberInputElement = document.getElementById("number-input");
const resultParagraphElement = document.getElementById("result-paragraph");

function handleConvertButtonOnClick() {
    const inputString = numberInputElement.value;
    if (inputString.length === 0) {
        return;
    }

    const inputNumber = Number(inputString);
    const binary = convertDecimalToBinary(inputNumber);

    const formattedBinary = binary.split("")
        .reverse()
        .map((value, index) => (index % 4 === 0 && index !== 0) ? value + " " : value)
        .reverse()
        .join("")
        .trimStart();

    resultParagraphElement.innerHTML = formattedBinary + "<sub>(2)</sub>";
}

function convertDecimalToBinary(decimalNumber) {
    if (decimalNumber === 0) {
        return "0";
    }

    let num = decimalNumber;
    let binaryString = "";

    while (num !== 0) {
        binaryString += (num % 2).toString();
        num = Math.floor(num / 2);
    }

    return binaryString.split("").reverse().join("");
}