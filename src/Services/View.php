<?php

namespace App\Services;

use App\Services\ViewPath;

class View
{
    public function __construct(
         readonly ViewPath $viewPath,
         array              $arguments = []
    )
    {
    }

    public function __toString(): string
    {
        return $this->getRenderedFileAsString($this->viewPath->value);
    }

    /** Рендеринг страницы */
    private function getRenderedFileAsString(string $filePath): string
    {
        //Включает буферизацию вывода
        ob_start();
        require_once($filePath);
        //Возвращение контента буферизации
        $var = ob_get_contents();
        //Очищение буфера
        ob_end_clean();
        return $var;
    }
}