<?php

namespace App\Services;

enum ViewPath: string
{
    case mainPagePath = __DIR__ . "/../../public/index.php";
}