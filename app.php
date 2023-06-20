<?php
require_once "config" . DIRECTORY_SEPARATOR . "config.php";


use App\CalculateController;

if (isset($_POST['type'])) {
    try {
        switch ($_POST['type']) {
            case 'calculate' :
                (new CalculateController())->validationCalculation($_POST['number-1'], $_POST['number-2'], $_POST['number-3']);
                break;
        }
    } catch (Exception $e) {
    }
}

if (isset($_GET['page'])) {
    try {
        switch ($_GET['page']) {
            case 'result' :
                (new CalculateController())->updateResult($_GET['id']);
                break;
        }
    } catch (Exception $e) {
    }
}
exit(0);