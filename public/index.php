<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RabbitMq</title>
    <link rel="stylesheet" type="text/css" href="resources/style.css">
</head>
<body>
<main id="app" class="main-content">
    <div class="content">
        <h1>Рассчет нескольких чисел фиббоначи</h1>
        <div class="content-form-template">
            <form id="calculate-fib" class="form-content">
                <input name="type" value="calculate" hidden="hidden">
                <label for="number-1">Введите первое число</label>
                <input  value="33" id="number-1" name="number-1" class="input" type="number" min="30" max="60" required>
                <label for="number-2">Введите второе число</label>
                <input  value="33" id="number-2" name="number-2" class="input" type="number" min="30" max="60" required>
                <label for="number-3">Введите третье число</label>
                <input value="33"  id="number-3" name="number-3" class="input" type="number" min="30" max="60" required>
                <button id="btn-submit" type='button' onclick="validateInputNumber(3)">Рассчитать</button>
            </form>
            <div class="form-content">
                <label for="result-1">Результат первого числа</label>
                <input id="result-1" class="input"
                      type="number" readonly required>
                <label for="result-2">Результат второго числа</label>
                <input id="result-2" class="input"
                       type="number" readonly required>
                <label for="result-3">Результат третьго числа</label>
                <input id="result-3" class="input"
                       type="number" readonly required>
            </div>
        </div>
    </div>
</main>
<script src="resources/app.js"></script>
</body>
</html>