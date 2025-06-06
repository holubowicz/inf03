const randomResponses = [
    "Świetnie!",
    "Kto gra główną rolę?",
    "Lubisz filmy Tego reżysera?",
    "Będę 10 minut wcześniej",
    "Może kupimy sobie popcorn?",
    "Ja wolę Colę",
    "Zaproszę jeszcze Grześka",
    "Tydzień temu też byłem w kinie na Diunie",
    "Ja funduję bilety"
];

function handleSendButtonClick() {
    const chatSection = document.getElementById("chat");

    const messageInput = document.getElementById("message-input");
    const message = messageInput.value;

    if (message.length === 0) {
        return;
    }

    messageInput.value = "";

    // Message Container
    const chatMessageElement = document.createElement("div");
    chatMessageElement.classList.add("chat__message", "chat__message--jolka");

    // Message Avatar
    const chatMessageImageElement = document.createElement("img");
    chatMessageImageElement.setAttribute("src", "Jolka.jpg");
    chatMessageElement.setAttribute("alt", "Jolanta Nowak");
    chatMessageElement.appendChild(chatMessageImageElement);

    // Message Content
    const chatMessageParagraphElement = document.createElement("p");
    chatMessageParagraphElement.textContent = message;
    chatMessageElement.appendChild(chatMessageParagraphElement);

    chatSection.appendChild(chatMessageElement);
    chatMessageElement.scrollIntoView();
}

function handleGenerateRandomResponseButtonClick() {
    const chatSection = document.getElementById("chat");

    const randomIndex = Math.floor(Math.random() * 9);
    const message = randomResponses[randomIndex];

    // Message Container
    const chatMessageElement = document.createElement("div");
    chatMessageElement.classList.add("chat__message", "chat__message--krzysiek");

    // Message Avatar
    const chatMessageImageElement = document.createElement("img");
    chatMessageImageElement.setAttribute("src", "Krzysiek.jpg");
    chatMessageElement.setAttribute("alt", "Krzysztof Łukasiński");
    chatMessageElement.appendChild(chatMessageImageElement);

    // Message Content
    const chatMessageParagraphElement = document.createElement("p");
    chatMessageParagraphElement.textContent = message;
    chatMessageElement.appendChild(chatMessageParagraphElement);

    chatSection.appendChild(chatMessageElement);
    chatMessageElement.scrollIntoView();
}