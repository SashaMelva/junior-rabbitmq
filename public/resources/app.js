
const btnSubmit = document.querySelector('#btn-submit');


function insertIntoHtml(json) {
    insertResultForInput(1, json)
    insertResultForInput(2, json)
    insertResultForInput(3, json)
    btnSubmit.disabled = false;
}

function insertResultForInput(number, json) {

    let inputResult = document.querySelector('#result-' + number);
    let result = json.data
    if (json.status === 'success') {
        inputResult.value = result['result' + number];
    } else {
        alert("Ошибка при вычислении")
    }
}

async function fetchAndViewCalculateFib() {
    btnSubmit.disabled = true;
    const form = new FormData(document.querySelector(".form-content"));

    let response = await fetch('/app.php', {
        method: 'POST',
        body: form
    });

    // setInterval(function () {
    //     console.log(1);
    //     getResultForNumber(1);
    //     getResultForNumber(2);
    //     getResultForNumber(3);
    // }, 2000);

    let json = await response.json();

    insertIntoHtml(json);
}

async function fetchAndViewMainLoad() {
    let response = await fetch('/app.php?page=main');
    let json = await response.json();

    return json;
}

async function fetchAndResult(id) {
    let response = await fetch('/app.php?page=result&id=' + id);
    let json = await response.json();

    return json;
}


function getResultForNumber(number){
    let inputNumber = document.querySelector("#number-" + number).value;
    let resultNumber = document.querySelector("#result-" + number);

    if(resultNumber.value === "" && inputNumber !== "") {
        $result = fetchAndResult(inputNumber);
        resultNumber.value = $result;
    }
}

function validateInputNumber() {
    let number1Input = document.querySelector("#number-1");
    let number2Input = document.querySelector("#number-2");
    let number3Input = document.querySelector("#number-3");
    $r = 0;

    if (number1Input.value === "" || number1Input.value < 30 || number1Input.value > 60) {
        number1Input.style.borderColor = "red";
        $r++;
    } else {
        number1Input.style.borderColor = "green";
    }

    if (number2Input.value === "" || number2Input.value < 30 || number2Input.value > 60) {
        number2Input.style.borderColor = "red";
        $r++;
    } else {
        number2Input.style.borderColor = "green";
    }

    if (number3Input.value === "" || number3Input.value < 30 || number3Input.value > 60) {
        number3Input.style.borderColor = "red";
        $r++;
    } else {
        number3Input.style.borderColor = "green";
    }

    if ($r === 0) {
        fetchAndViewCalculateFib().then(r => "");
    }
}