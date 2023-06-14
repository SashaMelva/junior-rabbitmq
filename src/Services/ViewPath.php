<?php

namespace App\Services;

class ViewPath
{
    public function mainPagePath(): string
    {
        return __DIR__ . "/../../public/index.php";
    }
}