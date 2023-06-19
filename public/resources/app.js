const btnSubmit = document.querySelector('#btn-submit');


function insertResultForInput(number, json) {

    let inputResult = document.querySelector('#result-' + number);
    let result = json.data
    if (json.status === 'success') {
        inputResult.value = result['result'];
    } else {
        alert("Ошибка при вычислении")
    }
}

async function fetchAndViewCalculateFib() {
    btnSubmit.disabled = true;
    clearInputResult(3)
    const form = new FormData(document.querySelector(".form-content"));

    await fetch('/app.php', {
        method: 'POST',
        body: form
    });

    setInterval(function () {
        getResultForNumber(3);
        checkIsNullInputForResult(3)
    }, 2000);
}


async function fetchAndResult(number, id) {
    let response = await fetch('/app.php?page=result&id=' + id);
    let json = await response.json()
    insertResultForInput(number, json)
}


function getResultForNumber(maxInput) {
    for (let number = 1; number <= maxInput; number++) {
        let inputNumber = document.querySelector("#number-" + number).value;
        let resultNumber = document.querySelector("#result-" + number);

        if (resultNumber.value === "" && inputNumber !== "") {
            fetchAndResult(number, inputNumber).then(r => "");
            break;
        }
    }
}

function checkIsNullInputForResult(maxInput) {
    let r = 0;
    for (let number = 1; number <= maxInput; number++) {
        let resultNumber = document.querySelector("#result-" + number);

        if (resultNumber.value !== "") {
            r++;
        }
    }

    if (r > 0) {
        btnSubmit.disabled = false;
    }
}

function clearInputResult(maxInput) {
    for (let number = 1; number <= maxInput; number++) {
        let resultNumber = document.querySelector("#result-" + number);
        resultNumber.value = "";
    }
}

function validateInputNumber(maxInput) {
    $r = 0;

    for (let number = 1; number <= maxInput; number++) {
        let numberInput = document.querySelector("#number-" + number);

        if (numberInput.value < 30 || numberInput.value > 60) {
            numberInput.style.borderColor = "red";
            $r++;
        } else {
            numberInput.style.borderColor = "green";
        }
    }

    if ($r === 0) {
        fetchAndViewCalculateFib().then(r => "");
    }
}