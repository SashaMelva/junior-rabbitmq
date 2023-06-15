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
            case 'main' :
                (new CalculateController())->viewMainContent();
                break;
            case 'result' :
                (new CalculateController())->updateResult($_GET['id']);
                break;
        }
    } catch (Exception $e) {
    }
}
//match ($_GET['page']) {
//    'main' =>  (new CalculateController())->viewMainContent(),
//    'result' => (new CalculateController())->updateResult($_GET['id'])
//};
exit(0);