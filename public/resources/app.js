document.addEventListener("DOMContentLoaded", fetchAndViewMainLoad);

const btnSubmit = document.querySelector('#btn-submit');


function insertIntoHtml(json) {
    btnSubmit.disabled = false;
    let main = document.querySelector('#app');

    if (checkStatusJson(json.status)) {
        main.innerHTML = json.html;
    } else {
        main.innerHTML = "Ошибка при вычислении"
    }
}

function checkStatusJson(status) {
    return status !== 'failed';
}

async function fetchAndViewCalculateFib() {
    btnSubmit.disabled = true;
    const form = new FormData(document.querySelector(".form-content"));

    let response = await fetch('/app.php?type=calculate', {
        method: 'POST',
        body: form
    });
    let json = await response.json();

    insertIntoHtml(json);
}

async function fetchAndViewMainLoad() {
    let response = await fetch('/app.php');
    let json = await response.json();

    insertIntoHtml(json);
}