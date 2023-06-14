<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RabbitMq</title>
    <link rel="stylesheet" type="text/css" href="public/resources/style.css">
</head>
<body>
<main class="main-content">
    <div class="content">
        <h1>Рассчет нескольких чисел фиббоначи</h1>
        <form action="" method="post" class="form-content">
            <label for="number-1">Введите первое число</label>
            <input id="number-1" class="input" type="number" min="30" max="60" required>
            <label for="number-2">Введите второе число</label>
            <input id="number-2" class="input" type="number" min="30" max="60" required>
            <label for="number-3">Введите третье число</label>
            <input id="number-3" class="input" type="number" min="30" max="60" required>
            <button id="btn-submit" onclick="fetchAndViewCalculateFib()">Рассчитать</button>
        </form>
    </div>
</main>
<script src="public/resources/app.js"></script>
</body>
</html>