<?php

use App\Services\ViewPath;

class View
{
    private $arguments;
    private $viewPath;

    public function __construct(
        string $viewPath,
        array    $arguments = []
    )
    {
        $this->viewPath = $viewPath;
        $this->arguments = $arguments;
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