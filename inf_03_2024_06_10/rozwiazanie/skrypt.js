const blockqouteElements = document.querySelectorAll("blockquote");

blockqouteElements.forEach((element, index) =>
    element.addEventListener("click", () => handleBlockqouteOnClick(index))
);

function handleBlockqouteOnClick(index) {
    let nextIndex = index + 1;

    if (nextIndex >= blockqouteElements.length) {
        nextIndex = 0;
    }

    const currentBlockqouteElement = blockqouteElements.item(index);
    const nextBlockqouteElement = blockqouteElements.item(nextIndex);

    currentBlockqouteElement.style.display = "none";
    nextBlockqouteElement.style.display = "block";
}